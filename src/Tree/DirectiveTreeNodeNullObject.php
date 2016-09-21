<?php

namespace LTDBeget\util\DocBook\Tree;

use LTDBeget\util\DocBook\Html\Directive;

/**
 * @author Maxim A.
 * @version 1.0
 */
class DirectiveTreeNodeNullObject implements iTreeNode
{
    /**
     * @return DirectiveTreeNode|null
     */
    public function getRightNode() {}

    /**
     * @return DirectiveTreeNode|null
     */
    public function getLeftNode() {}

    /**
     * @return Directive
     */
    public function getNode() : Directive {}

    /**
     * @param iTreeNode $iTreeNode
     * @return void
     */
    public function setRightNode(iTreeNode $iTreeNode) {}

    /**
     * @param iTreeNode $iTreeNode
     * @return void
     */
    public function setLeftNode(iTreeNode $iTreeNode) {}

    /**
     * @return bool
     */
    public function isLeaf() : bool {}
}