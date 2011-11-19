<?php
/**
 * MIT license
 */
namespace Facebook\Tests;

require_once __DIR__.'/../../../src/vendor/facebook-php-sdk/src/facebook.php';

/**
 * @author Richard Shank <develop@zestic.com>
 */
class TestCommon extends \PHPUnit_Framework_TestCase
{
    const APP_ID = '117743971608120';
    const SECRET = '943716006e74d9b9283d4d5d8ab93204';

    protected function getFacebook()
    {
        return new \Facebook(array(
            'appId'  => self::APP_ID,
            'secret' => self::SECRET,
        ));
    }
}
