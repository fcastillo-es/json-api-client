<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 3/11/15
 * Time: 17:17
 */

namespace Art4\JsonApiClient\Validator\Tests;

use Art4\JsonApiClient\Validator\DocumentValidator;

class DocumentValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage string
     */
    public function testInvalidStringInput()
    {
        $validator = new DocumentValidator();
        $validator->validate('test');
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage integer
     */
    public function testInvalidIntegerInput()
    {
        $validator = new DocumentValidator();
        $validator->validate(123);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage array
     */
    public function testInvalidArrayInput()
    {
        $validator = new DocumentValidator();
        $validator->validate([]);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage boolean
     */
    public function testInvalidBooleanInput()
    {
        $validator = new DocumentValidator();
        $validator->validate(true);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage Document MUST contain
     */
    public function testObjectWithNoProperties()
    {
        $obj = new \stdClass();

        $validator = new DocumentValidator();
        $validator->validate($obj);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage Document MUST contain
     */
    public function testObjectWithWrongProperties()
    {
        $obj = new \stdClass();
        $obj->foo = 1;
        $obj->bar = '2';

        $validator = new DocumentValidator();
        $validator->validate($obj);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage MUST NOT coexist
     */
    public function testObjectWithDataAndErrors()
    {
        $obj = new \stdClass();
        $obj->data = new \stdClass();
        $obj->errors = [];

        $validator = new DocumentValidator();
        $validator->validate($obj);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage string
     */
    public function testObjectWithStringData()
    {
        $obj = new \stdClass();
        $obj->data = 'test';

        $validator = new DocumentValidator();
        $validator->validate($obj);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage integer
     */
    public function testObjectWithIntegerData()
    {
        $obj = new \stdClass();
        $obj->data = 123;

        $validator = new DocumentValidator();
        $validator->validate($obj);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage boolean
     */
    public function testObjectWithBooleanData()
    {
        $obj = new \stdClass();
        $obj->data = true;

        $validator = new DocumentValidator();
        $validator->validate($obj);
    }

    public function testValidObjectWithObjectData()
    {

        $obj = new \stdClass();
        $obj->data = new \stdClass();

        $validator = new DocumentValidator();
        $validator->validate($obj);

        $this->assertTrue(true);
    }

    public function testValidObjectWithNullData()
    {

        $obj = new \stdClass();
        $obj->data = null;

        $validator = new DocumentValidator();
        $validator->validate($obj);

        $this->assertTrue(true);
    }

    public function testValidObjectWithArrayData()
    {

        $obj = new \stdClass();
        $obj->data = [];

        $validator = new DocumentValidator();
        $validator->validate($obj);

        $this->assertTrue(true);
    }
}
