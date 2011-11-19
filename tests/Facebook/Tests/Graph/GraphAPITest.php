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

    protected function getGraphAPI()
    {
        return new GraphAPI($this->getFacebook());
    }
}
