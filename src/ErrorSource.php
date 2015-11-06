<?php

namespace Art4\JsonApiClient;

use Art4\JsonApiClient\Utils\AccessTrait;
use Art4\JsonApiClient\Utils\DataContainer;
use Art4\JsonApiClient\Utils\FactoryManagerInterface;
use Art4\JsonApiClient\Exception\AccessException;
use Art4\JsonApiClient\Exception\ValidationException;
use Art4\JsonApiClient\Validator\ErrorSourceValidator;
use Art4\JsonApiClient\Validator\ValidatorInterface;

/**
 * Error Source Object
 *
 * @see http://jsonapi.org/format/#error-objects
 */
final class ErrorSource implements ErrorSourceInterface
{
	use AccessTrait;

	/**
	 * @var DataContainerInterface
	 */
	protected $container;

	/**
	 * @var FactoryManagerInterface
	 */
	protected $manager;

	/**
	 * @var ValidatorInterface
	 */
	protected $validator;

	/**
	 * @param object $object The error source object
	 *
	 * @return self
	 *
	 * @throws ValidationException
	 */
	public function __construct($object, FactoryManagerInterface $manager)
	{
		$this->validator = new ErrorSourceValidator();
		$this->validator->validate($object);

		$this->manager = $manager;

		$this->container = new DataContainer();

		if ( property_exists($object, 'pointer') )
		{
			$this->container->set('pointer', strval($object->pointer));
		}

		if ( property_exists($object, 'parameter') )
		{
			$this->container->set('parameter', strval($object->parameter));
		}

		return $this;
	}

	/**
	 * Get a value by the key of this document
	 *
	 * @param string $key The key of the value
	 * @return mixed The value
	 */
	public function get($key)
	{
		try
		{
			return $this->container->get($key);
		}
		catch (AccessException $e)
		{
			throw new AccessException('"' . $key . '" doesn\'t exist in this error source.');
		}
	}
}
