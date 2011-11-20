# Facebook Graph API

[![Build Status](https://secure.travis-ci.org/IamPersistent/facebook-graph.png)](http://travis-ci.org/IamPersistent/facebook-graph)

Use GraphAPI to retrieve data from Facebook and return that data in objects.

### Install

    git clone git://github.com/IamPersistent/facebook-graph.git
    cd facebook-graph
    git submodule update --init

### Usage

    require('facebook.php');

    $facebookSdk = new \Facebook(array(
        'appId'  => id,
        'secret' => secret,
    ));
    $api = new \Facebook\Graph\GraphAPI($facebookSdk);

    $posts = $api->fetchPosts('eight53');
    $events = $api->fetchEvents('eight53');

### Todo

 * Add functional tests for fetch*() functions
 * Add methods to api to write
 * Create classes for the following Facebook objects
    * Achievement(Instance)
    * Album
    * Application
    * Checkin
    * Comment
    * Domain
    * FriendList
    * Group
    * Insights
    * Link
    * Message
    * Note
    * Order
    * Page
    * Photo
    * Question
    * QuestionOption
    * Review
    * Subscription
    * Thread
    * User
    * Video

### References
[http://developers.facebook.com/docs/reference/api/]