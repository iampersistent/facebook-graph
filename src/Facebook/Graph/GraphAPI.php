<?php
/**
 * MIT license
 */
namespace Facebook\Graph;

use Facebook\Graph\Event;
use Facebook\Graph\Post;
use Facebook\Graph\User;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class GraphAPI
{
    private $facebook;
    private $lexer;
    private $parser;
    private $reader;

    public function __construct($facebook)
    {
        $this->facebook = $facebook;
        $this->lexer =  new \Doctrine\Common\Annotations\DocLexer();
        $this->parser = new \Doctrine\Common\Annotations\DocParser();
        $this->parser->setImports(array('@return'));

        $this->reader = new \Doctrine\Common\Annotations\AnnotationReader(
            new \Doctrine\Common\Cache\ApcCache(),
            new \Doctrine\Common\Annotations\DocParser()
        );
    }

    /**
     * Fetch the events from an id page
     * 
     * @param string $facebookId the id for the page to retrieve the events
     * @param array querying parameters
     *        - limit
     *        - offset
     *        - since (a unix timestamp or any date accepted by strtotime)
     *        - until (a unix timestamp or any date accepted by strtotime)
     *
     * @return array of Facebook\Graph\Event
     */
    public function fetchEvents($facebookId, $parameters = array())
    {
        $api = sprintf('/%s/events', $facebookId);
        return $this->fetchData($api, 'Facebook\\Graph\\Event', $parameters);
    }

    /**
     * Fetch the posts from an id page
     *
     * @param string $facebookId the id for the page to retrieve the posts
     * @param array querying parameters
     *        - limit defaults to 10
     *        - offset
     *        - since (a unix timestamp or any date accepted by strtotime) defaults to "-1 day"
     *        - until (a unix timestamp or any date accepted by strtotime)
     * @return array of Facebook\Graph\Post
     */
    public function fetchPosts($facebookId, $parameters = array())
    {
        $api = sprintf('/%s/posts', $facebookId);
        return $this->fetchData($api, 'Facebook\\Graph\\Post', $parameters);
    }

    /**
     * Fetch the user from an id
     *
     * @param string $facebookId the id for the page to retrieve the posts
     * @return array of Facebook\Graph\User
     */
    public function fetchUser($facebookId)
    {
        $api = sprintf('/%s', $facebookId);
        try {
            $data = $this->facebook->api($api);
        } catch (\FacebookApiException $e) {
            return array();
        }

        return $this->mapDataToObject($data, new User());
    }

    protected function fetchData($api, $objectClass, $parameters)
    {
        $parameters = array_merge(array('limit' => 10, 'since' => '-1 week'), $parameters);
        $api = $api . '?' . http_build_query($parameters);
        try {
            $raw = $this->facebook->api($api);
        } catch (\FacebookApiException $e) {
            return array();
        }

        $objects = array();
        foreach ($raw['data'] as $data) {
            $object = new $objectClass();
            $objects[] = $this->mapDataToObject($data, $object);
        }

        return $objects;
    }

    protected function mapDataToObject($data, &$object)
    {
        $rc = new \ReflectionClass($object);
        foreach ($data as $field => $value) {
            $propertyName = preg_replace('/_(.?)/e', "strtoupper('$1')", $field);
            try {
                $property = $rc->getProperty($propertyName);
            } catch (\ReflectionException $e) {
                continue;
            }
            $property->setAccessible(true);
            $methodName = 'get' . ucfirst($propertyName);
            $method = $rc->getMethod($methodName);
            if ($returnObject = $this->getReturnObject($method)) {
                if ($returnObject == "\\DateTime") {
                    $property->setValue($object, new $returnObject($data[$field]));
                    continue;
                }
                $newObject = new $returnObject;
                $this->mapDataToObject($value, $newObject);
                $property->setValue($object, $newObject);
            } else {
                $property->setValue($object, $value);
            }
        }
        return $object;
    }

    protected function getReturnObject(\ReflectionMethod $method)
    {
        $comment = $method->getDocComment();
        $this->lexer->setInput($comment);
        $object = null;
        while ($this->lexer->moveNext() && !$object) {
            $this->lexer->skipUntil(\Doctrine\Common\Annotations\DocLexer::T_AT);
            $this->lexer->moveNext();
            if ($this->lexer->lookahead['value'] == 'return') {
                $this->lexer->moveNext();
                $object = '\\';
                do {
                    $object = $object . $this->lexer->lookahead['value'];
                    $this->lexer->moveNext();
                } while ($this->lexer->lookahead['value'] != '/');
            }
        }
        return class_exists($object) ? $object : false;
    }
}
