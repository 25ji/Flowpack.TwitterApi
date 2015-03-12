<?php
namespace Flowpack\TwitterApi\Domain\DataTransferObjects;

use TYPO3\Flow\Cache\CacheAwareInterface;

/**
 * Data container for tweets
 *
 * @see https://dev.twitter.com/overview/api/tweets
 */
class Tweet implements CacheAwareInterface, TwitterApiObjectInterface {

	/**
	 * @var integer
	 */
	protected $id;

	/**
	 * @var array
	 */
	protected $annotations;

	/**
	 * @var array
	 */
	protected $contributors;

	/**
	 * @var array
	 */
	protected $coordinates;

	/**
	 * @var array
	 */
	protected $current_user_retweet;

	/**
	 * @var array
	 */
	protected $entities;

	/**
	 * @var \DateTime
	 */
	protected $created_at;

	/**
	 * @var string
	 */
	protected $id_str;

	/**
	 * @var string
	 */
	protected $in_reply_to_screen_name;

	/**
	 * @var integer
	 */
	protected $in_reply_to_status_id;

	/**
	 * @var string
	 */
	protected $in_reply_to_status_id_str;

	/**
	 * @var integer
	 */
	protected $in_reply_to_user_id;

	/**
	 * @var string
	 */
	protected $in_reply_to_user_id_str;

	/**
	 * @var string
	 */
	protected $lang;

	/**
	 * @var integer
	 */
	protected $retweet_count;

	/**
	 * @var boolean
	 */
	protected $retweeted;

	/**
	 * @var integer
	 */
	protected $favorite_count;

	/**
	 * @var boolean
	 */
	protected $favorited;

	/**
	 * @var string
	 */
	protected $text;

	/**
	 * @var string
	 */
	protected $filter_level;

	/**
	 * @var array
	 */
	protected $place;

	/**
	 * @var boolean
	 */
	protected $possibly_sensitive;

	/**
	 * @var array
	 */
	protected $scopes;

	/**
	 * @var string
	 */
	protected $source;

	/**
	 * @var boolean
	 */
	protected $truncated;

	/**
	 * @var User
	 */
	protected $user;

	/**
	 * @var boolean
	 */
	protected $withheld_copyright;

	/**
	 * @var array
	 */
	protected $withheld_in_countries;

	/**
	 * @var array
	 */
	protected $withheld_scope;

	/**
	 * @var array
	 */
	protected $metadata;

	/**
	 * @var array
	 * @deprecated
	 */
	protected $geo;


