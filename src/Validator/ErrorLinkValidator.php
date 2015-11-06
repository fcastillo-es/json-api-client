<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 6/11/15
 * Time: 11:20
 */

namespace Art4\JsonApiClient\Validator;

use Art4\JsonApiClient\Exception\ValidationException;

/**
 * Validates a json api error link
 * @package Art4\JsonApiClient\Validator
 */
class ErrorLinkValidator implements ValidatorInterface
{
    /**
     * Validates an error link object structure
     * @param object $object
     */
    public function validate($object)
    {
        if ( ! is_object($object) )
        {
            throw new ValidationException('Link has to be an object, "' . gettype($object) . '" given.');
        }

        if ( ! property_exists($object, 'about') )
        {
            throw new ValidationException('ErrorLink MUST contain these properties: about');
        }

        if ( ! is_string($object->about) and ! is_object($object->about) )
        {
            throw new ValidationException('Link has to be an object or string, "' . gettype($object->about) . '" given.');
        }
    }

}
