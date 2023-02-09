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
        $query = DB::raw('SHOW VARIABLES LIKE "%version%"');

        if (is_object($query) && method_exists($query, 'getValue')) {
            $query = $query->getValue(DB::connection()->getQueryGrammar());
        }

        $results = DB::select($query);

        $table = [];

        foreach ($results as $row) {
            $table[] = [$row->Variable_name, $row->Value];
        }

        $this->table(['name', 'value'], $table);

        return Command::SUCCESS;
    }
}
