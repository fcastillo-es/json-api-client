<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 6/11/15
 * Time: 10:11
 */

namespace Art4\JsonApiClient\Validator;

use Art4\JsonApiClient\Exception\ValidationException;

/**
 * Json Api validator
 * @package Art4\JsonApiClient\Validator
 */
interface ValidatorInterface
{
    /**
     * Validates json api fragment object structure
     *
     * @throws ValidationException
     * @param object $object
     */
    public function validate($object);
}
