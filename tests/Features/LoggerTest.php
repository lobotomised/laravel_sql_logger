<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

it('log request without binding', function() {
    Log::shouldReceive('debug')
        ->once()
        ->withArgs(function ($message) {
            return str_contains($message, ' ---> QUERY DEBUG: select * from `users` <---');
        });

    DB::table('users')->get();
});

it('log request with binding', function() {
    Log::shouldReceive('debug')
        ->once()
        ->withArgs(function ($message) {
            return str_contains($message, ' ---> QUERY DEBUG: select * from `users` where `foo` = "bar" <---');
        });

    DB::table('users')->where('foo', '=', 'bar')->get();
});

