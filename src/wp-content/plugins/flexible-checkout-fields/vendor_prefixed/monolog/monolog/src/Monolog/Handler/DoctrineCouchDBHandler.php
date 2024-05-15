<?php

declare (strict_types=1);
/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace FcfVendor\Monolog\Handler;

use FcfVendor\Monolog\Logger;
use FcfVendor\Monolog\Formatter\NormalizerFormatter;
use FcfVendor\Monolog\Formatter\FormatterInterface;
use FcfVendor\Doctrine\CouchDB\CouchDBClient;
/**
 * CouchDB handler for Doctrine CouchDB ODM
 *
 * @author Markus Bachmann <markus.bachmann@bachi.biz>
 */
class DoctrineCouchDBHandler extends \FcfVendor\Monolog\Handler\AbstractProcessingHandler
{
    /** @var CouchDBClient */
    private $client;
    public function __construct(\FcfVendor\Doctrine\CouchDB\CouchDBClient $client, $level = \FcfVendor\Monolog\Logger::DEBUG, bool $bubble = \true)
    {
        $this->client = $client;
        parent::__construct($level, $bubble);
    }
    /**
     * {@inheritDoc}
     */
    protected function write(array $record) : void
    {
        $this->client->postDocument($record['formatted']);
    }
    protected function getDefaultFormatter() : \FcfVendor\Monolog\Formatter\FormatterInterface
    {
        return new \FcfVendor\Monolog\Formatter\NormalizerFormatter();
    }
}
