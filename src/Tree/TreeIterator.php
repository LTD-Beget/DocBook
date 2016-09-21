<?php

namespace LTDBeget\util\DocBook\Tree;

use Iterator;
use SplQueue;

/**
 * @author Maxim A.
 * @version 1.0
 */
class TreeIterator implements Iterator
{
    /**
     * The root node
     *
     * @var iTreeNode
     */
    protected $treeNode;

    /**
     * Base pointer
     *
     * @var iTreeNode
     */
    protected $currentNode;

    /**
     * @var SplQueue
     */
    protected $queue;

    /**
     * @param iTreeNode $treeNode
     * @return void
     */
    public function __construct(iTreeNode $treeNode)
    {
        $this->queue = new SplQueue();

        $this->treeNode = $treeNode;
        $this->currentNode = $this->treeNode;
    }

    /**
     * Return the current element
     *
     * @return iTreeNode
     */
    public function current()
    {
        return $this->currentNode;
    }

    /**
     * Move forward to next element
     *
     * @return void
     */
    public function next()
    {
        if ($this->currentNode->getLeftNode() instanceof DirectiveTreeNode) {
            $this->queue->push($this->currentNode->getLeftNode());
        }

        if ($this->currentNode->getRightNode() instanceof DirectiveTreeNode) {
            $this->queue->push($this->currentNode->getRightNode());
        }

        if (!$this->queue->isEmpty()) {
            $this->currentNode = $this->queue->pop();
        } else {
            $this->currentNode = new DirectiveTreeNodeNullObject();
        }
    }

    /**
     * Return the key of the current element
     *
     * @return iTreeNode
     */
    public function key()
    {
        return $this->current();
    }

    /**
     * Checks if current position is valid
     *
     * @return boolean
     */
    public function valid()
    {
        return ($this->currentNode instanceof DirectiveTreeNode);
    }

    /**
     * Rewind the Iterator to the first element
     *
     * @return void
     */
    public function rewind()
    {
        $this->currentNode = $this->treeNode;
    }
}