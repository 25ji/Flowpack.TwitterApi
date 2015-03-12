<?php
namespace Flowpack\TwitterApi\Authentication;


interface AuthenticationInterface {

	/**
	 * Adds authentication information to the given request
	 *
	 * @param \TYPO3\Flow\Http\Request $request
	 * @return mixed
	 */
	public function authorizeRequest(\TYPO3\Flow\Http\Request $request);

}