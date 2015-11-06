<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 6/11/15
 * Time: 10:22
 */

namespace Art4\JsonApiClient\Validator\Tests;

use Art4\JsonApiClient\Validator\ErrorValidator;

class ErrorValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage string
     */
    public function testInvalidStringInput()
    {
        $validator = new ErrorValidator();
        $validator->validate('test');
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage integer
     */
    public function testInvalidIntegerInput()
    {
        $validator = new ErrorValidator();
        $validator->validate(123);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage array
     */
    public function testInvalidArrayInput()
    {
        $validator = new ErrorValidator();
        $validator->validate([]);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage boolean
     */
    public function testInvalidBooleanInput()
    {
        $validator = new ErrorValidator();
        $validator->validate(true);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage property "id" has to be a string
     */
    public function testInvalidId()
    {
        $object = new \stdClass();
        $object->id = 123;

        $validator = new ErrorValidator();
        $validator->validate($object);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage property "status" has to be a string
     */
    public function testInvalidStatus()
    {
        $object = new \stdClass();
        $object->status = 123;

        $validator = new ErrorValidator();
        $validator->validate($object);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage property "code" has to be a string
     */
    public function testInvalidCode()
    {
        $object = new \stdClass();
        $object->code = 123;

        $validator = new ErrorValidator();
        $validator->validate($object);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage property "title" has to be a string
     */
    public function testInvalidTitle()
    {
        $object = new \stdClass();
        $object->title = 123;

        $validator = new ErrorValidator();
        $validator->validate($object);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage property "detail" has to be a string
     */
    public function testInvalidDetail()
    {
        $object = new \stdClass();
        $object->detail = 123;

        $validator = new ErrorValidator();
        $validator->validate($object);
    }

    public function testValidInput()
    {
        $object = new \stdClass();
        $object->id = 'id';
        $object->status = 'status';
        $object->code = 'code';
        $object->title = 'title';
        $object->detail = 'detail';

        $validator = new ErrorValidator();
        $validator->validate($object);

        $this->assertTrue(true);
    }
}
