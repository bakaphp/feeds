<?php

namespace Baka\Feeds;

use Baka\Feeds\Models\Messages as MessagesModel;

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
     * The Content for the message
     *
     * @var string
     */
    private $content;

    /**
     * The Message Type for the message
     *
     * @var integer
     */
    private $message_types_id;

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
     * @param object $user post data.
     * @param array $request post data.
     *
     * @throws \InvalidArgumentException
     *
     * @return \Response
     */
    public function add($user, $request): ?array
    {

        $this->message_types_id = $request['type'];
        $this->content = $this->getMessageType();

        $request['messageText'] = $this->content;

        $response = MessagesModel::add($user, $request);


        return $response;
    }
    /**
     *
     * Get Message Type.
     *
     * @param object $type
     *
     * @throws \InvalidArgumentException
     *
     * @return \Response
     */
    public function getMessageType(): ?array
    {

        $content = Type::getType($this->message_types_id, $this->content);


        return $content;
    }

}
