<?php

namespace LTDBeget\util\DocBook\Tree;

use LTDBeget\util\DocBook\Html\Directive;

/**
 * @author Maxim A.
 * @version 1.0
 */
class DirectiveTreeNode implements iTreeNode
{
    /**
     * @var iTreeNode
     */
    protected $leftNode;

    /**
     * @var iTreeNode
     */
    protected $rightNode;

    /**
     * @var Directive
     */
    protected $nodeValue;

    /**
     * @param Directive $directive
     * @return void
     */
    public function __construct(Directive $directive)
    {
        $this->nodeValue = $directive;
    }

    /**
     * @return iTreeNode|null
     */
    public function getRightNode()
    {
        return $this->rightNode;
    }

    /**
     * @return iTreeNode|null
     */
    public function getLeftNode()
    {
        return $this->leftNode;
    }

    /**
     * @return Directive
     */
    public function getNode() : Directive
    {
        return $this->nodeValue;
    }

    /**
     * @param iTreeNode $iTreeNode
     * @return void
     */
    public function setRightNode(iTreeNode $iTreeNode)
    {
        $this->rightNode = $iTreeNode;
    }

    /**
     * @param iTreeNode $iTreeNode
     * @return void
     */
    public function setLeftNode(iTreeNode $iTreeNode)
    {
        $this->leftNode = $iTreeNode;
    }

    /**
     * @return bool
     */
    public function isLeaf() : bool
    {
        return !$this->getLeftNode() && !$this->getRightNode();
    }
}