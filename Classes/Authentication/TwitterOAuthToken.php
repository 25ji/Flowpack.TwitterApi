<?php
namespace Flowpack\TwitterApi\Authentication;

use TYPO3\Flow\Annotations as Flow;

/**
 * Class TwitterOAuthToken
 *
 * @package Flowpack\TwitterApi\Authentication
 */
class TwitterOAuthToken extends \TYPO3\Flow\Security\Authentication\Token\AbstractToken {

	/**
	 * The username/password credentials
	 *
	 * @var array
	 * @Flow\Transient
	 */
	protected $credentials = array('oauth_token' => '', 'oauth_verifier' => '');

	/**
	 * Updates the authentication credentials, the authentication manager needs to authenticate this token.
	 * This could be a username/password from a login controller.
	 * This method is called while initializing the security context. By returning TRUE you
	 * make sure that the authentication manager will (re-)authenticate the tokens with the current credentials.
	 * Note: You should not persist the credentials!
	 *
	 * @param \TYPO3\Flow\Mvc\ActionRequest $actionRequest The current request instance
	 * @return boolean TRUE if this token needs to be (re-)authenticated
	 */
	public function updateCredentials(\TYPO3\Flow\Mvc\ActionRequest $actionRequest) {
		$getArguments = $actionRequest->getArguments();

		if (isset($getArguments['oauth_token']) && isset($getArguments['oauth_verifier'])) {
			$this->credentials = array('oauth_token' => $getArguments['oauth_token'], 'oauth_verifier' => $getArguments['oauth_verifier']);
			$this->setAuthenticationStatus(self::AUTHENTICATION_NEEDED);
		}
	}

}