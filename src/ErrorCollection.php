<?php

namespace Art4\JsonApiClient;

use Art4\JsonApiClient\Utils\AccessTrait;
use Art4\JsonApiClient\Utils\DataContainer;
use Art4\JsonApiClient\Utils\FactoryManagerInterface;
use Art4\JsonApiClient\Exception\AccessException;
use Art4\JsonApiClient\Exception\ValidationException;
use Art4\JsonApiClient\Validator\ErrorCollectionValidator;

/**
 * Error Collection Object
 *
 * @see http://jsonapi.org/format/#error-objects
 */
final class ErrorCollection implements ErrorCollectionInterface
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
	 * @var ErrorCollectionValidator
	 */
	protected $validator;

	/**
	 * @param array $resources The resources as array
	 *
	 * @return self
	 *
	 * @throws ValidationException
	 */
	public function __construct($errors, FactoryManagerInterface $manager)
	{
		$this->validator = new ErrorCollectionValidator();
		$this->validator->validate($errors);

		$this->manager = $manager;

		$this->container = new DataContainer();

		foreach ($errors as $error)
		{
			$this->container->set('', $this->manager->getFactory()->make(
				'Error',
				[$error, $this->manager]
			));
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
			throw new AccessException('"' . $key . '" doesn\'t exist in this collection.');
		}
	}
}
