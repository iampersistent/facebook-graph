<?php
/**
 * MIT license
 */
namespace Facebook\Graph;

use Facebook\Graph\Post;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class GraphAPI
{
    private $facebook;
    private $parser;
    private $reader;

    public function __construct($facebook)
    {
        $this->facebook = $facebook;
        $this->parser =             new \Doctrine\Common\Annotations\DocParser();

        $this->reader = new \Doctrine\Common\Annotations\AnnotationReader(
            new \Doctrine\Common\Cache\ApcCache(),
            new \Doctrine\Common\Annotations\DocParser()
        );
    }

    /**
     * Fetch the post
     * 
     * @param $facebookId
     * @param int $limit
     * @param null $time
     * @return array of IamPersistent\FacebookGraphBundle\Facebook\Post
     */
    public function fetchPosts($facebookId, $limit = 10, $time = null)
    {
        try {
            $api = sprintf('/%s/posts', $facebookId); // limit ?
            $raw = $this->facebook->api($api);
        } catch (\FacebookApiException $e) {
            return array();
        }

        $posts = array();
        foreach ($raw['data'] as $data) {
            if (!$limit) {
                break;
            }
            $post = new Post();
            $posts[] = $this->mapDataToObject($data, $post);
            $limit--;
        }

        return $posts;
    }

    protected function mapDataToObject($data, &$object)
    {
        $rc = new \ReflectionClass($object);
        foreach ($data as $field => $value) {
            $propertyName = preg_replace('/_(.?)/e', "strtoupper('$1')", $field);
            $property = $rc->getProperty($propertyName);
            $property->setAccessible(true);
            $property->setValue($object, $value);
            $methodName = 'get' . ucfirst($propertyName);
            $method = $rc->getMethod($methodName);
            $comment = $method->getDocComment();
            $parsed = $this->parser->parse($comment);
            $a = 0;
        }
        return $object;
    }

    
}
