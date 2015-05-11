<?php
namespace Flowpack\TwitterApi\Command;

/*                                                                        *
 * This script belongs to the TYPO3 Flow framework.                       *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Cli\CommandController;


/**
 * Command controller for managing caches
 *
 * NOTE: This command controller will run in compile time (as defined in the package bootstrap)
 *
 * @Flow\Scope("singleton")
 */
class TestCommandController extends CommandController {

	/**
	 * @Flow\Inject
	 * @var \Flowpack\TwitterApi\Authentication\Application
	 */
	protected $applicationAuthenticator;

	/**
	 * @Flow\Inject
	 * @var \Flowpack\TwitterApi\Domain\Repository\TweetRepository
	 */
	protected $tweetRepository;

	/**
	 * Test auth
	 */
	public function testAuthCommand() {
		$this->outputLine($this->applicationAuthenticator->getToken());
		$this->sendAndExit(0);
	}

	/**
	 * @param string $query
	 */
	public function searchByQueryCommand($query) {
		$tweets = $this->tweetRepository->findByQuery($query);
		foreach ($tweets as $tweet) {
			$this->outputLine('---------------------------------');
			$this->outputLine($tweet->getCreatedAt()->format('Y-m-d'));
			$this->outputLine($tweet->getText());
		}
		$this->sendAndExit();
	}

}
