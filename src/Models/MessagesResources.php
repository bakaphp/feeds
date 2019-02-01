<?php

namespace Baka\Feeds;

/**
 * this are the userFeeds related to user_messages
 *
 */
class MessagesResources extends \Phalcon\Mvc\Model
{


    /**
     *
     * @var integer
     */
    public $app_id;

    /**
     *
     * @var integer
     */
    public $companies_id;

    /**
     *
     * @var integer
     */
    public $messages_id;

    /**
     *
     * @var integer
     */
    public $comments_id;

    /**
     *
     * @var text
     */
    public $media_resources_id;

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
