<?php

namespace Art4\JsonApiClient\Tests;

use Art4\JsonApiClient\RelationshipLink;
use Art4\JsonApiClient\Tests\Fixtures\JsonValueTrait;

class RelationshipLinkTest extends \PHPUnit_Framework_TestCase
{
	use JsonValueTrait;

	/**
	 * @test only self, related and pagination property can exist
	 *
	 * links: a links object containing at least one of the following:
	 * - self: a link for the relationship itself (a "relationship link"). This link allows
	 *   the client to directly manipulate the relationship. For example, it would allow a
	 *   client to remove an author from an article without deleting the people resource itself.
	 * - related: a related resource link
	 *
	 * A relationship object that represents a to-many relationship MAY also contain pagination
	 * links under the links member, as described below.
	 */
	public function testOnlySelfRelatedPaginationPropertiesExists()
	{
		$object = new \stdClass();
		$object->self = 'http://example.org/self';
		$object->related = 'http://example.org/related';
		$object->pagination = new \stdClass();
		$object->ignore = 'http://example.org/should-be-ignored';

		$link = new RelationshipLink($object);

		$this->assertInstanceOf('Art4\JsonApiClient\RelationshipLink', $link);
		$this->assertInstanceOf('Art4\JsonApiClient\AccessInterface', $link);
		$this->assertSame($link->getKeys(), array('self', 'related', 'pagination'));

		$this->assertFalse($link->has('ignore'));
		$this->assertTrue($link->has('self'));
		$this->assertSame($link->get('self'), 'http://example.org/self');
		$this->assertTrue($link->has('related'));
		$this->assertSame($link->get('related'), 'http://example.org/related');
		$this->assertTrue($link->has('pagination'));
		$this->assertInstanceOf('Art4\JsonApiClient\PaginationLink', $link->get('pagination'));

		$this->assertSame($link->asArray(), array(
			'self' => $link->get('self'),
			'related' => $link->get('related'),
			'pagination' => $link->get('pagination'),
		));
	}

	/**
	 * @test object contains at least one of the following: self, related
	 */
	public function testCreateWithoutSelfAndRelatedPropertiesThrowsException()
	{
		$this->setExpectedException('Art4\JsonApiClient\Exception\ValidationException');

		$object = new \stdClass();
		$object->pagination = new \stdClass();

		$link = new RelationshipLink($object);
	}

	/**
	 * @dataProvider jsonValuesProvider
	 *
	 * self: a link for the relationship itself (a "relationship link").
	 */
	public function testSelfMustBeAString($input)
	{
		// Input must be a string
		if ( gettype($input) === 'string' )
		{
			return;
		}

		$object = new \stdClass();
		$object->self = $input;

		$this->setExpectedException('Art4\JsonApiClient\Exception\ValidationException');

		$link = new RelationshipLink($object);
	}

	/**
	 * @dataProvider jsonValuesProvider
	 *
	 * related: a related resource link when the primary data represents a resource relationship.
	 * If present, a related resource link MUST reference a valid URL
	 */
	public function testRelatedMustBeAString($input)
	{
		// Input must be a string
		if ( gettype($input) === 'string' )
		{
			return;
		}

		$object = new \stdClass();
		$object->related = $input;

		$this->setExpectedException('Art4\JsonApiClient\Exception\ValidationException');

		$link = new RelationshipLink($object);
	}

	/**
	 * @dataProvider jsonValuesProvider
	 */
	public function testPaginationMustBeAnObject($input)
	{
		// Input must be an object
		if ( gettype($input) === 'object' )
		{
			return;
		}

		$object = new \stdClass();
		$object->pagination = $input;

		$this->setExpectedException('Art4\JsonApiClient\Exception\ValidationException');

		$link = new RelationshipLink($object);
	}
}
