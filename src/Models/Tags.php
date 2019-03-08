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
class Tags extends \Phalcon\Mvc\Model
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
    public $apps_id;

    /**
     *
     * @var integer
     */
    public $companies_is;

    /**
     *
     * @var integer
     */
    public $users_id;

    /**
     *
     * @var string
     */
    public $name;


    public function list(): Tags
    {

        $tags =  self::find( [
            "order" => "name",
        ]);

        if ($tags) {
            return $tags;
        } else {
            throw new Exception('Records not found');
        }

    }

    public function add(Users $user, array $request): Tags
    {

        // Validating post request
        $validation = new Validation();
        $validation->add('name', new PresenceOf(['message' => _('The Name is required.')]));

        $exceptions = $validation->validate($request);
        if (count($exceptions)) {
            foreach ($exceptions as $exception) {
                throw new Exception($exception);
            }
        }

        $tags = new self();
        $tags->name =  $request['name'];
        $tags->users_id = $user->getId();
        $tags->companies_id = $user->currentCompanyId();
        $tags->apps_id = $user->currentCompanyId();


        if (!$tags->save()) {
            throw new Exception(current($tags->getMessages()));
        }

        return $tags;

    }


}
