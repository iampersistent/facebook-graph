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

    protected function getGraphAPI()
    {
        return new GraphAPI($this->getFacebook());
    }
}
