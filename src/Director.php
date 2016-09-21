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
     * @return void
     */
    public function __construct()
    {
        $this->httpClient = new GuzzleHttp\Client([
            'base_uri' => $this->getRepositoryBase(),
        ]);
    }

    /**
     * @return DirectiveSearchTree
     */
    public function all() : iTree
    {
        $seed = new Seeder($this->getContents($this->getConfigurationStorageUri()));

        return $seed->getTree();
    }

    /**
     * @param string $repositoryXml
     * @return DOMDocument
     * @throws InvalidArgumentException
     */
    protected function getContents(string $repositoryXml) : DOMDocument
    {
        try {
            $clientContents = $this->getHttpClient()->request('GET', $repositoryXml)->getBody()->getContents();

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
        return $this->httpClient;
    }

    /**
     * @return string
     */
    protected function getRepositoryBase() : string
    {
        return 'https://svn.php.net/repository/';
    }

    /**
     * @return string
     */
    protected function getConfigurationStorageUri() : string
    {
        return 'phpdoc/en/trunk/appendices/ini.list.xml';
    }
}