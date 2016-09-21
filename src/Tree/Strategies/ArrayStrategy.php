<?php

namespace LTDBeget\util\DocBook\Tree\Strategies;

use LTDBeget\util\DocBook\Tree\DirectiveSearchTree;

/**
 * @author Maxim A.
 * @version 1.0
 */
class ArrayStrategy implements iStrategy
{
    /**
     * @param DirectiveSearchTree $tree
     * @return array
     */
    public function present(DirectiveSearchTree $tree)
    {
        $array = [];
        $iterator = $tree->getIterator();

        while ($iterator->valid()) {
            array_push($array, $iterator->current());

            $iterator->next();
        }

        return $array;
    }
}