<?php

namespace Baka\Feeds;

/**
 * this are the userFeeds related to user_messages
 *
 */
class MessagesComments extends \Phalcon\Mvc\Model
{


    /**
     *
     * @var integer
     */
    public $apps_id;

    /**
     *
     * @var integer
     */
    public $companies_id;

    /**
     *
     * @var integer
     */
    public $message_id;

    /**
     *
     * @var integer
     */
    public $user_id;

    /**
     *
     * @var text
     */
    public $content;

    /**
     *
     * @var integer
     */
    public $reactions_count;
    
    /**
     *
     * @var string
     */
    public $added_date;

    /**
     * initilize the model
     */
    public function initialize()
    {

    }

    public function save($message){

        // save to db

    }


}
