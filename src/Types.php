<?php

namespace Phalcon\Feedwall;

use Phalcon\Feedwall\Exception\InvalidArgumentException;


/**
 * \Phalcon\messages
 *
 * Class for the feedwall module component.
 *
 * @package Phalcon
 */
class Types extends Feedwall
{

    /**
     * Feedwall constructor.
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
    public static function getContext($user, $message) : ?string
    {
        if (!ctype_digit($user) && (!is_int($user) || $user < 0)) {
            throw new InvalidArgumentException(
                "is not a valid user ID {$user} given."
            );
        }

        /* handle database with return */
    }

    /**
     *
     * get validation.
     *
     * @param string $reactionId       reaction item identifier.
     * @param string $reactionStatus One of: "created", "deleted".
     *
     * @throws \InvalidArgumentException
     *
     * @return \Response
     */
    public static function validate($type) : ?string
    {
        /* handle database with return */
        return $type;
    }


}
