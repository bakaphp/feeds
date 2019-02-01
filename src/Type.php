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
class Type extends Feeds
{

    /**
     * Feeds constructor.
     */
    public function __construct()
    {
    }


    /**
     *
     * get context.
     *
     * @param string $reactionId       reaction item identifier.
     * @param string $reactionStatus One of: "created", "deleted".
     *
     * @throws \InvalidArgumentException
     *
     * @return \Response
     */
    public static function getType($type, $content) : ?string
    {
        switch ($type) {
            case "plainText":
                $content = preg_replace('#(\r\n|\n|\r)#', '<br/>', $content);
        break;
            case "call":
                // call example
        break;
        }

        return $content;
    }


}
