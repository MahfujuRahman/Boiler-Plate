<?php

namespace App\Modules\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class TableModelingCommand extends Command
{

    protected $signature = 'make:table {module_name} {[field]?} {--model}';
    protected $description = 'Create a folder and files in the app directory';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        $moduleName = $this->argument('module_name');
        // $migration = $this->option('m');
        // $seed = $this->option('seed');
        $fields = [];


        // dd($this->hasArgument('[field]') && $this->argument('[field]'));
        // Check if the field argument is provided
        if ($this->hasArgument('[field]') && $this->argument('[field]')) {
            $fieldName = $this->argument('[field]');
            $fieldName = str_replace('[', '', $fieldName);
            $fieldName = str_replace(']', '', $fieldName);
            $fieldName = explode(',', $fieldName);
            foreach ($fieldName as $item) {
                $fields[] =  explode(':', $item);
            }
        }





        $baseDirectory = app_path("Modules/Management/");
        $formatDir = explode('/', $moduleName);

        if (count($formatDir) > 1) {
            $moduleName = array_pop($formatDir);
            $moduleDir = implode('/', $formatDir);
            $targetDir = $baseDirectory . '/' . $moduleDir;
            if (!File::isDirectory($targetDir)) {
                File::makeDirectory($targetDir, 0777, true);
            }
            $baseDirectory = $targetDir;
        }

        $table = Str::plural(Str::snake($moduleName));
        $migrationFile = 'create_' . $table . '_table.php';
        $modelFile = $moduleName . 'Model.php';
        $className = $moduleName . 'Model';


        $modelDirectory = $baseDirectory . '/Models';
        $databaseDirectory = $baseDirectory . '/Database';

        if (!File::isDirectory($modelDirectory)) {
            File::makeDirectory($modelDirectory, 0777, true);
        }

        if (!File::isDirectory($databaseDirectory)) {
            File::makeDirectory($databaseDirectory, 0777, true);
        }

        // Write model file
        File::put($modelDirectory . '/' . $modelFile, TableModel($moduleName, $className));

        // Write migration file
        File::put($databaseDirectory . '/' . $migrationFile, TableMigration($moduleName, $fields));

        // Run migration
        $relativeMigrationPath = str_replace(base_path() . '/', '', $databaseDirectory . '/' . $migrationFile);

        $this->info("Running migration: $relativeMigrationPath");
        Artisan::call('migrate', ['--path' => $relativeMigrationPath]);
        $this->info(Artisan::output());
        
    }
}
