<?php

namespace Baka\Feeds\Models;

use Gewaer\Models\Users;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Exception;


/**
 * this are the userFeeds related to user_messages
 *
 */
class MessageTags extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $messages_id;

    /**
     *
     * @var integer
     */
    public $tags_id;

    /**
     *
     * @var integer
     */
    public $users_id;



    public function add(Users $user, array $request): MessageTags
    {

        // Validating post request
        $validation = new Validation();
        $validation->add('tags_id', new PresenceOf(['message' => _('The Tag ID is required.')]));
        $validation->add('messages_id', new PresenceOf(['message' => _('The Message ID is required.')]));

        $exceptions = $validation->validate($request);
        if (count($exceptions)) {
            foreach ($exceptions as $exception) {
                throw new Exception($exception);
            }
        }

        $messagesTags = new self();
        $messagesTags->users_id = $user->getId();
        $messagesTags->tags_id = $request['tags_id'];
        $messagesTags->messages_id = $request['messages_id'];

        if (!$messagesTags->save()) {
            throw new Exception(current($messagesTags->getMessages()));
        }

        return $messagesTags;

    }


}
