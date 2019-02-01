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
class Tag extends Feeds
{
    /**
     * The current message ID.
     *
     * @var string
     */
    protected static $messageId;

    /**
     * Tags array.
     *
     * @var string
     */
    protected static $tags;


    /**
     * Feeds constructor.
     */
    public function __construct($messageId)
    {
        static::$messageId = $messageId;
    }


    /**
     *
     * Add a tag.
     *
     * @param string $messageId    message item identifier.
     * @param string $tag ".
     *
     * @throws \InvalidArgumentException
     *
     * @return \Response
     */
    protected function add($messageId, $tag) : ?string
    {


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
