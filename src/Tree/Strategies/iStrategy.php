<?php

namespace LTDBeget\util\DocBook\Tree\Strategies;

use LTDBeget\util\DocBook\Tree\DirectiveSearchTree;

/**
 * @author Maxim A.
 * @version 1.0
 */
interface iStrategy
{
    /**
     * @param DirectiveSearchTree $tree
     * @return mixed
     */
    public function present(DirectiveSearchTree $tree);
}