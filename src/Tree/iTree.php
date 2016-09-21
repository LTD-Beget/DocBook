<?php

namespace LTDBeget\util\DocBook\Tree;

/**
 * @author Maxim A.
 * @version 1.0
 */
interface iTree
{
    /**
     * @param string $value
     * @return iTreeNode
     */
    public function find(string $value);

    /**
     * @param iTreeNode $directiveTreeNode
     * @return void
     */
    public function insert(iTreeNode $directiveTreeNode);

    /**
     * @param string $value
     * @return void
     */
    public function delete(string $value);

    /**
     * @return iTreeNode|null
     */
    public function getRootNode();
}