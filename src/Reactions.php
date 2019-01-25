<?php

namespace Phalcon\Feedwall;

use Phalcon\Feedwall\Exception\InvalidArgumentException;

/**
 * \Phalcon\feedwall
 *
 * Class for the feedwall module component.
 *
 * @package Phalcon
 */
class FeedwallReactions extends Feedwall
{

    /**
     * The current reaction ID.
     *
     * @var string
     */
    protected static $reactionId;


    /**
     * Feedwall constructor.
     */
    public function __construct($reactionId)
    {

        static::$reactionId = $reactionId;
    }


    /**
     * REACTIONS
     *
     * Handle a reaction to an existing thread item.
     *
     * @param string $reactionId reaction item identifier.
     * @param string $reactionStatus One of: "created", "deleted".
     *
     * @throws \InvalidArgumentException
     *
     * @return \Response
     */
    protected function _manageReaction($reactionId, $reactionStatus): ?string
    {
        if (!ctype_digit($reactionId) && (!is_int($reactionId) || $reactionId < 0)) {
            throw new InvalidArgumentException(
                "is not a valid reaction ID {$reactionId} given."
            );
        }

        /* handle database with return */
    }


    /**
     * REACTIONS
     *
     * Send a reaction to an existing message item.
     *
     * @param string $reactionId reaction item identifier.
     *
     * @return \Response
     */
    public function sendReaction($reactionId): ?string
    {
        return $this->_manageReaction($reactionId, 'created');
    }

    /**
     * REACTIONS
     *
     * Delete a reaction to an existing message item.
     *
     * @param string $reactionId reaction item identifier.
     *
     *
     * @return \response
     */
    public function deleteReaction($reactionId): ?string
    {
        return $this->_handleReaction($reactionId, 'deleted');
    }


    /**
     * MENTIONS
     *
     * Get details about a specific user via their username.
     *
     *
     * @param string $username Username as string.
     *
     * @throws \InvalidArgumentException
     *
     * @return Response
     */
    public function getUserByName($username): ?string
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
     * @param int $id Id as int.
     *
     * @throws \InvalidArgumentException
     *
     * @return Response
     */
    public function getReactionStats($id): ?string
    {

        if (is_int($id)) {
            throw new InvalidArgumentException(
                "is not a valid id. {$id} given."
            );
        }

        /* handle database with return */
    }


}
