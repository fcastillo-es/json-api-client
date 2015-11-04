<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 4/11/15
 * Time: 17:13
 */

namespace Art4\JsonApiClient\Validator;

use Art4\JsonApiClient\Exception\ValidationException;

/**
 * Validates json api attributes
 * @package Art4\JsonApiClient\Validator
 */
class AttributesValidator
{
    /**
     * Validates an attributes object structure
     * @param object $object
     */
    public function validate($object)
    {
        if ( ! is_object($object) )
        {
            throw new ValidationException('Attributes has to be an object, "' . gettype($object) . '" given.');
        }

        if ( property_exists($object, 'type') or property_exists($object, 'id') or property_exists($object, 'relationships') or property_exists($object, 'links') )
        {
            throw new ValidationException('These properties are not allowed in attributes: `type`, `id`, `relationships`, `links`');
        }
    }
}
