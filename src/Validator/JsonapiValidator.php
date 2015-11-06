<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 6/11/15
 * Time: 12:10
 */

namespace Art4\JsonApiClient\Validator;

use Art4\JsonApiClient\Exception\ValidationException;

/**
 * Validates a json api jsonapi
 * @package Art4\JsonApiClient\Validator
 */
class JsonapiValidator implements ValidatorInterface
{
    /**
     * Validates a jsonapi object structure
     * @param object $object
     */
    public function validate($object)
    {
        if ( ! is_object($object) )
        {
            throw new ValidationException('Jsonapi has to be an object, "' . gettype($object) . '" given.');
        }

        if ( property_exists($object, 'version') && (is_object($object->version) or is_array($object->version)) )
        {
            throw new ValidationException('property "version" cannot be an object or array, "' . gettype($object->version) . '" given.');
        }
    }

}
