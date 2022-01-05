<?php

declare(strict_types=1);

namespace Lobotomised\LaravelSqlLogger;

use Illuminate\Support\ServiceProvider;
use Lobotomised\LaravelSqlLogger\Commands\LaravelSqlLoggerCommand;
use Illuminate\Support\Facades\DB;

class LaravelSqlLoggerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/sql-logger.php' => config_path('sql-logger.php'),
        ], 'laravel-sql-logger-config');

        if($this->app->runningInConsole()) {
            $this->commands(LaravelSqlLoggerCommand::class);
        }

        if (config('sql-logger.db_debug')) {
            DB::listen(function ($query): void {
                $position = 0;
                $full_query = '';

                foreach (str_split($query->sql) as $char) {
                    if ($char === '?') {
                        $full_query = $full_query . '"' .
                            $query->bindings[$position] . '"';
                        $position++;
                    } else {
                        $full_query .= $char;
                    }
                }

                logger()->debug(" ---> QUERY DEBUG: ${full_query} <---\n");
            });
        }

    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/sql-logger.php', 'sql-logger'
        );
    }
}