	/**
	 * Returns a string which distinctly identifies this object and thus can be used as an identifier for cache entries
	 * related to this object.
	 *
	 * @return string
	 */
	public function getCacheEntryIdentifier() {
		return $this->id_str;
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
	 * @return string
	 */
	public function getInReplyToScreenName() {
		return $this->in_reply_to_screen_name;
	}

	/**
	 * @param string $in_reply_to_screen_name
	 */
	public function setInReplyToScreenName($in_reply_to_screen_name) {
		$this->in_reply_to_screen_name = $in_reply_to_screen_name;
	}

	/**
	 * @return string
	 */
	public function getInReplyToStatusIdStr() {
		return $this->in_reply_to_status_id_str;
	}

	/**
	 * @param string $in_reply_to_status_id_str
	 */
	public function setInReplyToStatusIdStr($in_reply_to_status_id_str) {
		$this->in_reply_to_status_id_str = $in_reply_to_status_id_str;
	}

	/**
	 * @return string
	 */
	public function getInReplyToUserIdStr() {
		return $this->in_reply_to_user_id_str;
	}

	/**
	 * @param string $in_reply_to_user_id_str
	 */
	public function setInReplyToUserIdStr($in_reply_to_user_id_str) {
		$this->in_reply_to_user_id_str = $in_reply_to_user_id_str;
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
	public function getRetweetCount() {
		return $this->retweet_count;
	}

	/**
	 * @param int $retweet_count
	 */
	public function setRetweetCount($retweet_count) {
		$this->retweet_count = $retweet_count;
	}

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
	 * @return array
	 */
	public function getAnnotations() {
		return $this->annotations;
	}

	/**
	 * @param array $annotations
	 */
	public function setAnnotations($annotations) {
		$this->annotations = $annotations;
	}

	/**
	 * @return array
	 */
	public function getContributors() {
		return $this->contributors;
	}

	/**
	 * @param array $contributors
	 */
	public function setContributors($contributors) {
		$this->contributors = $contributors;
	}

	/**
	 * @return array
	 */
	public function getCoordinates() {
		return $this->coordinates;
	}

	/**
	 * @param array $coordinates
	 */
	public function setCoordinates($coordinates) {
		$this->coordinates = $coordinates;
	}

	/**
	 * @return array
	 */
	public function getCurrentUserRetweet() {
		return $this->current_user_retweet;
	}

	/**
	 * @param array $current_user_retweet
	 */
	public function setCurrentUserRetweet($current_user_retweet) {
		$this->current_user_retweet = $current_user_retweet;
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
	public function getInReplyToStatusId() {
		return $this->in_reply_to_status_id;
	}

	/**
	 * @param int $in_reply_to_status_id
	 */
	public function setInReplyToStatusId($in_reply_to_status_id) {
		$this->in_reply_to_status_id = $in_reply_to_status_id;
	}

	/**
	 * @return int
	 */
	public function getInReplyToUserId() {
		return $this->in_reply_to_user_id;
	}

	/**
	 * @param int $in_reply_to_user_id
	 */
	public function setInReplyToUserId($in_reply_to_user_id) {
		$this->in_reply_to_user_id = $in_reply_to_user_id;
	}

	/**
	 * @return boolean
	 */
	public function isRetweeted() {
		return $this->retweeted;
	}

	/**
	 * @param boolean $retweeted
	 */
	public function setRetweeted($retweeted) {
		$this->retweeted = $retweeted;
	}

	/**
	 * @return int
	 */
	public function getFavoriteCount() {
		return $this->favorite_count;
	}

	/**
	 * @param int $favorite_count
	 */
	public function setFavoriteCount($favorite_count) {
		$this->favorite_count = $favorite_count;
	}

	/**
	 * @return boolean
	 */
	public function isFavorited() {
		return $this->favorited;
	}

	/**
	 * @param boolean $favorited
	 */
	public function setFavorited($favorited) {
		$this->favorited = $favorited;
	}

	/**
	 * @return string
	 */
	public function getFilterLevel() {
		return $this->filter_level;
	}

	/**
	 * @param string $filter_level
	 */
	public function setFilterLevel($filter_level) {
		$this->filter_level = $filter_level;
	}

	/**
	 * @return array
	 */
	public function getPlace() {
		return $this->place;
	}

	/**
	 * @param array $place
	 */
	public function setPlace($place) {
		$this->place = $place;
	}

	/**
	 * @return boolean
	 */
	public function isPossiblySensitive() {
		return $this->possibly_sensitive;
	}

	/**
	 * @param boolean $possibly_sensitive
	 */
	public function setPossiblySensitive($possibly_sensitive) {
		$this->possibly_sensitive = $possibly_sensitive;
	}

	/**
	 * @return array
	 */
	public function getScopes() {
		return $this->scopes;
	}

	/**
	 * @param array $scopes
	 */
	public function setScopes($scopes) {
		$this->scopes = $scopes;
	}

	/**
	 * @return array
	 */
	public function getGeo() {
		return $this->geo;
	}

	/**
	 * @param array $geo
	 */
	public function setGeo($geo) {
		$this->geo = $geo;
	}

	/**
	 * @return string
	 */
	public function getText() {
		return $this->text;
	}

	/**
	 * @param string $text
	 */
	public function setText($text) {
		$this->text = $text;
	}

	/**
	 * @return boolean
	 */
	public function isTruncated() {
		return $this->truncated;
	}

	/**
	 * @param boolean $truncated
	 */
	public function setTruncated($truncated) {
		$this->truncated = $truncated;
	}

	/**
	 * @return User
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * @param User $user
	 */
	public function setUser($user) {
		$this->user = $user;
	}

	/**
	 * @return boolean
	 */
	public function isWithheldCopyright() {
		return $this->withheld_copyright;
	}

	/**
	 * @param boolean $withheld_copyright
	 */
	public function setWithheldCopyright($withheld_copyright) {
		$this->withheld_copyright = $withheld_copyright;
	}

	/**
	 * @return array
	 */
	public function getWithheldInCountries() {
		return $this->withheld_in_countries;
	}

	/**
	 * @param array $withheld_in_countries
	 */
	public function setWithheldInCountries($withheld_in_countries) {
		$this->withheld_in_countries = $withheld_in_countries;
	}

	/**
	 * @return array
	 */
	public function getWithheldScope() {
		return $this->withheld_scope;
	}

	/**
	 * @param array $withheld_scope
	 */
	public function setWithheldScope($withheld_scope) {
		$this->withheld_scope = $withheld_scope;
	}

	/**
	 * @return string
	 */
	public function getSource() {
		return $this->source;
	}

	/**
	 * @param string $source
	 */
	public function setSource($source) {
		$this->source = $source;
	}

	/**
	 * @return array
	 */
	public function getMetadata() {
		return $this->metadata;
	}

	/**
	 * @param array $metadata
	 */
	public function setMetadata($metadata) {
		$this->metadata = $metadata;
	}
}