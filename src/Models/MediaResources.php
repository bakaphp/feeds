<?php

namespace Baka\Feeds\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\PresenceOf;
use Exception;


/**
 * this are the userFeeds related to user_messages
 *
 */
class MediaResources extends \Phalcon\Mvc\Model
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
     * @var integer
     */
    public $icon;


    /**
     *
     * @var string
     */
    public $added_date;


    public function list(): MediaResources
    {

        $mediaResources =  self::find( [
            "order" => "name",
        ]);

        if ($mediaResources) {
            return $mediaResources;
        } else {
            throw new Exception('Records not found');
        }

    }


    public function add(array $request): MediaResources
    {

        // Validating post request
        $validation = new Validation();
        $validation->add('name', new PresenceOf(['message' => _('The Name is required.')]));
        $validation->add('icon', new PresenceOf(['message' => _('The Icon is required.')]));

        $exceptions = $validation->validate($request);
        if (count($exceptions)) {
            foreach ($exceptions as $exception) {
                throw new Exception($exception);
            }
        }

        $mediaResources = new self();
        $mediaResources->name =  $request['name'];
        $mediaResources->icon =  $request['icon'];

        if (!$mediaResources->save()) {
            throw new Exception(current($mediaResources->getMessages()));
        }

        return $mediaResources;

    }


}
