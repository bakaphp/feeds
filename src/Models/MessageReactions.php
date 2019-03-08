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
class MessageReactions extends \Phalcon\Mvc\Model
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
    public $comments_id;

    /**
     *
     * @var integer
     */
    public $user_id;

    /**
     *
     * @var integer
     */
    public $reactions_id;

    /**
     *
     * @var string
     */
    public $added_date;


    public function getByCommentId(int $commentsId): MessageReactions
    {
        // Validating post request
        $validation = new Validation();
        $validation->add('comments_id', new PresenceOf(['message' => _('The Comment ID is required.')]));

        $exceptions = $validation->validate($commentsId);
        if (count($exceptions)) {
            foreach ($exceptions as $exception) {
                throw new Exception($exception);
            }
        }

        $messageReactions =  self::find( [
            "comments_id = '$commentsId'",
            "order" => "id",
        ]);


        if ($messageReactions) {
            return $messageReactions;
        } else {
            throw new Exception('Records not found');
        }


    }


    public function add(Users $user, array $request): MessageReactions
    {

        // Validating post request
        $validation = new Validation();
        $validation->add('messages_id', new PresenceOf(['message' => _('The Message ID is required.')]));
        $validation->add('comments_id', new PresenceOf(['message' => _('The Comments ID is required.')]));
        $validation->add('reactions_id', new PresenceOf(['message' => _('The Reactions ID is required.')]));

        $exceptions = $validation->validate($request);
        if (count($exceptions)) {
            foreach ($exceptions as $exception) {
                throw new Exception($exception);
            }
        }

        $messageReaction = new self();
        $messageReaction->messages_id =  $request['messages_id'];
        $messageReaction->comments_id =  $request['comments_id'];
        $messageReaction->reactions_id =  $request['reactions_id'];
        $messageReaction->user_id =      $user->getId();


        if (!$messageReaction->save()) {
            throw new Exception(current($messageReaction->getMessages()));
        }

        return $messageReaction;

    }


}
