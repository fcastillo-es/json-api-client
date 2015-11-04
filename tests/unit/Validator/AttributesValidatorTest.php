<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 4/11/15
 * Time: 17:22
 */

namespace Validator;


use Art4\JsonApiClient\Validator\AttributesValidator;

class AttributesValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage string
     */
    public function testInvalidStringInput()
    {
        $validator = new AttributesValidator();
        $validator->validate('test');
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage integer
     */
    public function testInvalidIntegerInput()
    {
        $validator = new AttributesValidator();
        $validator->validate(123);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage array
     */
    public function testInvalidArrayInput()
    {
        $validator = new AttributesValidator();
        $validator->validate([]);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage boolean
     */
    public function testInvalidBooleanInput()
    {
        $validator = new AttributesValidator();
        $validator->validate(true);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     */
    public function testInvalidObjectWithTypeProperty()
    {
        $obj = new \stdClass();
        $obj->ok = 'foo';
        $obj->type = 'foo';

        $validator = new AttributesValidator();
        $validator->validate($obj);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     */
    public function testInvalidObjectWithIdProperty()
    {
        $obj = new \stdClass();
        $obj->ok = 'foo';
        $obj->id = 'foo';

        $validator = new AttributesValidator();
        $validator->validate($obj);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     */
    public function testInvalidObjectWithRelationshipsProperty()
    {
        $obj = new \stdClass();
        $obj->ok = 'foo';
        $obj->relationships = 'foo';

        $validator = new AttributesValidator();
        $validator->validate($obj);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     */
    public function testInvalidObjectWithLinksProperty()
    {
        $obj = new \stdClass();
        $obj->ok = 'foo';
        $obj->links = 'foo';

        $validator = new AttributesValidator();
        $validator->validate($obj);
    }

    public function testValidObject()
    {
        $obj = new \stdClass();
        $obj->ok = 'foo';

        $validator = new AttributesValidator();
        $validator->validate($obj);

        $this->assertTrue(true);
    }
}
