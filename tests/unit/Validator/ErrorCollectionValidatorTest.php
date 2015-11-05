<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 5/11/15
 * Time: 17:47
 */

namespace Art4\JsonApiClient\Validator\Tests;

use Art4\JsonApiClient\Validator\ErrorCollectionValidator;

class ErrorCollectionValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage string
     */
    public function testInvalidStringInput()
    {
        $validator = new ErrorCollectionValidator();
        $validator->validate('test');
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage integer
     */
    public function testInvalidIntegerInput()
    {
        $validator = new ErrorCollectionValidator();
        $validator->validate(123);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage array
     */
    public function testInvalidArrayInput()
    {
        $validator = new ErrorCollectionValidator();
        $validator->validate([]);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage boolean
     */
    public function testInvalidBooleanInput()
    {
        $validator = new ErrorCollectionValidator();
        $validator->validate(true);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage object
     */
    public function testInvalidObjectInput()
    {
        $obj = new \stdClass();

        $validator = new ErrorCollectionValidator();
        $validator->validate($obj);
    }

    public function testValidInput()
    {
        $validator = new ErrorCollectionValidator();
        $validator->validate(['bar' => 'foo']);

        $this->assertTrue(true);
    }
}
