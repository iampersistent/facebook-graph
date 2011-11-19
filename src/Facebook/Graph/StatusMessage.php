<?php
/**
 * MIT license
 */
namespace Facebook\Graph;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class StatusMessage
{
    private $id;
    private $from;
    private $message;
    private $updatedTime;
    private $type;

    /**
     * The user who posted the message
     * permissions access_token
     * @return Facebook\Graph\Owner containing id and name fields
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * The status message ID
     * permissions access_token
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * The status message content
     * permissions access_token
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * The object type which is set to status
     * permissions access_token
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * The time the message was published
     * permissions access_token
     * @return string containing ISO-8601 date-time
     */
    public function getUpdatedTime()
    {
        return $this->updatedTime;
    }
}
