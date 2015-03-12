<?php
namespace Flowpack\TwitterApi\Domain\DataTransferObjects;

use TYPO3\Flow\Cache\CacheAwareInterface;

/**
 * User data container
 *
 * @see https://dev.twitter.com/overview/api/users
 */
class User implements CacheAwareInterface, TwitterApiObjectInterface {

	/**
	 * @var integer
	 */
	protected $id;

	/**
	 * @var string
	 */
	protected $id_str;

	/**
	 * @var boolean
	 */
	protected $contributors_enabled;

	/**
	 * @var \DateTime
	 */
	protected $created_at;

	/**
	 * @var boolean
	 */
	protected $default_profile;

	/**
	 * @var boolean
	 */
	protected $default_profile_image;

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * @var array
	 */
	protected $entities;

	/**
	 * @var integer
	 */
	protected $favourites_count;

	/**
	 * @var boolean
	 */
	protected $follow_request_sent;

	/**
	 * @var boolean
	 */
	protected $following;

	/**
	 * @var integer
	 */
	protected $followers_count;

	/**
	 * @var integer
	 */
	protected $friends_count;

	/**
	 * @var boolean
	 */
	protected $geo_enabled;

	/**
	 * @var boolean
	 */
	protected $is_translator;

	/**
	 * @var boolean
	 */
	protected $is_translation_enabled;

	/**
	 * @var string
	 */
	protected $lang;

	/**
	 * @var integer
	 */
	protected $listed_count;

	/**
	 * @var string
	 */
	protected $location;

	/**
	 * @var string
	 */
	protected $name;

	/**
	 * @var boolean
	 */
	protected $notifications;

	/**
	 * @var string
	 */
	protected $profile_background_color;

	/**
	 * @var string
	 */
	protected $profile_background_image_url;

	/**
	 * @var string
	 */
	protected $profile_background_image_url_https;

	/**
	 * @var boolean
	 */
	protected $profile_background_tile;

	/**
	 * @var string
	 */
	protected $profile_banner_url;

	/**
	 * @var string
	 */
	protected $profile_image_url;

	/**
	 * @var string
	 */
	protected $profile_image_url_https;

	/**
	 * @var string
	 */
	protected $profile_link_color;

	/**
	 * @var string
	 */
	protected $profile_sidebar_border_color;

	/**
	 * @var string
	 */
	protected $profile_sidebar_fill_color;

	/**
	 * @var string
	 */
	protected $profile_text_color;

	/**
	 * @var boolean
	 */
	protected $profile_use_background_image;

	/**
	 * @var boolean
	 */
	protected $protected;

	/**
	 * @var string
	 */
	protected $screen_name;

	/**
	 * @var boolean
	 */
	protected $show_all_inline_media;

	/**
	 * @var array
	 */
	protected $status;

	/**
	 * @var integer
	 */
	protected $statuses_count;

	/**
	 * @var string
	 */
	protected $time_zone;

	/**
	 * @var string
	 */
	protected $url;

	/**
	 * @var integer
	 */
	protected $utc_offset;

	/**
	 * @var boolean
	 */
	protected $verified;

	/**
	 * @var string
	 */
	protected $withheld_in_countries;

	/**
	 * @var string
	 */
	protected $withheld_scope;

	/**
	 * @var string
	 */
	protected $profile_location;

	/**
	 * @return int
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getIdStr() {
		return $this->id_str;
	}

	/**
	 * @param string $id_str
	 */
	public function setIdStr($id_str) {
		$this->id_str = $id_str;
	}

	/**
	 * @return boolean
	 */
	public function isContributorsEnabled() {
		return $this->contributors_enabled;
	}

	/**
	 * @param boolean $contributors_enabled
	 */
	public function setContributorsEnabled($contributors_enabled) {
		$this->contributors_enabled = $contributors_enabled;
	}

	/**
	 * @return \DateTime
	 */
	public function getCreatedAt() {
		return $this->created_at;
	}

	/**
	 * @param \DateTime $created_at
	 */
	public function setCreatedAt($created_at) {
		$this->created_at = $created_at;
	}

	/**
	 * @return boolean
	 */
	public function isDefaultProfile() {
		return $this->default_profile;
	}

	/**
	 * @param boolean $default_profile
	 */
	public function setDefaultProfile($default_profile) {
		$this->default_profile = $default_profile;
	}

	/**
	 * @return boolean
	 */
	public function isDefaultProfileImage() {
		return $this->default_profile_image;
	}

