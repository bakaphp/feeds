<?php

namespace Baka\Feeds\Models;


use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Exception;



/**
 * this are the userFeeds related to user_messages
 *
 */
class MessageReactionsStats extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

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
     * @var integer
     */
    public $reactions_id;

    /**
     *
     * @var integer
     */
    public $total;

    /**
     *
     * @var string
     */
    public $added_date;


    public function getStat(): MessageReactionsStats
    {

        $messageReactionsStats =  self::find( [
            "order" => "name",
        ]);

        if ($messageReactionsStats) {
            return $messageReactionsStats;
        } else {
            throw new Exception('Records not found');
        }

    }

    public function add(array $request): MessageReactionsStats
    {

        // Validating post request
        $validation = new Validation();
        $validation->add('messages_id', new PresenceOf(['message' => _('The Message ID is required.')]));
        $validation->add('comments_id', new PresenceOf(['message' => _('The Comments ID is required.')]));
        $validation->add('reactions_id', new PresenceOf(['message' => _('The Reactions ID is required.')]));

        $exceptions = $validation->validate($request);
        if (count($exceptions)) {
            foreach ($exceptions as $exception) {
                throw new Exception($exception);
            }
        }

        $messageReactionStat = new self();
        $messageReactionStat->messages_id =  $request['messages_id'];
        $messageReactionStat->comments_id =  $request['comments_id'];
        $messageReactionStat->reactions_id =  $request['reactions_id'];


        if (!$messageReactionStat->save()) {
            throw new Exception(current($messageReactionStat->getMessages()));
        }

        return $messageReactionStat;

    }


}
