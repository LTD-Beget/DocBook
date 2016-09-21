<?php

namespace LTDBeget\util\DocBook\Html;

use DOMDocument;
use IteratorAggregate;

/**
 * @author Maxim A.
 * @version 1.0
 */
class HtmlFolder implements IteratorAggregate
{
    /**
     * @var DOMDocument
     */
    protected $document;

    /**
     * @param DOMDocument $document
     * @return void
     */
    public function __construct(DOMDocument $document)
    {
        $this->document = $document;
    }

    /**
     * Retrieve an external iterator
     *
     * @return NodeListIterator
     */
    public function getIterator() : NodeListIterator
    {
        return new NodeListIterator($this->document->getElementsByTagName('a'));
    }
}