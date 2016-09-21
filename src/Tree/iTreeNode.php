<?php

namespace LTDBeget\util\DocBook\Tree;

use LTDBeget\util\DocBook\Html\Directive;

/**
 * @author Maxim A.
 * @version 1.0
 */
interface iTreeNode
{
    /**
     * @return iTreeNode|null
     */
    public function getRightNode();

    /**
     * @param iTreeNode $iTreeNode
     * @return void
     */
    public function setRightNode(iTreeNode $iTreeNode);

    /**
     * @return iTreeNode|null
     */
    public function getLeftNode();

    /**
     * @param iTreeNode $iTreeNode
     * @return void
     */
    public function setLeftNode(iTreeNode $iTreeNode);

    /**
     * @return Directive
     */
    public function getNode() : Directive;

    /**
     * @return bool
     */
    public function isLeaf() : bool;
}