	/**
	 * @param boolean $default_profile_image
	 */
	public function setDefaultProfileImage($default_profile_image) {
		$this->default_profile_image = $default_profile_image;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param string $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * @return array
	 */
	public function getEntities() {
		return $this->entities;
	}

	/**
	 * @param array $entities
	 */
	public function setEntities($entities) {
		$this->entities = $entities;
	}

	/**
	 * @return int
	 */
	public function getFavouritesCount() {
		return $this->favourites_count;
	}

	/**
	 * @param int $favourites_count
	 */
	public function setFavouritesCount($favourites_count) {
		$this->favourites_count = $favourites_count;
	}

	/**
	 * @return boolean
	 */
	public function isFollowRequestSent() {
		return $this->follow_request_sent;
	}

	/**
	 * @param boolean $follow_request_sent
	 */
	public function setFollowRequestSent($follow_request_sent) {
		$this->follow_request_sent = $follow_request_sent;
	}

	/**
	 * @return boolean
	 */
	public function isFollowing() {
		return $this->following;
	}

	/**
	 * @param boolean $following
	 */
	public function setFollowing($following) {
		$this->following = $following;
	}

	/**
	 * @return int
	 */
	public function getFollowersCount() {
		return $this->followers_count;
	}

	/**
	 * @param int $followers_count
	 */
	public function setFollowersCount($followers_count) {
		$this->followers_count = $followers_count;
	}

	/**
	 * @return int
	 */
	public function getFriendsCount() {
		return $this->friends_count;
	}

	/**
	 * @param int $friends_count
	 */
	public function setFriendsCount($friends_count) {
		$this->friends_count = $friends_count;
	}

	/**
	 * @return boolean
	 */
	public function isGeoEnabled() {
		return $this->geo_enabled;
	}

	/**
	 * @param boolean $geo_enabled
	 */
	public function setGeoEnabled($geo_enabled) {
		$this->geo_enabled = $geo_enabled;
	}

	/**
	 * @return boolean
	 */
	public function isIsTranslator() {
		return $this->is_translator;
	}

	/**
	 * @param boolean $is_translator
	 */
	public function setIsTranslator($is_translator) {
		$this->is_translator = $is_translator;
	}

	/**
	 * @return string
	 */
	public function getLang() {
		return $this->lang;
	}

	/**
	 * @param string $lang
	 */
	public function setLang($lang) {
		$this->lang = $lang;
	}

	/**
	 * @return int
	 */
	public function getListedCount() {
		return $this->listed_count;
	}

	/**
	 * @param int $listed_count
	 */
	public function setListedCount($listed_count) {
		$this->listed_count = $listed_count;
	}

	/**
	 * @return string
	 */
	public function getLocation() {
		return $this->location;
	}

	/**
	 * @param string $location
	 */
	public function setLocation($location) {
		$this->location = $location;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return boolean
	 */
	public function isNotifications() {
		return $this->notifications;
	}

	/**
	 * @param boolean $notifications
	 */
	public function setNotifications($notifications) {
		$this->notifications = $notifications;
	}

	/**
	 * @return string
	 */
	public function getProfileBackgroundColor() {
		return $this->profile_background_color;
	}

	/**
	 * @param string $profile_background_color
	 */
	public function setProfileBackgroundColor($profile_background_color) {
		$this->profile_background_color = $profile_background_color;
	}

	/**
	 * @return string
	 */
	public function getProfileBackgroundImageUrl() {
		return $this->profile_background_image_url;
	}

	/**
	 * @param string $profile_background_image_url
	 */
	public function setProfileBackgroundImageUrl($profile_background_image_url) {
		$this->profile_background_image_url = $profile_background_image_url;
	}

	/**
	 * @return string
	 */
	public function getProfileBackgroundImageUrlHttps() {
		return $this->profile_background_image_url_https;
	}

	/**
	 * @param string $profile_background_image_url_https
	 */
	public function setProfileBackgroundImageUrlHttps($profile_background_image_url_https) {
		$this->profile_background_image_url_https = $profile_background_image_url_https;
	}

	/**
	 * @return boolean
	 */
	public function isProfileBackgroundTile() {
		return $this->profile_background_tile;
	}

	/**
	 * @param boolean $profile_background_tile
	 */
	public function setProfileBackgroundTile($profile_background_tile) {
		$this->profile_background_tile = $profile_background_tile;
	}

	/**
	 * @return string
	 */
	public function getProfileBannerUrl() {
		return $this->profile_banner_url;
	}

	/**
	 * @param string $profile_banner_url
	 */
	public function setProfileBannerUrl($profile_banner_url) {
		$this->profile_banner_url = $profile_banner_url;
	}

	/**
	 * @return string
	 */
	public function getProfileImageUrl() {
		return $this->profile_image_url;
	}

	/**
	 * @param string $profile_image_url
	 */
	public function setProfileImageUrl($profile_image_url) {
		$this->profile_image_url = $profile_image_url;
	}

	/**
	 * @return string
	 */
	public function getProfileImageUrlHttps() {
		return $this->profile_image_url_https;
	}

	/**
	 * @param string $profile_image_url_https
	 */
	public function setProfileImageUrlHttps($profile_image_url_https) {
		$this->profile_image_url_https = $profile_image_url_https;
	}

	/**
	 * @return string
	 */
	public function getProfileLinkColor() {
		return $this->profile_link_color;
	}

	/**
	 * @param string $profile_link_color
	 */
	public function setProfileLinkColor($profile_link_color) {
		$this->profile_link_color = $profile_link_color;
	}

	/**
	 * @return string
	 */
	public function getProfileSidebarBorderColor() {
		return $this->profile_sidebar_border_color;
	}

	/**
	 * @param string $profile_sidebar_border_color
	 */
	public function setProfileSidebarBorderColor($profile_sidebar_border_color) {
		$this->profile_sidebar_border_color = $profile_sidebar_border_color;
	}

	/**
	 * @return string
	 */
	public function getProfileSidebarFillColor() {
		return $this->profile_sidebar_fill_color;
	}

	/**
	 * @param string $profile_sidebar_fill_color
	 */
	public function setProfileSidebarFillColor($profile_sidebar_fill_color) {
		$this->profile_sidebar_fill_color = $profile_sidebar_fill_color;
	}

	/**
	 * @return string
	 */
	public function getProfileTextColor() {
		return $this->profile_text_color;
	}

	/**
	 * @param string $profile_text_color
	 */
	public function setProfileTextColor($profile_text_color) {
		$this->profile_text_color = $profile_text_color;
	}

	/**
	 * @return boolean
	 */
	public function isProfileUseBackgroundImage() {
		return $this->profile_use_background_image;
	}

	/**
	 * @param boolean $profile_use_background_image
	 */
	public function setProfileUseBackgroundImage($profile_use_background_image) {
		$this->profile_use_background_image = $profile_use_background_image;
	}

	/**
	 * @return boolean
	 */
	public function isProtected() {
		return $this->protected;
	}

	/**
	 * @param boolean $protected
	 */
	public function setProtected($protected) {
		$this->protected = $protected;
	}

	/**
	 * @return string
	 */
	public function getScreenName() {
		return $this->screen_name;
	}

	/**
	 * @param string $screen_name
	 */
	public function setScreenName($screen_name) {
		$this->screen_name = $screen_name;
	}

	/**
	 * @return boolean
	 */
	public function isShowAllInlineMedia() {
		return $this->show_all_inline_media;
	}

	/**
	 * @param boolean $show_all_inline_media
	 */
	public function setShowAllInlineMedia($show_all_inline_media) {
		$this->show_all_inline_media = $show_all_inline_media;
	}

	/**
	 * @return array
	 */
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param array $status
	 */
	public function setStatus($status) {
		$this->status = $status;
	}

	/**
	 * @return int
	 */
	public function getStatusesCount() {
		return $this->statuses_count;
	}

	/**
	 * @param int $statuses_count
	 */
	public function setStatusesCount($statuses_count) {
		$this->statuses_count = $statuses_count;
	}

	/**
	 * @return string
	 */
	public function getTimeZone() {
		return $this->time_zone;
	}

	/**
	 * @param string $time_zone
	 */
	public function setTimeZone($time_zone) {
		$this->time_zone = $time_zone;
	}

	/**
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * @param string $url
	 */
	public function setUrl($url) {
		$this->url = $url;
	}

	/**
	 * @return int
	 */
	public function getUtcOffset() {
		return $this->utc_offset;
	}

	/**
	 * @param int $utc_offset
	 */
	public function setUtcOffset($utc_offset) {
		$this->utc_offset = $utc_offset;
	}

	/**
	 * @return boolean
	 */
	public function isVerified() {
		return $this->verified;
	}

	/**
	 * @param boolean $verified
	 */
	public function setVerified($verified) {
		$this->verified = $verified;
	}

	/**
	 * @return string
	 */
	public function getWithheldInCountries() {
		return $this->withheld_in_countries;
	}

	/**
	 * @param string $withheld_in_countries
	 */
	public function setWithheldInCountries($withheld_in_countries) {
		$this->withheld_in_countries = $withheld_in_countries;
	}

	/**
	 * @return string
	 */
	public function getWithheldScope() {
		return $this->withheld_scope;
	}

	/**
	 * @param string $withheld_scope
	 */
	public function setWithheldScope($withheld_scope) {
		$this->withheld_scope = $withheld_scope;
	}

	/**
	 * @return string
	 */
	public function getProfileLocation() {
		return $this->profile_location;
	}

	/**
	 * @param string $profile_location
	 */
	public function setProfileLocation($profile_location) {
		$this->profile_location = $profile_location;
	}

	/**
	 * @return boolean
	 */
	public function isIsTranslationEnabled() {
		return $this->is_translation_enabled;
	}

	/**
	 * @param boolean $is_translation_enabled
	 */
	public function setIsTranslationEnabled($is_translation_enabled) {
		$this->is_translation_enabled = $is_translation_enabled;
	}

	/**
	 * Returns a string which distinctly identifies this object and thus can be used as an identifier for cache entries
	 * related to this object.
	 *
	 * @return string
	 */
	public function getCacheEntryIdentifier() {
		return $this->id_str;
	}


}