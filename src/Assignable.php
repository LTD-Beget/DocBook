<?php

namespace LTDBeget\util\DocBook;

use InvalidArgumentException;

/**
 * @author Maxim A.
 * @version 1.0
 */
trait Assignable
{
    /**
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set(string $name, $value)
    {
        throw new InvalidArgumentException();
    }

    /**
     * @param array $array
     * @return void
     */
    public function create(array $array = [])
    {
        foreach ($array as $property => $item) {
            $this->{$property} = $item;
        }
    }
}