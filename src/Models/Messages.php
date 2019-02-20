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
class Messages extends \Phalcon\Mvc\Model
{


    /**
     * The apps ID for the message
     *
     * @var integer
     */
    private $apps_id;

    /**
     * The company ID for the message
     *
     * @var integer
     */
    private $companies_id;

    /**
     * The user ID for the message
     *
     * @var integer
     */
    private $users_id;

    /**
     * The Message Type for the message
     *
     * @var integer
     */
    private $message_types_id;

    /**
     * The Content for the message
     *
     * @var string
     */
    private $context;

    /**
     * The count of reactions in the message
     *
     * @var integer
     */
    private $reactions_count;

    /**
     * The the coutn of comments for the message
     *
     * @var integer
     */
    private $comments_count;

    /**
     *
     * @var string
     */
    public $created_at;



    public function add(Users $user, array $request): Messages
    {

        // Validating post request
        $validation = new Validation();
        $validation->add('type', new PresenceOf(['message' => _('The type is required.')]));
        $validation->add('message', new PresenceOf(['message' => _('The message is required.')]));

        $exceptions = $validation->validate($request);
        if (count($exceptions)) {
            foreach ($exceptions as $exception) {
                throw new Exception($exception);
            }
        }

        $message = new self();
        $message->content =  $request['message'];
        $message->message_types_id =  $request['type'];
        $message->users_id = $user->getId();
        $message->companies_id = $user->currentCompanyId();
        $message->apps_id = $user->currentCompanyId();

        if (!$message->save()) {
            throw new Exception(current($message->getMessages()));
        }

        return $message;

    }



}
