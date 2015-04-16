<?php
namespace Flowpack\TwitterApi\Domain\Repository;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Property\PropertyMappingConfigurationInterface;

/**
 * Abstract repository for API requests
 *
 */
abstract class AbstractApiRepository {

	/**
	 * @Flow\Inject
	 * @var \Flowpack\TwitterApi\Authentication\AuthenticationInterface
	 */
	protected $authentication;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Property\PropertyMapper
	 */
	protected $propertyMapper;

	/**
	 * @Flow\Inject(lazy=FALSE)
	 * @var \Flowpack\TwitterApi\Domain\ApiObjectConverter
	 */
	protected $apiObjectConverter;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Http\Client\CurlEngine
	 */
	protected $requestEngine;

	/**
	 * Method to do get requests to the API
	 *
	 * @param string $endpoint The endpoint url to fetch, should not include a query string
	 * @param array $get The GET arguments to add to the request
	 * @return \TYPO3\Flow\Http\Response
	 */
	protected function get($endpoint, $get = array()) {
		$uri = new \TYPO3\Flow\Http\Uri($endpoint);
		$request = \TYPO3\Flow\Http\Request::create($uri, 'GET', $get);
		$request = $this->authentication->authorizeRequest($request);
		$response = $this->requestEngine->sendRequest($request);

		return $response;
	}

	/**
	 * @param \TYPO3\Flow\Http\Response $response
	 * @param $targetType
	 * @param PropertyMappingConfigurationInterface $propertyMappingConfiguration
	 * @return mixed
	 */
	protected function mapResponseToObjects(\TYPO3\Flow\Http\Response $response, $targetType, PropertyMappingConfigurationInterface $propertyMappingConfiguration = NULL) {
		$data = json_decode($response->getContent(), TRUE);

		return $this->mapToObjects($data, $targetType, $propertyMappingConfiguration);
	}

	/**
	 * @param array $data
	 * @param string $targetType
	 * @param PropertyMappingConfigurationInterface $propertyMappingConfiguration
	 * @return mixed
	 */
	protected function mapToObjects($data, $targetType, PropertyMappingConfigurationInterface $propertyMappingConfiguration = NULL) {
		$propertyMappingConfiguration = new \Flowpack\TwitterApi\Domain\PropertyMappingConfiguration();
		$propertyMappingConfiguration->allowAllProperties();

		return $this->propertyMapper->convert($data, $targetType, $propertyMappingConfiguration);
	}



}