<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 6/11/15
 * Time: 11:31
 */

namespace Art4\JsonApiClient\Validator;

use Art4\JsonApiClient\Exception\ValidationException;

/**
 * Validates a json api error source
 * @package Art4\JsonApiClient\Validator
 */
class ErrorSourceValidator implements ValidatorInterface
{
    /**
     * Validates an error source object structure
     * @param object $object
     */
    public function validate($object)
    {
        if ( ! is_object($object) )
        {
            throw new ValidationException('ErrorSource has to be an object, "' . gettype($object) . '" given.');
        }

        if ( property_exists($object, 'pointer') && ! is_string($object->pointer) )
        {
            throw new ValidationException('property "pointer" has to be a string, "' . gettype($object->pointer) . '" given.');
        }

        if ( property_exists($object, 'parameter') && ! is_string($object->parameter) )
        {
            throw new ValidationException('property "parameter" has to be a string, "' . gettype($object->parameter) . '" given.');
        }
    }

}
