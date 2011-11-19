<?php
/**
 * MIT license
 */
namespace Facebook\Graph;

/**
 * @author Richard Shank <develop@zestic.com>
 */
class Event
{
    private $id;

    private $owner;

    private $name;

    private $description;

    private $startTime;
    private $endTime;
    private $location;

    private $venue;
    private $privacy;
    private $updated_time;

    /**
     * The long-form description of the event
     * permissions generic access_token, user_events or friends_events
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * The end time of the event, as you want it to be displayed on facebook
     * permissions generic access_token, user_events or friends_events
     * @return string containing an ISO-8601 formatted date/time or a UNIX timestamp; if it contains a time zone (not recommended), it will be converted to Pacific time before being stored and displayed
     */
    public function getEndTime()
    {
        return $this->end_time;
    }

    /**
     * The event ID
     * permissions generic access_token, user_events or friends_events
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * The location for this event
     * permissions generic access_token, user_events or friends_events
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * The event title
     * permissions generic access_token, user_events or friends_events
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * The profile that created the event
     * permissions generic access_token, user_events or friends_events
     * @return object containing id and name fields
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * The visibility of this event
    The visibility of this event
     * permissions generic access_token, user_events or friends_events
     * @return string containing 'OPEN', 'CLOSED', or 'SECRET'
     */
    public function getPrivacy()
    {
        return $this->privacy;
    }

    /**
     * The start time of the event, as you want it to be displayed on facebook
     * permissions generic access_token, user_events or friends_events
     * @return string containing an ISO-8601 formatted date/time or a UNIX timestamp; if it contains a time zone (not recommended), it will be converted to Pacific time before being stored and displayed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * The last time the event was updated
     * permissions generic access_token, user_events or friends_events
     * @return string containing ISO-8601 date-time
     */
    public function getUpdatedTime()
    {
        return $this->updated_time;
    }

    /**
     * The location of this event
     * permissions generic access_token, user_events or friends_events
     * @return object containing one or move of the following fields: street, city, state, zip, country, latitude, and longitude fields
    */
    public function getVenue()
    {
        return $this->venue;
    }
}
