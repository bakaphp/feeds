<?php

namespace Baka\Feeds\Models;

use Gewaer\Models\Users;
use Phalcon\Validation;

/**
 * this are the userFeeds related to user_messages
 *
 */
class MessageComments extends \Phalcon\Mvc\Model
{


    /**
     *
     * @var integer
     */
    public $apps_id;

    /**
     *
     * @var integer
     */
    public $companies_id;

    /**
     *
     * @var integer
     */
    public $message_id;

    /**
     *
     * @var integer
     */
    public $user_id;

    /**
     *
     * @var text
     */
    public $content;

    /**
     *
     * @var integer
     */
    public $reactions_count;
    
    /**
     *
     * @var string
     */
    public $added_date;

    /**
     * initilize the model
     */
    public function initialize()
    {

    }

    public function add(Users $user, array $request): MessageComments
    {

        // Validating post request
        $validation = new Validation();
        $validation->add('messages_id', new PresenceOf(['message' => _('The Message ID is required.')]));
        $validation->add('content', new PresenceOf(['message' => _('The content is required.')]));

        $exceptions = $validation->validate($request);
        if (count($exceptions)) {
            foreach ($exceptions as $exception) {
                throw new Exception($exception);
            }
        }

        $messageComment = new self();
        $messageComment->messages_id =  $request['messages_id'];
        $messageComment->content =  $request['content'];
        $messageComment->media_resources_id = $user->getId();
        $messageComment->companies_id = $user->currentCompanyId();
        $messageComment->apps_id = $user->currentCompanyId();

        if (!$messageComment->save()) {
            throw new Exception(current($messageComment->getMessages()));
        }

        return $messageComment;

    }


}
