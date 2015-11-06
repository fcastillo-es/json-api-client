<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 6/11/15
 * Time: 12:15
 */

namespace Art4\JsonApiClient\Validator\Tests;

use Art4\JsonApiClient\Validator\JsonapiValidator;

class JsonapiValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage string
     */
    public function testInvalidStringInput()
    {
        $validator = new JsonapiValidator();
        $validator->validate('test');
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage integer
     */
    public function testInvalidIntegerInput()
    {
        $validator = new JsonapiValidator();
        $validator->validate(123);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage array
     */
    public function testInvalidArrayInput()
    {
        $validator = new JsonapiValidator();
        $validator->validate([]);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage boolean
     */
    public function testInvalidBooleanInput()
    {
        $validator = new JsonapiValidator();
        $validator->validate(true);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage property "version"
     */
    public function testInvalidVersionArray()
    {
        $object = new \stdClass();
        $object->version = [];

        $validator = new JsonapiValidator();
        $validator->validate($object);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage property "version"
     */
    public function testInvalidVersionObject()
    {
        $object = new \stdClass();
        $object->version = new \stdClass();

        $validator = new JsonapiValidator();
        $validator->validate($object);
    }

    public function testValidInput()
    {
        $object = new \stdClass();
        $object->version = 'version';

        $validator = new JsonapiValidator();
        $validator->validate($object);
    }
}
