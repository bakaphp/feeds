<?php

namespace Baka\Feeds\Models;

use Gewaer\Models\Users;
use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Exception;


/**
 * this are the userFeeds related to user_messages
 *
 */
class Reactions extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var string
     */
    public $added_date;


    public function list(): Reactions
    {

        $reactions =  self::find( [
              "order" => "name",
          ]);

        if ($reactions) {
            return $reactions;
        } else {
            throw new Exception('Records not found');
        }

    }

    public function add(array $request): Reactions
    {

        // Validating post request
        $validation = new Validation();
        $validation->add('name', new PresenceOf(['message' => _('The Name is required.')]));
        $validation->add('title', new PresenceOf(['message' => _('The Title is required.')]));

        $exceptions = $validation->validate($request);
        if (count($exceptions)) {
            foreach ($exceptions as $exception) {
                throw new Exception($exception);
            }
        }

        $reactions = new self();
        $reactions->name =  $request['name'];
        $reactions->title =  $request['title'];


        if (!$reactions->save()) {
            throw new Exception(current($reactions->getMessages()));
        }

        return $reactions;

    }


}
