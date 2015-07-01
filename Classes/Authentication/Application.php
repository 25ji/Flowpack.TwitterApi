<?php
namespace Flowpack\TwitterApi\Authentication;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Http\Request;
use TYPO3\Flow\Http\Uri;


/**
 * application-only auth
 * @see https://dev.twitter.com/oauth/application-only
 *
 * @Flow\Scope("singleton")
 */
class Application implements AuthenticationInterface {

	/**
	 * @Flow\InjectConfiguration(package="Flowpack.TwitterApi", path="authentication.application")
	 * @var array
	 */
	protected $consumerCredentials;

	/**
	 * @var \TYPO3\Flow\Cache\Frontend\StringFrontend
	 */
	protected $cache;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Http\Client\RequestEngineInterface
	 */
	protected $requestEngine;

	/**
	 * Authenticates the application with the configured credentials (if necessary) and returns the bearer token.
	 *
	 * @see http://tools.ietf.org/html/rfc6749#section-4.4
	 */
	public function getToken() {
		return $this->authenticate($this->consumerCredentials['consumerKey'], $this->consumerCredentials['consumerSecret']);
	}

	/**
	 * Adds the bearer authorization header to the given request and returns the request.
	 *
	 * @param Request $request
	 * @return Request
	 */
	public function authorizeRequest(Request $request) {
		$request->setHeader('Authorization', 'Bearer ' . $this->getToken());
		return $request;
	}

	/**
	 * Invalides an active bearer token. Next time getBearerToken is called it will authenticate again.
	 */
	public function invalidateToken() {

	}

	/**
	 * Does the actual authentication with Twitter.
	 * Should probably move to a oauth package to allow generic application only authentication with oauth.
	 *
	 * @param string $key
	 * @param string $secret
	 * @return string
	 * @throws \Exception
	 */
	protected function authenticate($key, $secret) {
		$token = $this->cache->get('Twitter_Application_Bearer_Token');
		if ($token === FALSE) {
			$bearerTokenCredentials = base64_encode(urlencode($key) . ':' . urlencode($secret));

			$uri = new Uri('https://api.twitter.com/oauth2/token');
			$httpRequest = Request::create($uri, 'POST');
			$httpRequest->setContent(http_build_query(array('grant_type' => 'client_credentials')));
			$httpRequest->setHeader('Authorization', 'Basic ' . $bearerTokenCredentials);
			$httpRequest->setHeader('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');

			$response = $this->requestEngine->sendRequest($httpRequest);
			$authenticationReponseBody = json_decode($response->getContent(), TRUE);
			if (!isset($authenticationReponseBody['token_type']) || $authenticationReponseBody['token_type'] !== 'bearer' || !isset($authenticationReponseBody['access_token'])) {
				throw new \Exception('Invalid authentication answer! Your application could not authenticate with Twitter.', 1424698337);
			}

			$token = $authenticationReponseBody['access_token'];
			$this->cache->set('Twitter_Application_Bearer_Token', $token);
		}

		return $token;
	}

	protected function invalidate() {

	}
}