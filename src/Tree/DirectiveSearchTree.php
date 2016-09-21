<?php

namespace LTDBeget\util\DocBook\Tree;

use IteratorAggregate;

/**
 * @author Maxim A.
 * @version 1.0
 */
class DirectiveSearchTree implements iTree, IteratorAggregate
{
    /**
     * @var iTreeNode
     */
    protected $rootNode;

    /**
     * @param string $value
     * @return iTreeNode
     */
    public function find(string $value)
    {
        $currentNode = $this->getRootNode();

        while ($currentNode instanceof iTreeNode) {
            if ($currentNode->getNode()->getDirective() == $value) {
                return $currentNode;
            } else if ($value > $currentNode->getNode()->getDirective()) {
                $currentNode = $currentNode->getRightNode();
            } else {
                $currentNode = $currentNode->getLeftNode();
            }
        }

        return new DirectiveTreeNodeNullObject();
    }

    /**
     * @param iTreeNode $directiveTreeNode
     * @return void
     */
    public function insert(iTreeNode $directiveTreeNode)
    {
        $currentNode = $this->getRootNode();

        if (!$currentNode) {
            $this->rootNode = $directiveTreeNode;

            return;
        }

        while ($currentNode instanceof iTreeNode) {
            if ($currentNode->getNode()->getDirective() < $directiveTreeNode->getNode()->getDirective()) {
                if ($currentNode->getRightNode() instanceof DirectiveTreeNode) {
                    $currentNode = $currentNode->getRightNode();
                } else {
                    $currentNode->setRightNode($directiveTreeNode);

                    break;
                }
            } else {
                if ($currentNode->getLeftNode() instanceof DirectiveTreeNode) {
                    $currentNode = $currentNode->getLeftNode();
                } else {
                    $currentNode->setLeftNode($directiveTreeNode);

                    break;
                }
            }
        }
    }

    /**
     * @param string $value
     * @return void
     */
    public function delete(string $value)
    {
        // TODO: implement delete() method.
    }

    /**
     * Retrieve an external iterator
     *
     * @return TreeIterator
     */
    public function getIterator()
    {
        return new TreeIterator($this->rootNode);
    }

    /**
     * @return iTreeNode|null
     */
    public function getRootNode()
    {
        return $this->rootNode;
    }
}