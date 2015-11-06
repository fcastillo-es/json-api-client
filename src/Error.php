<?php

namespace Art4\JsonApiClient;

use Art4\JsonApiClient\Utils\AccessTrait;
use Art4\JsonApiClient\Utils\DataContainer;
use Art4\JsonApiClient\Utils\FactoryManagerInterface;
use Art4\JsonApiClient\Exception\AccessException;
use Art4\JsonApiClient\Exception\ValidationException;
use Art4\JsonApiClient\Validator\ErrorValidator;

/**
 * Error Object
 *
 * @see http://jsonapi.org/format/#error-objects
 */
final class Error implements ErrorInterface
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
	 * @var ErrorValidator
	 */
	protected $validator;

	/**
	 * @param object $object The error object
	 *
	 * @return self
	 *
	 * @throws ValidationException
	 */
	public function __construct($object, FactoryManagerInterface $manager)
	{
		$this->validator = new ErrorValidator();
		$this->validator->validate($object);

		$this->manager = $manager;

		$this->container = new DataContainer();

		if ( property_exists($object, 'id') )
		{
			$this->container->set('id', strval($object->id));
		}

		if ( property_exists($object, 'links') )
		{
			$this->container->set('links', $this->manager->getFactory()->make(
				'ErrorLink',
				[$object->links, $this->manager]
			));
		}

		if ( property_exists($object, 'status') )
		{
			$this->container->set('status', strval($object->status));
		}

		if ( property_exists($object, 'code') )
		{
			$this->container->set('code', strval($object->code));
		}

		if ( property_exists($object, 'title') )
		{
			$this->container->set('title', strval($object->title));
		}

		if ( property_exists($object, 'detail') )
		{
			$this->container->set('detail', strval($object->detail));
		}

		if ( property_exists($object, 'source') )
		{
			$this->container->set('source', $this->manager->getFactory()->make(
				'ErrorSource',
				[$object->source, $this->manager]
			));
		}

		if ( property_exists($object, 'meta') )
		{
			$this->container->set('meta', $this->manager->getFactory()->make(
				'Meta',
				[$object->meta, $this->manager]
			));
		}

		return $this;
	}

	/**
	 * Get a value by the key of this object
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
			throw new AccessException('"' . $key . '" doesn\'t exist in this error object.');
		}
	}
}
