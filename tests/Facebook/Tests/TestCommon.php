<?php
/**
 * MIT license
 */

namespace Facebook\Tests;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class TestCommon extends \PHPUnit_Framework_TestCase
{
    const APP_ID = '117743971608120';
    const SECRET = '9c8ea2071859659bea1246d33a9207cf';

    const TEST_USER   = 499834690;
    const TEST_USER_2 = 499835484;

    protected $facebook;

    protected function getFacebook()
    {
        if (!$this->facebook) {
            $this->facebook = new \Facebook(array(
                'appId'  => self::APP_ID,
                'secret' => self::SECRET,
            ));
        }

        return $this->facebook;
    }
}
