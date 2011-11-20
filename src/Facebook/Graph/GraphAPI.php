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
     * Fetch the posts from an id page
     * 
     * @param string $facebookId the id for the page to retrieve the posts
     * @param int $limit // todo
     * @param null $time // todo
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
            $methodName = 'get' . ucfirst($propertyName);
            $method = $rc->getMethod($methodName);
            if ($returnObject = $this->getReturnObject($method)) {
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
