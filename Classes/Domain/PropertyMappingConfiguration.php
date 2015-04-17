<?php
namespace Flowpack\TwitterApi\Domain;


use TYPO3\Flow\Property\PropertyMappingConfiguration as FlowPropertyMappingConfiguration;
use TYPO3\Flow\Property\TypeConverter\DateTimeConverter;
use TYPO3\Flow\Property\TypeConverter\StringConverter;

class PropertyMappingConfiguration extends FlowPropertyMappingConfiguration {

	/**
	 * @param string $sourcePropertyName
	 * @return string
	 */
	public function getTargetPropertyName($sourcePropertyName) {
		$propertyNameParts = explode('_', $sourcePropertyName);
		$propertyNameParts = array_map(function ($value) {
			return ucfirst($value);
		}, $propertyNameParts);

		return lcfirst(implode('', $propertyNameParts));
	}

	/**
	 * @param string $typeConverterClassName
	 * @param string $key
	 * @return mixed|string
	 */
	public function getConfigurationValue($typeConverterClassName, $key) {
		if ($typeConverterClassName === DateTimeConverter::class && $key === DateTimeConverter::CONFIGURATION_DATE_FORMAT) {
			return 'D M d H:i:s T Y';
		}

		if ($typeConverterClassName === StringConverter::class && $key === StringConverter::CONFIGURATION_ARRAY_FORMAT) {
			return StringConverter::ARRAY_FORMAT_JSON;
		}

		return parent::getConfigurationValue($typeConverterClassName, $key);
	}

	/**
	 * @param string $propertyPath
	 * @return $this
	 */
	public function getConfigurationFor($propertyPath) {
		return $this;
	}


}