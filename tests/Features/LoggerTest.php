<?php

declare(strict_types=1);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

it('log request without binding', function () {
    Log::shouldReceive('debug')
        ->once()
        ->withArgs(fn (string $message) => $message === 'QUERY DEBUG: select * from `users`'
        );

    DB::table('users')->get();
});

it('log request with binding', function () {
    Log::shouldReceive('debug')
        ->once()
        ->withArgs(fn (string $message) => $message === 'QUERY DEBUG: select * from `users` where `name` = "bar"'
        );

    DB::table('users')->where('name', '=', 'bar')->get();
});
