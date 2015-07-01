<?php
namespace Flowpack\TwitterApi\Authentication;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Http\Request;
use TYPO3\Flow\Utility\Algorithms;
use TYPO3\Flow\Utility\Arrays;

/**
 * Class RequestSignatureGenerator
 *
 * @Flow\Scope("singleton")
 */
class RequestSignatureGenerator {

	/**
	 * @Flow\InjectConfiguration(package="Flowpack.TwitterApi", path="authentication.application")
	 * @var array
	 */
	protected $consumerCredentials;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Session\SessionInterface
	 */
	protected $session;

	/**
	 * @param Request $request
	 * @param string $callBackUrl
	 * @return Request
	 */
	public function signRequest(Request $request, $callBackUrl = NULL) {
		$oAuthArguments = array(
			'oauth_consumer_key' => $this->consumerCredentials['consumerKey'],
			'oauth_nonce' => Algorithms::generateRandomString(32),
			'oauth_signature_method' => 'HMAC-SHA1',
			'oauth_version' => '1.0',
			'oauth_timestamp' => time()
		);

		if ($callBackUrl !== NULL) {
			$oAuthArguments['oauth_callback'] = $callBackUrl;
		}

		$authToken = $this->getAuthToken();
		if ($authToken !== '') {
			$oAuthArguments['oauth_token'] = $authToken;
		}

		$signature = $this->createSignature($request, $oAuthArguments);

		$oAuthArguments['oauth_signature'] = $signature;

		$authorization = '';
		foreach ($oAuthArguments as $oAuthArgumentKey => $oAuthArgumentValue) {
			if ($authorization !== '') {
				$authorization .= ', ';
			}
			$authorization .= urlencode($oAuthArgumentKey) . '="' . urlencode($oAuthArgumentValue) . '"';
		}
		$authorization = 'OAuth ' . $authorization;

		$request->setHeader('Authorization', $authorization, TRUE);

		return $request;
	}

	/**
	 * @Flow\Session(autoStart=TRUE)
	 * @param string $token
	 * @param string $tokenSecret
	 * @return void
	 */
	public function setTokenData($token, $tokenSecret) {
		$data = array (
			'oauth_token' => $token,
			'oauth_token_secret' => $tokenSecret
		);

		$this->session->putData('flowpack_twitterapi_oauth', $data);
	}

	/**
	 * @Flow\Session(autoStart=TRUE)
	 * @return string
	 */
	public function getAuthToken() {
		$sessionData = $this->session->getData('flowpack_twitterapi_oauth');
		if ($sessionData !== FALSE && is_array($sessionData)) {
			if (isset($sessionData['oauth_token'])) {
				return $sessionData['oauth_token'];
			}
		}

		return '';
	}

	/**
	 * @Flow\Session(autoStart=TRUE)
	 * @param Request $request
	 * @param array $oAuthArguments
	 * @return string
	 */
	public function createSignature(Request $request, $oAuthArguments = array()) {
		$requestBaseUri = clone $request->getUri();
		$requestBaseUri->setFragment(NULL);
		$requestBaseUri->setQuery(NULL);
		$requestArguments = $request->getArguments();
		$requestArguments = Arrays::arrayMergeRecursiveOverrule($requestArguments, $oAuthArguments);
		$signatureBaseString = strtoupper($request->getMethod()) . '&' . urlencode($requestBaseUri) . '&' . urlencode($this->encodeArguments($requestArguments));

		return base64_encode(hash_hmac('sha1', $signatureBaseString, $this->generateSigningKey(), TRUE));
	}

	/**
	 * @param array $arguments
	 * @return string
	 */
	protected function encodeArguments($arguments) {
		$encodedRequestArguments = array();
		foreach ($arguments as $key => $value) {
			$encodedRequestArguments[urlencode($key)] = urlencode($value);
		}
		ksort($encodedRequestArguments);

		$argumentString = '';
		foreach ($encodedRequestArguments as $key => $value) {
			if ($argumentString !== '') {
				$argumentString .= '&';
			}
			$argumentString .= $key . '=' . $value;
		}

		return $argumentString;
	}

	/**
	 *
	 */
	protected function generateSigningKey() {
		$signingKey = urlencode($this->consumerCredentials['consumerSecret']) . '&';

		$sessionData = $this->session->getData('flowpack_twitterapi_oauth');
		if ($sessionData !== FALSE && is_array($sessionData)) {
			if (isset($sessionData['oauth_token_secret'])) {
				$signingKey .= urlencode($sessionData['oauth_token_secret']);
			}
		}

		return $signingKey;
	}
}