<?php
namespace Flowpack\TwitterApi\Domain\Repository;

use Flowpack\TwitterApi\Domain\DataTransferObjects\Tweet;
use TYPO3\Flow\Annotations as Flow;

/**
 * Repository for tweets
 *
 * @Flow\Scope("singleton")
 */
class TweetRepository extends AbstractApiRepository {

	protected $baseUri = 'https://api.twitter.com/1.1/statuses/';

	/**
	 * Find one tweet by id
	 *
	 * @param string $id
	 * @return Tweet
	 */
	public function findOneById($id) {
		$response = $this->get($this->baseUri . 'show.json', array('id' => $id));

		return $this->mapResponseToObjects($response, Tweet::class);
	}

	/**
	 * @param string $query
	 * @return array<Tweet>
	 */
	public function findByQuery($query) {
		$response = $this->get('https://api.twitter.com/1.1/search/tweets.json', array('q' => $query));
		$data = json_decode($response->getContent(), TRUE);

		return $this->mapToObjects($data['statuses'], 'array<\\' . Tweet::class . '>');
	}


}