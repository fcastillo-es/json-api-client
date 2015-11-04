<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 4/11/15
 * Time: 17:48
 */

namespace Art4\JsonApiClient\Validator\Tests;

use Art4\JsonApiClient\Validator\DocumentLinkValidator;

class DocumentLinkValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage string
     */
    public function testInvalidStringInput()
    {
        $validator = new DocumentLinkValidator();
        $validator->validate('test');
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage integer
     */
    public function testInvalidIntegerInput()
    {
        $validator = new DocumentLinkValidator();
        $validator->validate(123);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage array
     */
    public function testInvalidArrayInput()
    {
        $validator = new DocumentLinkValidator();
        $validator->validate([]);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage boolean
     */
    public function testInvalidBooleanInput()
    {
        $validator = new DocumentLinkValidator();
        $validator->validate(true);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage self
     */
    public function testInvalidObjectWithWrongSelf()
    {
        $obj = new \stdClass();
        $obj->self = 123;

        $validator = new DocumentLinkValidator();
        $validator->validate($obj);
    }

    /**
     * @expectedException Art4\JsonApiClient\Exception\ValidationException
     * @expectedExceptionMessage related
     */
    public function testInvalidObjectWithWrongRelated()
    {
        $obj = new \stdClass();
        $obj->related = 123;

        $validator = new DocumentLinkValidator();
        $validator->validate($obj);
    }

    public function testValidObject()
    {
        $obj = new \stdClass();
        $obj->self = 'http://example.com/self';
        $obj->related = 'http://example.com/related';

        $validator = new DocumentLinkValidator();
        $validator->validate($obj);
    }
}
