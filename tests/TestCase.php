<?php

namespace lobotomised\LaravelSqlLogger\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Lobotomised\LaravelSqlLogger\LaravelSqlLoggerServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelSqlLoggerServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        Schema::dropAllTables();

        $app['config']->set('sql-logger.db_debug', true);
    }

    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('foo');
        });
    }
}
