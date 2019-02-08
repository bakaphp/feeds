<?php

namespace Phalcon;


use Baka\Feeds\Exception\InvalidArgumentException;


/**
 * \Phalcon\comments
 *
 * Class for the feeds module component.
 *
 * @package Phalcon
 */
class Comment extends Feeds
{


    /**
     * Feeds constructor.
     */
    public function __construct()
    {

    }


    /**
     *
     * Generate comments reply
     *
     * @param string $comm_id reaction item identifier.
     *
     * @return \Response
     */
    public function generateReplies() {

    }

    /**
     * gets the replies to a certain comment
     * @param  integer $comm_id the id for the specific comment
     * @param  integer $limit max number of comments to be displayed as reply
     * @return array		  the comments
     */
    function getReplies() {

    }







}
