<?php

namespace Phalcon\Feedwall;


use Baka\Auth\Models\Users;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Exception;
use Phalcon\Feedwall\Message as MessageModel;
use Phalcon\Feedwall\Models\Feed;


/**
 * \Phalcon\feedwall
 *
 * Class for the feedwall module component.
 *
 * @package Phalcon
 */
class Feedwall
{

    /**
     * The current company ID
     *
     * @var string
     */
    protected static $companyId;

    /**
     * The current user ID.
     *
     * @var string
     */
    protected static $userId;


    /**
     * Feedwall constructor.
     */
    public function __construct()
    {

    }


    /**
     *
     * Add a new message to the feed.
     *
     * @param string $request post data.
     *
     * @throws \InvalidArgumentException
     *
     * @return \Response
     */
    public function add($request): ?array
    {
        // Validating post request
        $validation = new Validation();
        $validation->add('type', new PresenceOf(['message' => _('The type is required.')]));
        $validation->add('messageText', new PresenceOf(['message' => _('The messageText is required.')]));

        $exceptions = $validation->validate($request);
        if (count($exceptions)) {
            foreach ($exceptions as $exception) {
                throw new Exception($exception);
            }
        }

        $messageText = $request['messageText'];
        $type = $request['type'];


        
        $message = new Messages();
        $message->user_id = $this->userData->getId();
        $message->app_id = $this->app->getId();
        $message->companies_id =  $this->userData->currentCompanyId();
        $message->message_type_id = $type;
        $message->created_at = date('Y-m-d H:i:s');
        $message->content =  $message->context($messageText, $type);
        
        
        $model = MessageModel::save($message);



        return $model->message;
    }

}
