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

        $object = new Facebook\Tests\Fixtures\Annotation();
        $rc = new \ReflectionClass($object);

        $method = $rc->getMethod('noClass');
        $this->assertFalse($graphAPI->getReturnObject($method));

        $method = $rc->getMethod('myAwesomeClass');
        $this->assertSame('My\\Awesome\\Class', $method);
    }

    protected function getGraphAPI()
    {
        return new GraphAPI($this->getFacebook(), new DocParser());
    }
}
