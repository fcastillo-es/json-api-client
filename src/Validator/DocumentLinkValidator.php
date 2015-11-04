<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 4/11/15
 * Time: 17:36
 */

namespace Art4\JsonApiClient\Validator;

use Art4\JsonApiClient\Exception\ValidationException;

/**
 * Validates a json api document link
 * @package Art4\JsonApiClient\Validator
 */
class DocumentLinkValidator
{
    /**
     * Validates a document link object structure
     * @param object $object
     */
    public function validate($object)
    {
        if ( ! is_object($object) ) {
            throw new ValidationException('DocumentLink has to be an object, "' . gettype($object) . '" given.');
        }

        if ( property_exists($object, 'self') && ! is_string($object->self) ) {
            throw new ValidationException('property "self" has to be a string, "' . gettype($object->self) . '" given.');
        }

        if ( property_exists($object, 'related') && ! is_string($object->related) ) {
            throw new ValidationException('property "related" has to be a string, "' . gettype($object->related) . '" given.');
        }
    }
}
