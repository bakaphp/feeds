<?php

namespace Baka\Feeds\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Exception;


/**
 * this are the userFeeds related to user_messages
 *
 */
class MessageVariables extends \Phalcon\Mvc\Model
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
     * @var string
     */
    public $variable;

    /**
     *
     * @var string
     */
    public $value;



    public function add(array $request): MessageVariables
    {

        // Validating post request
        $validation = new Validation();
        $validation->add('messages_id', new PresenceOf(['message' => _('The Message ID is required.')]));
        $validation->add('variable', new PresenceOf(['message' => _('The Variable is required.')]));
        $validation->add('value', new PresenceOf(['message' => _('The Value is required.')]));

        $exceptions = $validation->validate($request);
        if (count($exceptions)) {
            foreach ($exceptions as $exception) {
                throw new Exception($exception);
            }
        }

        $messagesVariable = new self();
        $messagesVariable->messages_id = $request['messages_id'];
        $messagesVariable->variable = $request['variable'];
        $messagesVariable->value = $request['value'];

        if (!$messagesVariable->save()) {
            throw new Exception(current($messagesVariable->getMessages()));
        }

        return $messagesVariable;

    }


}
