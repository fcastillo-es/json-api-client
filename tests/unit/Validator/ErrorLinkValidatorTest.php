<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 6/11/15
 * Time: 11:23
 */

namespace Art4\JsonApiClient\Validator\Tests;

use Art4\JsonApiClient\Validator\ErrorLinkValidator;

class ErrorLinkValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage string
     */
    public function testInvalidStringInput()
    {
        $validator = new ErrorLinkValidator();
        $validator->validate('test');
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage integer
     */
    public function testInvalidIntegerInput()
    {
        $validator = new ErrorLinkValidator();
        $validator->validate(123);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage array
     */
    public function testInvalidArrayInput()
    {
        $validator = new ErrorLinkValidator();
        $validator->validate([]);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage boolean
     */
    public function testInvalidBooleanInput()
    {
        $validator = new ErrorLinkValidator();
        $validator->validate(true);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage about
     */
    public function testMissingAbout()
    {
        $object = new \stdClass();
        $object->bar = 'foo';

        $validator = new ErrorLinkValidator();
        $validator->validate($object);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage integer
     */
    public function testInvalidAbout()
    {
        $object = new \stdClass();
        $object->about = 123;

        $validator = new ErrorLinkValidator();
        $validator->validate($object);
    }

    public function testStringAbout()
    {
        $object = new \stdClass();
        $object->about = 'foo';

        $validator = new ErrorLinkValidator();
        $validator->validate($object);

        $this->assertTrue(true);
    }

    public function testObjectAbout()
    {
        $object = new \stdClass();
        $object->about = new \stdClass();

        $validator = new ErrorLinkValidator();
        $validator->validate($object);

        $this->assertTrue(true);
    }
}
