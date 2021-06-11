<?php

namespace Tests;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        include_once __DIR__ . '/../vendor/autoload.php';
    }
}
