<?php

namespace Baka\Feeds\Models;

use Gewaer\Models\Users;
use Phalcon\Validation;

/**
 * this are the userFeeds related to user_messages
 *
 */
class MessageResources extends \Phalcon\Mvc\Model
{


    /**
     *
     * @var integer
     */
    public $app_id;

    /**
     *
     * @var integer
     */
    public $companies_id;

    /**
     *
     * @var integer
     */
    public $messages_id;

    /**
     *
     * @var integer
     */
    public $comments_id;

    /**
     *
     * @var text
     */
    public $media_resources_id;

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


    public function add(Users $user, array $request): MessageResources
    {

        // Validating post request
        $validation = new Validation();
        $validation->add('messages_id', new PresenceOf(['message' => _('The Message ID is required.')]));
        $validation->add('comments_id', new PresenceOf(['message' => _('The Comment ID is required.')]));

        $exceptions = $validation->validate($request);
        if (count($exceptions)) {
            foreach ($exceptions as $exception) {
                throw new Exception($exception);
            }
        }

        $messageResource = new self();
        $messageResource->messages_id =  $request['messages_id'];
        $messageResource->comments_id =  $request['comments_id'];
        $messageResource->media_resources_id = $user->getId();
        $messageResource->companies_id = $user->currentCompanyId();
        $messageResource->apps_id = $user->currentCompanyId();

        if (!$messageResource->save()) {
            throw new Exception(current($messageResource->getMessages()));
        }

        return $messageResource;

    }


}
