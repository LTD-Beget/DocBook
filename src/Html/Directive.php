<?php

namespace LTDBeget\util\DocBook\Html;
use LTDBeget\util\DocBook\Assignable;

/**
 * @author Maxim A.
 * @version 1.0
 */
class Directive
{
    use Assignable;

    /**
     * @var string
     */
    public $defaultValue;

    /**
     * @var string
     */
    public $usedAt;

    /**
     * @var string
     */
    public $comment;

    /**
     * @var string
     */
    public $typeValue;

    /**
     * @var string
     */
    public $documentationUrl;

    /**
     * @var string
     */
    public $availableSince;

    /**
     * @var string
     */
    public $removedIn;

    /**
     * @var bool
     */
    public $isEnabled = false;

    /**
     * @var string
     */
    protected $directive;

    /**
     * @var NodeListIterator
     */
    protected $nodeListIterator;

    /**
     * @var array
     */
    protected $booleanValues = ['On', 'Off'];

    /**
     * @param string $directive
     * @return void
     */
    public function setDirective(string $directive)
    {
        $this->directive = $directive;
    }

    /**
     * @return string
     */
    public function getDirective() : string
    {
        return $this->directive;
    }

    /**
     * @param string $defaultValue
     * @return void
     */
    public function setDefaultValue(string $defaultValue)
    {
        $this->defaultValue = trim($defaultValue, chr(34));
    }

    /**
     * @return string
     */
    public function getDefaultValue() : string
    {
        return $this->defaultValue;
    }

    /**
     * @param string $usedAt
     * @return void
     */
    public function setUsedAt(string $usedAt)
    {
        $this->usedAt = $usedAt;
    }

    /**
     * @return string
     */
    public function getUsedAt() : string
    {
        return $this->usedAt;
    }

    /**
     * @param string $comment
     * @return void
     */
    public function setComment(string $comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function getComment() : string
    {
        return $this->comment;
    }

    /**
     * @param string $removedIn
     * @return void
     */
    public function setRemovedIn(string $removedIn)
    {
        $this->removedIn = $removedIn;
    }

    /**
     * @return string|null
     */
    public function getRemovedIn()
    {
        return $this->removedIn;
    }

    /**
     * @param string $since
     * @return void
     */
    public function setAvailableSince(string $since)
    {
        $this->availableSince = $since;
    }

    /**
     * @return string|null
     */
    public function getAvailableSince()
    {
        return $this->availableSince;
    }

    /**
     * @param string $typeValue
     * @return void
     */
    public function setType(string $typeValue)
    {
        $this->typeValue = $typeValue;
    }

    /**
     * @return string
     */
    public function getType() : string
    {
        return $this->typeValue;
    }

    /**
     * @return string
     */
    public function getDocumentationUrl() : string
    {
        return $this->documentationUrl;
    }

    /**
     * @param string $url
     * @return void
     */
    public function setDocumentationUrl(string $url)
    {
        $this->documentationUrl = $url;
    }

    /**
     * @param bool $state
     * @return void
     */
    public function setEnabledState(bool $state)
    {
        $this->isEnabled = $state;
    }

    /**
     * @return string
     */
    public function isEnabled() : string
    {
        return $this->isEnabled;
    }

    /**
     * @return void
     */
    public function touchType()
    {
        if (is_numeric($this->getDefaultValue())) {
            $this->typeValue = 'integer';
        } else if (in_array($this->getDefaultValue(), $this->booleanValues)) {
            $this->typeValue = 'boolean';
        } else {
            $this->typeValue = 'string';
        }
    }

    /**
     * @return void
     */
    public function resetVersionBasedOnComment()
    {
        $availableSincePosition = stripos($this->getComment(), $this->since());
        $removedInPosition      = stripos($this->getComment(), $this->removed());

        if (is_int($availableSincePosition)) {
            $this->availableSince = $this->asVerson($availableSincePosition);
        }

        if (is_int($removedInPosition)) {
            $this->removedIn = $this->asVerson($removedInPosition);
        }
    }

    /**
     * @param int $position
     * @return string
     */
    protected function asVerson(int $position) : string
    {
        preg_match('/((?:\d\.)+\d)/', $this->getComment(), $match, PREG_OFFSET_CAPTURE, $position);

        return reset($match[count($match) - 1]);
    }

    /**
     * @return string
     */
    protected function since() : string
    {
        return 'available since php';
    }

    /**
     * @return string
     */
    protected function removed() : string
    {
        return 'removed in php';
    }
}