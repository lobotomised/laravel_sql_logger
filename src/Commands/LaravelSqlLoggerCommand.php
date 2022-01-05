<?php

namespace Lobotomised\LaravelSqlLogger\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LaravelSqlLoggerCommand extends Command
{
    public $signature = 'db:info';

    public $description = 'Display which version of mysql laravel is using';

    public function handle(): int
    {
        $results = DB::select(DB::raw('SHOW VARIABLES LIKE "%version%"'));

        $table = [];

        foreach ($results as $row) {
            $table[] = [$row->Variable_name, $row->Value];
        }

        $this->table(['name', 'value'], $table);

        return Command::SUCCESS;
    }
}
