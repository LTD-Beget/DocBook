<?php

namespace LTDBeget\util\DocBook;

use LTDBeget\util\DocBook\Html\Seed\Seeder;
use LTDBeget\util\DocBook\Tree\DirectiveSearchTree;
use LTDBeget\util\DocBook\Tree\iTree;
use InvalidArgumentException;
use GuzzleHttp;
use DOMDocument;

/**
 * @author Maxim A.
 * @version 1.0
 */
class Director
{
    /**
     * @var GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * @return DirectiveSearchTree
     */
    public function all() : iTree
    {
        return Seeder::seed($this->getContents($this->getDirectivesListUri()))->getTree();
    }

    /**
     * @param string $repository
     * @return DOMDocument
     * @throws InvalidArgumentException
     */
    protected function getContents(string $repository) : DOMDocument
    {
        try {
            $clientContents = $this->getHttpClient()->request('GET', $repository)->getBody()->getContents();

            $document = new DOMDocument();

            libxml_use_internal_errors(true);

            $document->loadHTML($clientContents);

            return $document;
        } catch (GuzzleHttp\Exception\ClientException $exception) {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @return GuzzleHttp\Client
     */
    protected function getHttpClient() : GuzzleHttp\Client
    {
        if (!$this->httpClient) {
            $this->httpClient = new GuzzleHttp\Client();
        }

        return $this->httpClient;
    }

    /**
     * @return string
     */
    protected function getDirectivesListUri() : string
    {
        return 'http://php.net/manual/en/ini.list.php';
    }

    /**
     * @return string
     */
    protected function getRepositoryBase() : string
    {
        return 'https://svn.php.net/repository/';
    }
}