<?php
namespace Flowpack\TwitterApi\Domain;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Property\PropertyMappingConfigurationInterface;
use TYPO3\Flow\Reflection\ObjectAccess;

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

		$configuredTargetType = $configuration->getConfigurationFor($propertyName)->getConfigurationValue('TYPO3\Flow\Property\TypeConverter\ObjectConverter', self::CONFIGURATION_TARGET_TYPE);
		if ($configuredTargetType !== NULL) {
			return $configuredTargetType;
		}

		$methodParameters = $this->reflectionService->getMethodParameters($targetType, '__construct');
		if (isset($methodParameters[$propertyName]) && isset($methodParameters[$propertyName]['type'])) {
			return $methodParameters[$propertyName]['type'];
		} elseif ($this->reflectionService->hasMethod($targetType, ObjectAccess::buildSetterMethodName($propertyName))) {
			$methodParameters = $this->reflectionService->getMethodParameters($targetType, ObjectAccess::buildSetterMethodName($propertyName));
			$methodParameter = current($methodParameters);
			if (isset($methodParameter['type'])) {
				return $methodParameter['type'];
			}
		} else {
			$targetPropertyNames = $this->reflectionService->getClassPropertyNames($targetType);
			if (in_array($propertyName, $targetPropertyNames)) {
				$values = $this->reflectionService->getPropertyTagValues($targetType, $propertyName, 'var');
				if (count($values) > 0) {
					return current($values);
				}
			}
		}

		return 'string';
	}

	/**
	 * Convert an object from $source to an object.
	 *
	 * @param mixed $source
	 * @param string $targetType
	 * @param array $convertedChildProperties
	 * @param PropertyMappingConfigurationInterface $configuration
	 * @return object the target type
	 */
	public function convertFrom($source, $targetType, array $convertedChildProperties = array(), PropertyMappingConfigurationInterface $configuration = NULL) {
		$object = $this->buildObject($convertedChildProperties, $targetType);
		foreach ($convertedChildProperties as $propertyName => $propertyValue) {
			ObjectAccess::setProperty($object, $propertyName, $propertyValue);
		}

		return $object;
	}

}