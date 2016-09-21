<?php

namespace LTDBeget\util\DocBook\Tree\Strategies;

use LTDBeget\util\DocBook\Tree\DirectiveSearchTree;
use Symfony\Component\Yaml\Yaml;

/**
 * @author Maxim A.
 * @version 1.0
 */
class YamlStrategy implements iStrategy
{
    /**
     * @param DirectiveSearchTree $tree
     * @return string
     */
    public function present(DirectiveSearchTree $tree)
    {
        $array = [];
        $iterator = $tree->getIterator();

        while ($iterator->valid()) {
            $array[$iterator->current()->getNode()->getDirective()] = get_object_vars($iterator->current()->getNode());

            $iterator->next();
        }

        return Yaml::dump($array);
    }
}