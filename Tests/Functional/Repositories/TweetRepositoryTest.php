<?php
namespace Flowpack\TwitterApi\Tests\Functional\Repositories;

/**
 * Class TweetRepositoryTest
 *
 * @package Flowpack\TwitterApi\Tests\Functional\Repositories
 */
class TweetRepositoryTest extends \TYPO3\Flow\Tests\FunctionalTestCase {

	/**
	 * @test
	 */
	public function canFetchSingleTweetById() {
		/** @var \Flowpack\TwitterApi\Domain\Repository\TweetRepository $tweetRepository */
		$tweetRepository = $this->objectManager->get('Flowpack\TwitterApi\Domain\Repository\TweetRepository');

		$tweet = $tweetRepository->findOneById('564762919465132032');

		$this->assertEquals('Mon Feb 09 12:29:07 GMT+0000 2015', $tweet->getCreatedAt()->format('D M d H:i:s T Y'));
		$this->assertEquals('Just 12 followers short of a round 1K where is the missing dozen? :)', $tweet->getText());
		$this->assertEquals('daskitsunet', $tweet->getUser()->getScreenName());
	}

	/**
	 * @test
	 */
	public function searchTweetsWorks() {
		/** @var \Flowpack\TwitterApi\Domain\Repository\TweetRepository $tweetRepository */
		$tweetRepository = $this->objectManager->get('Flowpack\TwitterApi\Domain\Repository\TweetRepository');

		$searchResult = $tweetRepository->findByQuery('#TYPO3NEOS');

		$this->assertNotEmpty($searchResult);
		$this->assertContainsOnlyInstancesOf('Flowpack\TwitterApi\Domain\DataTransferObjects\Tweet', $searchResult);
		var_dump(count($searchResult));
	}
}