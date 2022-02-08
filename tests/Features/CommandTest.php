<?php

declare(strict_types=1);

use Lobotomised\LaravelSqlLogger\Commands\LaravelSqlLoggerCommand;
use function Pest\Laravel\artisan;
use Illuminate\Support\Facades\Log;

it('can cache check results', function () {
    Log::shouldReceive('debug')
        ->once()
        ->withArgs(function ($message) {
            return str_contains($message, ' ---> QUERY DEBUG: SHOW VARIABLES LIKE "%version%" <---');
        });

    artisan(LaravelSqlLoggerCommand::class)->assertSuccessful();
});
