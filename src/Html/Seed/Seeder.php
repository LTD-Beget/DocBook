<?php

namespace LTDBeget\util\DocBook\Html\Seed;

use LTDBeget\util\DocBook\Html\NodeListIterator;
use LTDBeget\util\DocBook\Html\Directive;
use DOMDocument;
use DOMNodeList;
use DOMXPath;
use LTDBeget\util\DocBook\Tree\DirectiveSearchTree;
use LTDBeget\util\DocBook\Tree\DirectiveTreeNode;
use LTDBeget\util\DocBook\Tree\iTree;
use LTDBeget\util\DocBook\Tree\iTreeNode;

/**
 * @author Maxim A.
 * @version 1.0
 */
class Seeder
{
    /**
     * @var iTree
     */
    protected $tree;

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

        $this->reset();
    }

    /**
     * @return void
     */
    public function reset()
    {
        $this->tree = new DirectiveSearchTree();

        foreach ($this->getElementsXPath() as $element) {
            $this->tree->insert($this->addRow($element->childNodes));
        }
    }

    /**
     * @param DOMNodeList $nodeList
     * @return iTreeNode
     */
    public function addRow(DOMNodeList $nodeList) : iTreeNode
    {
        return new DirectiveTreeNode($this->fill(new NodeListIterator($nodeList)));
    }

    /**
     * @return iTree
     */
    public function getTree() : iTree
    {
        return $this->tree;
    }

    /**
     * @return Directive
     */
    protected function fill(NodeListIterator $nodeListIterator)
    {
        $directive = new Directive();

        $current = $nodeListIterator->current();

        $directive->setDirective($nodeListIterator->current()->textContent);

        if ($current->firstChild->hasAttributes()) {
            $directive->setDocumentationName(
                $current->firstChild->attributes->getNamedItem('linkend')->nodeValue
            );
        }

        $nodeListIterator->next();

        $directive->setDefaultValue($nodeListIterator->current()->textContent);

        $nodeListIterator->next();

        $directive->setUsedAt($nodeListIterator->current()->textContent);

        $nodeListIterator->next();

        $directive->setComment($nodeListIterator->current()->textContent);

        $nodeListIterator->rewind();

        $directive->resetVersionBasedOnComment();
        $directive->touchType();

        return $directive;
    }

    /**
     * @return DOMNodeList
     */
    protected function getElementsXPath() : DOMNodeList
    {
        $documentXPath = new DOMXPath($this->document);
        $nodeList = $documentXPath->query('//table//tbody/row');

        return $nodeList;
    }
}