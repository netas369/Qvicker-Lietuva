<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DatabaseStructure extends Command
{
    protected $signature = 'db:structure {--format=text : Output format (text/json)}';
    protected $description = 'Display the entire database structure';

    public function handle()
    {
        $tables = DB::select('SHOW TABLES');
        $structure = [];

        foreach ($tables as $table) {
            $tableName = array_values(get_object_vars($table))[0];

            // Get columns
            $columns = DB::select("SHOW COLUMNS FROM {$tableName}");

            // Get indexes
            $indexes = DB::select("SHOW INDEX FROM {$tableName}");

            // Get foreign keys
            $foreignKeys = $this->getForeignKeys($tableName);

            $structure[$tableName] = [
                'columns' => $columns,
                'indexes' => $indexes,
                'foreignKeys' => $foreignKeys
            ];
        }

        if ($this->option('format') === 'json') {
            $this->output->write(json_encode($structure, JSON_PRETTY_PRINT));
        } else {
            $this->displayTextStructure($structure);
        }

        return Command::SUCCESS;
    }

    private function getForeignKeys($tableName)
    {
        $database = config('database.connections.mysql.database');

        return DB::select("
            SELECT
                COLUMN_NAME as 'column',
                REFERENCED_TABLE_NAME as 'foreign_table',
                REFERENCED_COLUMN_NAME as 'foreign_column'
            FROM
                INFORMATION_SCHEMA.KEY_COLUMN_USAGE
            WHERE
                TABLE_SCHEMA = '{$database}'
                AND TABLE_NAME = '{$tableName}'
                AND REFERENCED_TABLE_NAME IS NOT NULL
        ");
    }

    private function displayTextStructure($structure)
    {
        foreach ($structure as $tableName => $tableInfo) {
            $this->info("Table: {$tableName}");

            $this->line("\nColumns:");
            $this->table(
                ['Field', 'Type', 'Null', 'Key', 'Default', 'Extra'],
                collect($tableInfo['columns'])->map(function ($column) {
                    return [
                        $column->Field,
                        $column->Type,
                        $column->Null,
                        $column->Key,
                        $column->Default ?? 'NULL',
                        $column->Extra
                    ];
                })
            );

            if (!empty($tableInfo['indexes'])) {
                $this->line("\nIndexes:");
                $this->table(
                    ['Key_name', 'Column_name', 'Non_unique', 'Seq_in_index'],
                    collect($tableInfo['indexes'])->map(function ($index) {
                        return [
                            $index->Key_name,
                            $index->Column_name,
                            $index->Non_unique,
                            $index->Seq_in_index
                        ];
                    })
                );
            }

            if (!empty($tableInfo['foreignKeys'])) {
                $this->line("\nForeign Keys:");
                $this->table(
                    ['Column', 'References', 'Foreign Column'],
                    collect($tableInfo['foreignKeys'])->map(function ($fk) {
                        return [
                            $fk->column,
                            $fk->foreign_table,
                            $fk->foreign_column
                        ];
                    })
                );
            }

            $this->line("\n" . str_repeat('-', 50) . "\n");
        }
    }
}
