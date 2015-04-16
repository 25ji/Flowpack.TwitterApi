<?php
namespace Flowpack\TwitterApi\Controller;

use Flowpack\TwitterApi\Exception;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Security\Authentication\Controller\AbstractAuthenticationController;

/**
 * Class AuthenticationController
 *
 */
class AuthenticationController extends AbstractAuthenticationController {

	/**
	 * @Flow\Inject
	 * @var \Flowpack\TwitterApi\Authentication\RequestSignatureGenerator
	 */
	protected $requestSignatureGenerator;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Http\Client\CurlEngine
	 */
	protected $client;

	/**
	 * Initializes the Twitter Authentication process. Will redirect to twitter for the user to login, setting the oauth callback url to this controllers authenticate method.
	 *
	 * @return void
	 * @throws Exception
	 */
	public function loginAction() {
		$uri = new \TYPO3\Flow\Http\Uri('https://api.twitter.com/oauth/request_token');
		$request = \TYPO3\Flow\Http\Request::create($uri, 'POST');
		$callbackUri = $this->uriBuilder->reset()->setCreateAbsoluteUri(TRUE)->uriFor('authenticate', array(), $this->request->getControllerName(), $this->request->getControllerPackageKey(), $this->request->getControllerSubpackageKey());
		$request = $this->requestSignatureGenerator->signRequest($request, $callbackUri);

		$response = $this->client->sendRequest($request);
		$responseData = array();
		parse_str($response->getContent(), $responseData);
		if ($response->getStatusCode() !== 200 || !isset($responseData['oauth_callback_confirmed']) || $responseData['oauth_callback_confirmed'] !== 'true') {
			throw new Exception($response->getStatus(), 1426084485);
		}

		$this->requestSignatureGenerator->setTokenData($responseData['oauth_token'], $responseData['oauth_token_secret']);

		$this->redirectToUri('https://api.twitter.com/oauth/authenticate?oauth_token=' . $responseData['oauth_token'], 0, 302);
	}

	/**
	 * Is called if authentication was successful. If there has been an
	 * intercepted request due to security restrictions, you might want to use
	 * something like the following code to restart the originally intercepted
	 * request:
	 *
	 * if ($originalRequest !== NULL) {
	 *     $this->redirectToRequest($originalRequest);
	 * }
	 * $this->redirect('someDefaultActionAfterLogin');
	 *
	 * @param \TYPO3\Flow\Mvc\ActionRequest $originalRequest The request that was intercepted by the security framework, NULL if there was none
	 * @return string
	 */
	protected function onAuthenticationSuccess(\TYPO3\Flow\Mvc\ActionRequest $originalRequest = NULL) {
		if ($originalRequest !== NULL) {
			$this->redirectToRequest($originalRequest);
		}
		$this->redirectToUri($this->request->getHttpRequest()->getBaseUri());
	}

}