<?php

namespace Baka\Feeds;

use Baka\Feeds\Exception\InvalidArgumentException;


/**
 * \Phalcon\messages
 *
 * Class for the feeds module component.
 *
 * @package Phalcon
 */
class Resource extends Feeds
{

    protected static $message_id;

    protected static $comments_id;

    protected static $media_resources_id;






    public function __construct()
    {
    }




    /**
     *
     * get message context to transforn it depending of the type.
     *
     * @param string $message       message text.
     * @param string $type   type of message.
     *
     * @return \Response
     */
    public function context($message, $type) : ?string
    {
        $context = "";

        switch ($type) {
            case "text":
                $context = $message;
                break;
            case "call":
                // build a call context
                break;

        }

        return $context;

    }


    /**
     *
     * get Type of message.
     *
     * @param string $reactionId reaction item identifier.
     *
     * @return \Response
     */
    public function _getType($messageId): ?string
    {
        /* handle database delete */

        static::$messageId = $messageId;

        return $messageId;
    }

    /**
     *
     * Delete a message.
     *
     * @param string $reactionId reaction item identifier.
     *
     *
     * @return \response
     */
    public function deleteReaction(
        $reactionId
    )
    {
        return $this->_handleReaction($reactionId, 'deleted');
    }


    /**
     * MENTIONS
     *
     * Get details about a specific user via their username.
     *
     *
     * @param string      $username Username as string.
     *
     * @throws \InvalidArgumentException
     *
     * @return Response
     */
    public function getUserByName(
        $username
    )
    {

        if (!is_int($username)) {
            throw new InvalidArgumentException(
                "is not a valid username. {$username} given."
            );
        }

        /* handle database with return */
    }


    /**
     * REACTIONS
     *
     * Get specific reaction stats
     *
     *
     * @param int      $id Id as int.
     *
     * @throws \InvalidArgumentException
     *
     * @return Response
     */
    public function getReactionStats(
        $id
    )
    {

        if (is_int($id)) {
            throw new InvalidArgumentException(
                "is not a valid id. {$id} given."
            );
        }

        /* handle database with return */
    }





}
