<?php

namespace LTDBeget\util\DocBook\Html;

use Iterator;
use DOMNodeList;
use DOMNode;

/**
 * @author Maxim A.
 * @version 1.0
 */
class NodeListIterator implements Iterator
{
    /**
     * @var DOMNodeList
     */
    protected $nodeList;

    /**
     * @var int
     */
    protected $pointer = 0;

    /**
     * @param DOMNodeList $nodeList
     * @return void
     */
    public function __construct(DOMNodeList $nodeList)
    {
        $this->nodeList = $nodeList;
    }

    /**
     * Return the current element
     *
     * @return DOMNode
     */
    public function current() : DOMNode
    {
        return $this->nodeList->item($this->key());
    }

    /**
     * Move forward to next element
     *
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        ++$this->pointer;
    }

    /**
     * Return the key of the current element
     *
     * @return mixed scalar on success, or null on failure.
     */
    public function key() : int
    {
        return $this->pointer;
    }

    /**
     * Checks if current position is valid
     *
     * @return boolean The return value will be casted to boolean and then evaluated.
     */
    public function valid() : bool
    {
        return ($this->nodeList->item($this->key()) instanceof DOMNode);
    }

    /**
     * Rewind the Iterator to the first element
     *
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->pointer = 0;
    }
}