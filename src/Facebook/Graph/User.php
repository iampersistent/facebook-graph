<?php
/**
 * MIT license
 */
namespace Facebook\Graph;

use Facebook\Graph\Owner;
/**
 * @author Richard Shank <develop@zestic.com>
 */
class User extends Owner
{
    private $firstName;
    private $middleName;
    private $lastName;
    private $gender;
    private $locale;
    private $languages;
    private $link;
    private $username;
    private $thirdPartyId;
    private $timezone;
    private $updatedTime;
    private $verified;
    private $bio;
    private $birthday;
    private $education;
    private $email;
    private $hometown;
    private $interestedIn;
    private $location;
    private $political;
    private $favoriteAthletes;
    private $favoriteTeams;
    private $quotes;
    private $relationshipStatus;
    private $religion;
    private $significantOther;
    private $videoUploadLimits;
    private $website;
    private $work;
    private $id;
    private $name;

    /**
     * The user's Facebook ID
     * permission none
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * The user's full name
     * permission none
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * The user's biography
     * requirements user_about_me or friends_about_me
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * A list of the user's education history
     * requirements user_education_history or friends_education_history
     * @return array of objects containing year and type fields, and school object (name, id, type, and optional year, degree, concentration array, classes array, and with array )
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * The user's favorite athletes; this field is deprecated and will be removed in the near future
     * requirements user_likes or friends_likes
     * @return array of objects containing id and name fields
     */
    public function getFavoriteAthletes()
    {
        return $this->favoriteAthletes;
    }
    /**
     * The user's first name
     * requirements No access_token required
     * @return string
    */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * The user's gender: female or male
     * requirements No access_token required
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * The genders the user is interested in
     * requirements user_relationship_details or friends_relationship_details
     * @return array containing strings
     */
    public function getInterestedIn()
    {
        return $this->interestedIn;
    }

    /**
     * The user's last name
     * requirements No access_token required
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * The user's languages
     * parameters user_likes
     * @return array of objects containing language id and name
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * The URL of the profile for the user on Facebook
     * requirements No access_token required
     * @return string containing a valid URL
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * The user's locale
     * requirements No access_token required
     * @return string containing the ISO Language Code and ISO Country Code
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * The user's current city
     * requirements user_location or friends_location
     * @return object containing name and id
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * The user's middle name
     * requirements No access_token required
     * @return string
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * The user's favorite quotes
     * requirements user_about_me or friends_about_me
     * @return string
     */
    public function getQuotes()
    {
        return $this->quotes;
    }

    /**
     * The user's significant other
     * requirements user_relationship_details or friends_relationship_details
     * @return object containing name and id
     */
    public function getSignificantOther()
    {
        return $this->significantOther;
    }

    /**
     * The last time the user's profile was updated; changes to the languages, link, timezone, verified, interested_in, favorite_athletes, favorite_teams, and video_upload_limits are not not reflected in this value
     * requirements access_token
     * @return DateTime
     */
    public function getUpdatedTime()
    {
        return $this->updatedTime;
    }

    /**
     * The user's Facebook username
     * requirements No access_token required
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * The size of the video file and the length of the video that a user can upload; only returned if specifically requested via the fields URL parameter
     * requirements Requires access_token
     * @return object containing length and size of video
     */
    public function getVideoUploadLimits()
    {
        return $this->videoUploadLimits;
    }

    /**
     * The URL of the user's personal website
     * requirements user_website or friends_website
     * @return string containing a valid URL
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * A list of the user's work history
     * requirements user_work_history or friends_work_history
     * @return array of objects containing employer, location, position, start_date and end_date fields
     */
    public function getWork()
    {
        return $this->work;
    }

    /**
     * The user's birthday
     * @return  string in MM/DD/YYYY format
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * The proxied or contact email address granted by the user
    email
     * @return string containing a valid RFC822 email address
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * The user's favorite teams; this field is deprecated and will be removed in the near future
     * requirements user_likes or friends_likes
     * @return array of objects containing id and name fields
     */
    public function getFavoriteTeams()
    {
        return $this->favoriteTeams;
    }

    /**
     * The user's hometown
     * requirements user_hometown or friends_hometown
     * @return object containing name and id
     */
    public function getHometown()
    {
        return $this->hometown;
    }

    /**
     * The user's political view
     * requirements user_religion_politics or friends_religion_politics
     * @return string
     */
    public function getPolitical()
    {
        return $this->political;
    }

    /**
     * The user's relationship status: Single, In a relationship, Engaged, Married, It's complicated, In an open relationship, Widowed, Separated, Divorced, In a civil union, In a domestic partnership
     * requirements user_relationships or friends_relationships
     * @return string
     */
    public function getRelationshipStatus()
    {
        return $this->relationshipStatus;
    }

    /**
     * The user's religion
     * requirements user_religion_politics or friends_religion_politics
     * @return string
     */
    public function getReligion()
    {
        return $this->religion;
    }

    /**
     * An anonymous, but unique identifier for the user; only returned if specifically requested via the fields URL parameter
     * requirements access_token
     * @return string
     */
    public function getThirdPartyId()
    {
        return $this->thirdPartyId;
    }

    /**
     * The user's timezone offset from UTC
     * Available only for the current user
     * @return number
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * The user's account verification status, either true or false (see below)
     * requirements access_token
     * @return boolean
     */
    public function getVerified()
    {
        return $this->verified;
    }
}