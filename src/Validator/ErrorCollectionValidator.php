<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 5/11/15
 * Time: 17:40
 */

namespace Art4\JsonApiClient\Validator;
use Art4\JsonApiClient\Exception\ValidationException;

/**
 * Validates a json api error collection
 * @package Art4\JsonApiClient\Validator
 */
class ErrorCollectionValidator implements ValidatorInterface
{
    /**
     * Validates a error collection object structure
     * @param object $object
     */
    public function validate($object)
    {
        if ( ! is_array($object) )
        {
            throw new ValidationException('Errors for a collection has to be in an array, "' . gettype($object) . '" given.');
        }

        if ( count($object) === 0 )
        {
            throw new ValidationException('Errors array cannot be empty and MUST have at least one object');
        }
    }
}
