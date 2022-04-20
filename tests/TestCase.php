<?php

namespace Lobotomised\LaravelSqlLogger\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Lobotomised\LaravelSqlLogger\LaravelSqlLoggerServiceProvider;
use Illuminate\Support\Facades\Schema;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            LaravelSqlLoggerServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        Schema::dropAllTables();

        $app['config']->set('sql-logger.db_debug', true);

        $migration = include __DIR__ . '/Fixtures/database/migrations/create_user_table.php';
        $migration->up();
    }
}
