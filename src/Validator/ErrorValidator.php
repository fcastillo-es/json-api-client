<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 6/11/15
 * Time: 10:15
 */

namespace Art4\JsonApiClient\Validator;

use Art4\JsonApiClient\Exception\ValidationException;

/**
 * Validates a json api error
 * @package Art4\JsonApiClient\Validator
 */
class ErrorValidator implements ValidatorInterface
{
    /**
     * Validates an error object structure
     * @param object $object
     */
    public function validate($object)
    {
        if ( ! is_object($object) )
        {
            throw new ValidationException('Error has to be an object, "' . gettype($object) . '" given.');
        }

        if ( property_exists($object, 'id') && ! is_string($object->id) )
        {
            throw new ValidationException('property "id" has to be a string, "' . gettype($object->id) . '" given.');
        }

        if ( property_exists($object, 'status') && ! is_string($object->status) )
        {
            throw new ValidationException('property "status" has to be a string, "' . gettype($object->status) . '" given.');
        }

        if ( property_exists($object, 'code') && ! is_string($object->code) )
        {
            throw new ValidationException('property "code" has to be a string, "' . gettype($object->code) . '" given.');
        }

        if ( property_exists($object, 'title') && ! is_string($object->title) )
        {
            throw new ValidationException('property "title" has to be a string, "' . gettype($object->title) . '" given.');
        }

        if ( property_exists($object, 'detail') && ! is_string($object->detail) )
        {
            throw new ValidationException('property "detail" has to be a string, "' . gettype($object->detail) . '" given.');
        }
    }

}
