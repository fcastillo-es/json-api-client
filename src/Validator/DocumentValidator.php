<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 3/11/15
 * Time: 16:04
 */

namespace Art4\JsonApiClient\Validator;

use Art4\JsonApiClient\Exception\ValidationException;

class DocumentValidator
{
    public function validate($object)
    {
        if ( ! is_object($object) )
        {
            throw new ValidationException('Document has to be an object, "' . gettype($object) . '" given.');
        }

        if ( ! property_exists($object, 'data') and ! property_exists($object, 'meta') and ! property_exists($object, 'errors') )
        {
            throw new ValidationException('Document MUST contain at least one of the following properties: data, errors, meta');
        }

        if ( property_exists($object, 'data') and property_exists($object, 'errors') )
        {
            throw new ValidationException('The properties `data` and `errors` MUST NOT coexist in Document.');
        }

        if ( property_exists($object, 'data') ) {
            $data = $object->data;
            if ( !is_null($data) && !is_array($data) && ! is_object($data) ) {
                throw new ValidationException('Data value has to be null or an object, "' . gettype($data) . '" given.');
            }
        }
    }
}
