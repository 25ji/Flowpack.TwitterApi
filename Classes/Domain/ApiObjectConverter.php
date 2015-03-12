<?php
namespace Flowpack\TwitterApi\Domain;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Property\PropertyMappingConfigurationInterface;

/**
 * Converts api objects into DTO object structures.
 *
 * @Flow\Scope("singleton")
 */
class ApiObjectConverter extends \TYPO3\Flow\Property\TypeConverter\ObjectConverter {

	protected $priority = 1;

	/**
	 * @var string
	 */
	protected $targetType = 'Flowpack\TwitterApi\Domain\DataTransferObjects\TwitterApiObjectInterface';

	/**
	 * The type of a property is determined by the reflection service.
	 *
	 * @param string $targetType
	 * @param string $propertyName
	 * @param PropertyMappingConfigurationInterface $configuration
	 * @return string
	 */
	public function getTypeOfChildProperty($targetType, $propertyName, PropertyMappingConfigurationInterface $configuration) {
		$typeDeclaration = \TYPO3\Flow\Utility\TypeHandling::parseType($targetType);
		if ($typeDeclaration['elementType'] !== NULL) {
			return $typeDeclaration['elementType'];
		}

		return parent::getTypeOfChildProperty($targetType, $propertyName, $configuration);
	}

}