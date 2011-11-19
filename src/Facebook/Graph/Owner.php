<?php
/**
 * MIT license
 */
namespace Facebook\Graph;

/**
 * Owner is not an actual Facebook object, it is used for identifying a User, when only the id and name are passed back
 *
 * @author Richard Shank <develop@zestic.com>
 */
class Owner
{
    private $id;
    private $name;

    /**
     * The user's Facebook ID
     * permission none
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * The user's full name
     * permission none
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}
