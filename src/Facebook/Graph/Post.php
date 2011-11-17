<?php
/**
 * MIT license
 */
namespace Facebook\Graph;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class Post
{
    private $id;
    private $from;
    private $to;
    private $message;
    private $messageTags;
    private $picture;
    private $link;
    private $name;
    private $caption;
    private $description;
    private $source;
    private $properties;
    private $icon;
    private $actions;
    private $privacy;
    private $type;
    private $likes;
    private $place;
    private $story;
    private $storyTags;
    private $comments;
    private $objectId;
    private $application;
    private $createdTime;
    private $updatedTime;
    private $targeting;

    /**
     * A list of available actions on the post (including commenting, liking, and an optional app-specified action)
     * Requires access_token
     * @return array of objects containing the name and link
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Information about the application this post came from
     * read_stream
     * @return object containing the name and id of the application
     */
    public function getApplication()
    {
        return $this->application;
    }

    /**
     * The caption of the link (appears beneath the link name)
     * Requires access_token
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * Comments for this post
     * read_stream
     * @return Structure containing a data object containing an array of objects, each with the id, from, message, and created_time for each comment
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * The time the post was initially published
     * read_stream
     * @return string containing ISO-8601 date-time
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * A description of the link (appears beneath the link caption)
     * Requires access_token
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     *
     * Information about the user who posted the message
     * Requires access_token
     * @returns object containing the name and Facebook id of the user who posted the message
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * A link to an icon representing the type of this post
     * Requires access_token
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Likes for this post
     * Requires access_token
     * @return Structure containing a data object and the number of total likes, with data containing an array of objects, each with the name and Facebook id of the user who liked the post
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * The link attached to this post
     * Requires access_token
     * @return string containing the URL
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * The message
     * Requires access_token
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
    /**
     * Objects tagged in the message (Users, Pages, etc)
     * Requires access_token
     * @return object containing fields whose names are the indexes to where objects are mentioned in the message field; each field in turn is an array containing an object with id, name, offset, and length fields, where length is the length, within the message field, of the object mentioned
     */
    public function getMessageTags()
    {
        return $this->messageTags;
    }

    /**
     * The name of the link
     * Requires access_token
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * The Facebook object id for an uploaded photo or video
     * read_stream
     * @return number
     */
    public function getObjectId()
    {
        return $this->objectId;
    }

    /**
     * If available, a link to the picture included with this post
     * Requires access_token
     * @return string containing the URL
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Location associated with a Post, if any
     * read_stream
     * @return object containing id and name of Page associated with this location, and a location field containing geographic information such as latitude, longitude, country, and other fields (fields will vary based on geography and availability of information)
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Return the post id
     *
     * requires access token
     * @return string The post ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * The privacy settings of the Post
     *
     * The value field may specify one of the following strings: EVERYONE, ALL_FRIENDS, NETWORKS_FRIENDS, FRIENDS_OF_FRIENDS, CUSTOM .

    The friends field must be specified if value is set to CUSTOM and contain one of the following strings: EVERYONE, NETWORKS_FRIENDS (when the object can be seen by networks and friends), FRIENDS_OF_FRIENDS, ALL_FRIENDS, SOME_FRIENDS, SELF, or NO_FRIENDS (when the object can be seen by a network only).

    The networks field may contain a comma-separated list of network IDs that can see the object, or 1 for all of a user's network.

    The allow field must be specified when the friends value is set to SOME_FRIENDS and must specify a comma-separated list of user IDs and friend list IDs that 'can' see the post.

    The deny field may be specified if the friends field is set to SOME_FRIENDS and must specify a comma-separated list of user IDs and friend list IDs that 'cannot' see the post.

    Note: This privacy setting only applies to posts to the current or specified user's own Wall. Facebook ignores this setting for targeted Wall posts (when the user is writing on the Wall of a friend, Page, event, group connected to the user). Consistent with behavior on Facebook, all targeted posts are viewable by anyone who can see the target's Wall.

    Privacy Policy: Any non-default privacy setting must be intentionally chosen by the user
     *
     * read_stream
     * @return object containing the value field and optional friends, networks, allow and deny fields.
     */
    public function getPrivacy()
    {
        return $this->privacy;
    }

    /**
     * A list of properties for an uploaded video, for example, the length of the video
     * Requires access_token
     * @return array of objects containing the name and text
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * A URL to a Flash movie or video file to be embedded within the post
     * Requires access_token
     * @return string containing the URL
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Text of stories not intentionally generated by users, such as those generated when two users become friends; you must have the "Include recent activity stories" migration enabled in your app to retrieve these stories
     * read_stream
     * @return string
     */
    public function getStory()
    {
        return $this->story;
    }

    /**
     * Objects (Users, Pages, etc) tagged in a non-intentional story; you much have the "Include recent activity stories" migration enabled in your app to retrieve these tags
     * read_stream
     * @return object containing fields whose names are the indexes to where objects are mentioned in the message field; each field in turn is an array containing an object with id, name, offset, and length fields, where length is the length, within the message field, of the object mentioned
     */
    public function getStoryTags()
    {
        return $this->storyTags;
    }

    /**
     * Location and language restrictions for Page posts only
     * manage_pages
     * @return object containing comma separated lists of valid country , city , region and locale
     */
    public function getTargeting()
    {
        return $this->targeting;
    }

    /**
     * Profiles mentioned or targeted in this post
     * @permissions Requires access_token
     * @return Contains in data an array of objects, each with the name and Facebook id of the user
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * A string indicating the type for this post (including link, photo, video)
     * Requires access_token
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * The time of the last comment on this post
     * read_stream
     * @return string containing ISO-8601 date-time
     */
    public function getUpdatedTime()
    {
        return $this->updatedTime;
    }
}
