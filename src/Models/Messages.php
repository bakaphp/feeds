<?php

namespace Baka\Feeds\Models;

use Baka\Database\Model;
use Phalcon\Validation;
use Exception;
use Phalcon\Validation\Validator\PresenceOf;

/**
 * this are the userFeeds related to user_messages
 *
 */
class Messages extends Model
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
    private $content;

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
     * @Column(type="string", nullable=true)
     */
    public $created_at;
    /**
     *
     * @var string
     * @Column(type="string", nullable=true)
     */
    public $updated_at;
    /**
     *
     * @var integer
     * @Column(type="integer", length=11, nullable=true)
     */
    public $is_deleted;

    /**
     * initilize the model
     */
    public function initialize()
    {

    }


    /**
     * Save new message with given request
     *
     * @param  array $user
     * @param  array $message
     * @return Message
     */
    public static function add(Users $user, array $request): Messages
    {
        // Validating post request
        $validation = new Validation();
        $validation->add('type', new PresenceOf(['message' => _('The type is required.')]));
        $validation->add('messageText', new PresenceOf(['message' => _('The messageText is required.')]));

        $exceptions = $validation->validate($request);
        if (count($exceptions)) {
            foreach ($exceptions as $exception) {
                throw new Exception($exception);
            }
        }

        $message = new self();
        $message->companies_id = $user->getId();
        $message->users_id =  $user->user_id();
        $message->message_types_id = $message['type'];
        $message->content = $request['messageText'];

        // saving post request
        if (!$message->save()) {
            throw new Exception(current($message->getMessages()));
        }

        return $message;
    }



}
