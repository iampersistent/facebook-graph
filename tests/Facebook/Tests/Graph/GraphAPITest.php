<?php
/**
 * MIT license
 */
namespace Facebook\Tests\Graph;

use Facebook\Tests\TestCommon;
use Facebook\Graph\GraphAPI;
use Doctrine\Common\Annotations\DocParser;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class GraphAPITest extends TestCommon
{
    public function testFetchReturnClass()
    {
        $graphAPI = $this->getGraphAPI();
        $graphAPIRC = new \ReflectionClass($graphAPI);
        $getReturnObject = $graphAPIRC->getMethod('getReturnObject');
        $getReturnObject->setAccessible(true);

        $object = new \Facebook\Tests\Fixtures\Annotation();
        $annotationRC = new \ReflectionClass($object);

        $method = $annotationRC->getMethod('noClass');
        $this->assertFalse($getReturnObject->invoke($graphAPI, $method));

        $method = $annotationRC->getMethod('myAwesomeClass');
        $this->assertSame('\\Facebook\\Tests\\Fixtures\\Awesome', $getReturnObject->invoke($graphAPI, $method));


    }

    public function testMapDataToObject()
    {
        $graphAPI = $this->getGraphAPI();
        $graphAPIRC = new \ReflectionClass($graphAPI);
        $mapDataToObject = $graphAPIRC->getMethod('mapDataToObject');
        $mapDataToObject->setAccessible(true);

        $data = array(
            'date' => '2011-11-13T19:00:00',
            'from' => array(
                'id' => '12345',
                'name' => 'Karl Childers'
            ),
            'message' => "Mustard's good to me",
        );

        $note = new \Facebook\Tests\Fixtures\Note();
        $mapDataToObject->invokeArgs($graphAPI, array($data, &$note));

        $this->assertSame("Mustard's good to me", $note->getMessage(), 'the message should be mapped as a string');
        $from = $note->getFrom();
        $this->assertInstanceOf('\\Facebook\\Tests\\Fixtures\\Owner', $from, 'from should be mapped as an owner object');
        $this->assertEquals('12345', $from->getId());
        $this->assertSame('Karl Childers', $from->getName());
        $this->assertInstanceOf('\\DateTime', $note->getDate());

        $data = array(
            'property' => 'does not exist',
            'message' => 'this should be there',
        );
        $note = new \Facebook\Tests\Fixtures\Note();

        try {
            $mapDataToObject->invokeArgs($graphAPI, array($data, &$note));
        } catch (\ReflectionException $e) {
            $this->fail('a missing property in mapping should just be skipped');
        }
        $this->assertSame('this should be there', $note->getMessage());
    }

    public function testFindObjectFromUrl()
    {
        $api = $this->getGraphAPI();

        $eight53 = $api->findObjectFromUrl('153643058005174');
        $this->assertSame('153643058005174', $eight53['id'], 'just passing in an id should find the id data');
        // todo:
        // $this->assertSame('153643058005174', $eight53->getId(), 'just passing in an id should find the id data');
        // $this->assertInstanceOf('\\Facebook\\Graph\\Page', $eight53, 'return a page object for this');

        $eight53 = $api->findObjectFromUrl('eight53');
        $this->assertSame('153643058005174', $eight53['id'], 'just passing in a username should find the id data');
        // todo:
        // $this->assertSame($eight53->getId(), 'just passing in a username should find the id data');

        $eight53 = $api->findObjectFromUrl('www.facebook.com/eight53');
        $this->assertSame('153643058005174', $eight53['id'], 'passing in a full username url should find the id data');
        // todo:
        // $this->assertSame($eight53->getId(), 'passing in a full username url should find the id data');

        $iampersistent = $api->findObjectFromUrl('profile.php?id=1377008931');
        $this->assertSame('1377008931', $iampersistent['id'], 'just passing in a profile.php?id=1377008931 should find the id data');
        // todo:
        // $this->assertSame('1377008931', $iampersistent->getId(), 'just passing in a profile.php?id=1377008931 should find the id data');
        // $this->assertInstanceOf('\\Facebook\\Graph\\User', $iampersistent, 'return a user object for this');

        $iampersistent = $api->findObjectFromUrl('http://facebook.com/profile.php?id=1377008931');
        $this->assertSame('1377008931', $iampersistent['id'], 'passing in a full profile.php?id=1377008931 url should find the id data');
        // todo:
        // $this->assertSame('1377008931', $iampersistent->getId(), 'passing in a full profile.php?id=1377008931 url should find the id data');

        $eight53 = $api->findObjectFromUrl('pages/irrelevant/153643058005174');
        $this->assertSame('153643058005174', $eight53['id'], 'just passing in pages/irrelevant/153643058005174 should find the eight53 data');
        // todo:
        // $this->assertSame($eight53->getId(), 'just passing in pages/irrelevant/153643058005174 should find the eight53 data');

        $eight53 = $api->findObjectFromUrl('facebook.com/pages/irrelevant/153643058005174');
        $this->assertSame('153643058005174', $eight53['id'], 'passing in a full pages/irrelevant/153643058005174 should find the eight53 data');
        // todo:
        // $this->assertSame($eight53->getId(), 'passing in a full pages/irrelevant/153643058005174 should find the eight53 data');

        $eight53 = $api->findObjectFromUrl('http://facebook.com/pages/irrelevant/153643058005174');
        $this->assertSame('153643058005174', $eight53['id'], 'passing in a full pages/irrelevant/153643058005174 should find the eight53 data');
        // todo:
        // $this->assertSame($eight53->getId(), 'passing in a full pages/irrelevant/153643058005174 should find the eight53 data');

        $nothing = $api->findObjectFromUrl('there-is-no-way-in-hell-someone-has-this-as-a-username');
        $this->assertNull($nothing, 'bogus data should return null');
    }

    protected function getGraphAPI()
    {
        return new GraphAPI($this->getFacebook());
    }
}
