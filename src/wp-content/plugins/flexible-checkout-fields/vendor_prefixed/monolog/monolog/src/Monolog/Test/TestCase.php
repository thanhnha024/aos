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
namespace FcfVendor\Monolog\Test;

use FcfVendor\Monolog\Logger;
use FcfVendor\Monolog\DateTimeImmutable;
use FcfVendor\Monolog\Formatter\FormatterInterface;
/**
 * Lets you easily generate log records and a dummy formatter for testing purposes
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 *
 * @phpstan-import-type Record from \Monolog\Logger
 * @phpstan-import-type Level from \Monolog\Logger
 *
 * @internal feel free to reuse this to test your own handlers, this is marked internal to avoid issues with PHPStorm https://github.com/Seldaek/monolog/issues/1677
 */
class TestCase extends \FcfVendor\PHPUnit\Framework\TestCase
{
    public function tearDown() : void
    {
        parent::tearDown();
        if (isset($this->handler)) {
            unset($this->handler);
        }
    }
    /**
     * @param mixed[] $context
     *
     * @return array Record
     *
     * @phpstan-param  Level $level
     * @phpstan-return Record
     */
    protected function getRecord(int $level = \FcfVendor\Monolog\Logger::WARNING, string $message = 'test', array $context = []) : array
    {
        return ['message' => (string) $message, 'context' => $context, 'level' => $level, 'level_name' => \FcfVendor\Monolog\Logger::getLevelName($level), 'channel' => 'test', 'datetime' => new \FcfVendor\Monolog\DateTimeImmutable(\true), 'extra' => []];
    }
    /**
     * @phpstan-return Record[]
     */
    protected function getMultipleRecords() : array
    {
        return [$this->getRecord(\FcfVendor\Monolog\Logger::DEBUG, 'debug message 1'), $this->getRecord(\FcfVendor\Monolog\Logger::DEBUG, 'debug message 2'), $this->getRecord(\FcfVendor\Monolog\Logger::INFO, 'information'), $this->getRecord(\FcfVendor\Monolog\Logger::WARNING, 'warning'), $this->getRecord(\FcfVendor\Monolog\Logger::ERROR, 'error')];
    }
    protected function getIdentityFormatter() : \FcfVendor\Monolog\Formatter\FormatterInterface
    {
        $formatter = $this->createMock(\FcfVendor\Monolog\Formatter\FormatterInterface::class);
        $formatter->expects($this->any())->method('format')->will($this->returnCallback(function ($record) {
            return $record['message'];
        }));
        return $formatter;
    }
}
