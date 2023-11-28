<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Log;
use Lobotomised\LaravelSqlLogger\Commands\LaravelSqlLoggerCommand;

use function Pest\Laravel\artisan;

it('can cache check results', function () {
    Log::shouldReceive('debug')
        ->once()
        ->withArgs(fn (string $message) => $message === 'QUERY DEBUG: SHOW VARIABLES LIKE "%version%"'
        );

    artisan(LaravelSqlLoggerCommand::class)->assertSuccessful();
});
