<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 6/11/15
 * Time: 11:35
 */

namespace Art4\JsonApiClient\Validator\Tests;

use Art4\JsonApiClient\Validator\ErrorSourceValidator;

class ErrorSourceValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage string
     */
    public function testInvalidStringInput()
    {
        $validator = new ErrorSourceValidator();
        $validator->validate('test');
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage integer
     */
    public function testInvalidIntegerInput()
    {
        $validator = new ErrorSourceValidator();
        $validator->validate(123);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage array
     */
    public function testInvalidArrayInput()
    {
        $validator = new ErrorSourceValidator();
        $validator->validate([]);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage boolean
     */
    public function testInvalidBooleanInput()
    {
        $validator = new ErrorSourceValidator();
        $validator->validate(true);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage integer
     */
    public function testInvalidPointer()
    {
        $object = new \stdClass();
        $object->pointer = 123;

        $validator = new ErrorSourceValidator();
        $validator->validate($object);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage integer
     */
    public function testInvalidParameter()
    {
        $object = new \stdClass();
        $object->parameter = 123;

        $validator = new ErrorSourceValidator();
        $validator->validate($object);
    }

    public function testValidInput()
    {

        $object = new \stdClass();
        $object->pointer = 'pointer';
        $object->parameter = 'parameter';

        $validator = new ErrorSourceValidator();
        $validator->validate($object);

        $this->assertTrue(true);
    }
}
