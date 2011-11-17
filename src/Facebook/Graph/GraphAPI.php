<?php
/**
 * MIT license
 */
namespace Facebook\Graph;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class GraphAPI
{
    private $facebook;

    public function __construct($facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * @param $facebookId
     * @param int $limit
     * @param null $time
     * @return array of IamPersistent\FacebookGraphBundle\Facebook\Post
     */
    public function fetchPosts($facebookId, $limit = 10, $time = null)
    {
        try {
            $api = sprintf('/%s/posts', $facebookId); // limit ?
            $posts = $this->facebook->api($api);
        } catch (\FacebookApiException $e) {
            $posts = array();
        }
        
        return $posts;
    }
}
