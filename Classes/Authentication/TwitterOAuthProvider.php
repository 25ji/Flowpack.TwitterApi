<?php
namespace Flowpack\TwitterApi\Authentication;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Http\Client\RequestEngineInterface;
use TYPO3\Flow\Http\Request;
use TYPO3\Flow\Http\Uri;
use TYPO3\Flow\Reflection\ObjectAccess;
use TYPO3\Flow\Security\Account;
use TYPO3\Flow\Security\AccountRepository;
use TYPO3\Flow\Security\Authentication\Provider\AbstractProvider;
use TYPO3\Flow\Security\Authentication\TokenInterface;
use TYPO3\Flow\Security\Context;
use TYPO3\Flow\Security\Exception\UnsupportedAuthenticationTokenException;
use TYPO3\Flow\Security\Policy\PolicyService;

/**
 * Class TwitterOAuthProvider
 *
 * @package Flowpack\TwitterApi\Authentication
 */
class TwitterOAuthProvider extends AbstractProvider {

	/**
	 * @Flow\Inject
	 * @var RequestSignatureGenerator
	 */
	protected $requestSignatureGenerator;

	/**
	 * @Flow\Inject
	 * @var AccountRepository
	 */
	protected $accountRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Persistence\PersistenceManagerInterface
	 */
	protected $persistenceManager;

	/**
	 * @Flow\Inject
	 * @var RequestEngineInterface
	 */
	protected $requestEngine;

	/**
	 * @Flow\Inject
	 * @var Context
	 */
	protected $securityContext;

	/**
	 * @Flow\Inject
	 * @var PolicyService
	 */
	protected $policyService;

	/**
	 * Returns the classnames of the tokens this provider is responsible for.
	 *
	 * @return array The classname of the token this provider is responsible for
	 */
	public function getTokenClassNames() {
		return array(TwitterOAuthToken::class);
	}

	/**
	 * Tries to authenticate the given token. Sets isAuthenticated to TRUE if authentication succeeded.
	 *
	 * @param TokenInterface $authenticationToken The token to be authenticated
	 * @return void
	 * @throws UnsupportedAuthenticationTokenException
	 */
	public function authenticate(TokenInterface $authenticationToken) {
		if (!$authenticationToken instanceof TwitterOAuthToken) {
			throw new UnsupportedAuthenticationTokenException('No Twitter OAuth token provided', 1426089329);
		}

		if ($this->requestSignatureGenerator->getAuthToken() !== ObjectAccess::getPropertyPath($authenticationToken, 'credentials.oauth_token')) {
			throw new UnsupportedAuthenticationTokenException('The given authentication token does not the one that started this authentication request.', 1426089556);
		}

		$responseData = $this->verifyAccessToken(ObjectAccess::getPropertyPath($authenticationToken, 'credentials.oauth_verifier'));

		if ($responseData['statusCode'] !== 200 || !isset($responseData['oauth_token']) || !isset($responseData['oauth_token_secret'])) {
			$authenticationToken->setAuthenticationStatus(TokenInterface::WRONG_CREDENTIALS);
		}
		$this->requestSignatureGenerator->setTokenData($responseData['oauth_token'], $responseData['oauth_token_secret']);

		$authenticationToken->setAuthenticationStatus(TokenInterface::AUTHENTICATION_SUCCESSFUL);

		$account = $this->createOrUpdateAccount($responseData['oauth_token'], $responseData['oauth_token_secret']);
		$authenticationToken->setAccount($account);
	}

	/**
	 * Request the final token and secret with the given oauth_verifier.
	 *
	 * @param string $oAuthVerifier
	 * @return array Should have keys "statusCode", "oauth_token" and "oauth_token_secret"
	 */
	protected function verifyAccessToken($oAuthVerifier) {
		$uri = new Uri('https://api.twitter.com/oauth/access_token');
		$request = Request::create($uri, 'POST', array('oauth_verifier' => $oAuthVerifier));
		$request = $this->requestSignatureGenerator->signRequest($request);
		$request->setHeader('Content-Type', 'application/x-www-form-urlencoded', TRUE);

		$response = $this->requestEngine->sendRequest($request);
		$responseData = array();
		parse_str($response->getContent(), $responseData);
		$responseData['statusCode'] = $response->getStatusCode();

		return $responseData;
	}

	/**
	 * check for an existing user account and either return that or create a fresh account for the authenticated user.
	 *
	 * @param string $token
	 * @param string $tokenSecret
	 * @return Account
	 */
	protected function createOrUpdateAccount($token, $tokenSecret) {
		$uri = new Uri('https://api.twitter.com/1.1/account/verify_credentials.json');
		$request = Request::create($uri, 'GET');
		$request = $this->requestSignatureGenerator->signRequest($request);
		$request->setHeader('Content-Type', 'application/x-www-form-urlencoded', TRUE);

		$response = $this->requestEngine->sendRequest($request);
		$userData = json_decode($response->getContent(), TRUE);

		/** @var $account Account */
		$account = NULL;
		$providerName = $this->name;
		$accountRepository = $this->accountRepository;
		$this->securityContext->withoutAuthorizationChecks(function () use ($userData, $providerName, $accountRepository, &$account) {
			$account = $accountRepository->findByAccountIdentifierAndAuthenticationProviderName($userData['screen_name'], $providerName);
		});
		if ($account === NULL) {
			$defaultRole = $this->policyService->getRole('Flowpack.TwitterApi:AuthenticatedUser');
			$account = new Account();
			$account->setAccountIdentifier($userData['screen_name']);
			$account->setAuthenticationProviderName($providerName);
			$account->addRole($defaultRole);
			$this->accountRepository->add($account);
		}

		$account->setCredentialsSource($token . '&' . $tokenSecret);
		$this->accountRepository->update($account);
		$this->persistenceManager->whitelistObject($account);
		return $account;
	}

}