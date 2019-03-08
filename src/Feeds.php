<?php

namespace Baka\Feeds;


use Baka\Feeds\Models\MessageComments;
use Baka\Feeds\Models\MessageReactions;
use Baka\Feeds\Models\MessageResources;
use Baka\Feeds\Models\Messages as MessageModel;
use Baka\Feeds\Models\MessageResources as MessageResourcesModel;



/**
 * \Phalcon\feeds
 *
 * Class for the feeds module component.
 *
 * @package Phalcon
 */

class Feeds
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
     * Feeds constructor.
     */
    public function __construct()
    {

    }

    /**
     *
     * Add a new message to the feed.
     *
     * @param object $user object info.
     * @param array $request[] post data.
     *    $request = [
     *      'type'     => (integer) type of message. Required.
     *      'message' => (string) the message itself.
     *    ]
     *
     * @return \Response
     */
    public function addMessage(object $user, array $request): ?object
    {

        $response = MessageModel::add($user, $request);

        return $response;
    }

    /**
     *
     * Add a new resource to the feed.
     *
     * @param object $user object info.
     * @param array $request[] post data.
     *    $request = [
     *      'messages_id'     => (integer) Message ID key. Required.
     *      'comments_id' => (integer) Comment ID foreign key. Required.
     *      'media_resources_id' => (integer) Media Resource ID foreign key. Required.
     *    ]
     *
     * @return \Response
     */
    public function addResource(object $user, array $request): ?object
    {

        $response = MessageResourcesModel::add($user, $request);

        return $response;
    }

    /**
     *
     * Add a new comment to a message in the feed.
     *
     * @param object $user object info.
     * @param array $request[] post data.
     *    $request = [
     *      'messages_id'     => (integer) Message ID key. Required.
     *      'content' => (integer) Content of the comment. Required.
     *    ]
     *
     * @return \Response
     */
    public function addComment(object $user, array $request): ?object
    {

        $response = MessageComments::add($user, $request);

        return $response;
    }


    /**
     *
     * Add a new reaction to a message in the feed.
     *
     * @param object $user object info.
     * @param array $request[] post data.
     *    $request = [
     *      'messages_id'     => (integer) Message ID key. Required.
     *      'comments_id' => (integer) Comment ID of the commentt. Required.
     *      'reactions_id' => (integer) Reaction ID of the commentt. Required.
     *    ]
     *
     * @return \Response
     */
    public function addReaction(object $user, array $request): ?object
    {

        $response = MessageReactions::add($user, $request);

        return $response;
    }


}
