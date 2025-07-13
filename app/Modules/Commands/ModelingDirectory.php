<?php

namespace App\Modules\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ModelingDirectory extends Command
{
    protected $signature = 'make:module {module_name} {[field]?} {--vue}';
    protected $description = 'Create a folder and files in the app directory';

    protected $moduleName;
    protected $ViewModuleName;
    protected $fields = [];
    protected $baseDirectory;
    protected $withVue;

    public function handle()
    {
        $this->initializeProperties();
        $this->parseFields();
        $this->createBaseDirectories();
        $this->createSubDirectories();
        $this->generateFiles();
        $this->runMigration();
        $this->runSeeder();
        $this->appendRouteToApiRoutes();

        if ($this->withVue) {
            $this->generateVueFiles();
        }
    }

    /*
    |--------------------------------------------------------------------------
    | API Management Module
    |--------------------------------------------------------------------------
    */

    protected function initializeProperties()
    {
        $this->moduleName = $this->argument('module_name');
        $this->ViewModuleName = $this->moduleName;
        $this->withVue = $this->option('vue');
        $this->baseDirectory = app_path("Modules/Management/");
    }

    protected function parseFields()
    {
        $arg = $this->argument('[field]');
        if (!$arg) return;

        $arg = str_replace(['[', ']'], '', $arg);
        foreach (explode(',', $arg) as $item) {
            $this->fields[] = explode(':', $item);
        }
    }

    protected function createBaseDirectories()
    {
        $formatDir = explode('/', $this->moduleName);
        if (count($formatDir) > 1) {
            $this->moduleName = array_pop($formatDir);
            $subPath = implode('/', $formatDir);
            $this->baseDirectory .= $subPath . '/';
            File::ensureDirectoryExists($this->baseDirectory);
        }

        File::ensureDirectoryExists($this->baseDirectory . $this->moduleName);
    }

    protected function createSubDirectories()
    {
        $subDirs = ['Actions', 'Validations', 'Models', 'Database', 'Controller', 'Others', 'Routes', 'Seeder'];
        foreach ($subDirs as $dir) {
            File::ensureDirectoryExists($this->baseDirectory . $this->moduleName . "/{$dir}");
        }
    }

    protected function generateFiles()
    {
        $module_path = $this->getModulePath();
        $fields = $this->fields;

        $files = [
            'Actions/GetAllData.php' => GetAllData($module_path, $fields),
            'Actions/StoreData.php' => StoreData($module_path),
            'Actions/GetSingleData.php' => GetSingleData($module_path),
            'Actions/UpdateData.php' => UpdateData($module_path),
            'Actions/UpdateStatus.php' => UpdateStatus($module_path),
            'Actions/DestroyData.php' => DestroyData($module_path),
            'Actions/RestoreData.php' => RestoreData($module_path),
            'Actions/SoftDelete.php' => SoftDelete($module_path),
            'Actions/ImportData.php' => ImportData($module_path, $fields),
            'Actions/BulkActions.php' => BulkActions($module_path),
            'Validations/DataStoreValidation.php' => DataStoreValidation($module_path, $fields),
            'Validations/BulkActionsValidation.php' => BulkActionsValidation($module_path, $fields),
            'Controller/Controller.php' => Controller($module_path, $fields),
            'Models/Model.php' => Model($module_path, $this->moduleName),
            "Database/create_" . Str::plural(Str::snake($this->moduleName)) . "_table.php" => Migration($module_path, $fields),
            'Routes/Route.php' => RouteContent($module_path, $this->moduleName),
            'Others/Api.http' => ApiDocumentation($this->moduleName),
            'Others/Doc.txt' => Documentation(),
            'Others/ImportJob.php' => ImportJob($this->moduleName),
            'Seeder/Seeder.php' => Seeder($module_path, $this->moduleName, $fields),
        ];

        foreach ($files as $relativePath => $content) {
            File::put($this->baseDirectory . $this->moduleName . '/' . $relativePath, $content);
        }
    }

    protected function runMigration()
    {
        $table = Str::plural(Str::snake($this->moduleName));
        $migrationPath = "/app/Modules/Management/{$this->ViewModuleName}/Database/create_{$table}_table.php";
        Artisan::call('migrate', ['--path' => $migrationPath]);
    }

    protected function runSeeder()
    {
        $path = str_replace('/', '\\', $this->ViewModuleName);
        $seederClass = "\\App\\Modules\\Management\\{$path}\\Seeder\\Seeder";
        Artisan::call('db:seed', ['--class' => $seederClass]);
    }

    protected function appendRouteToApiRoutes()
    {
        $filePath = base_path("app/Modules/Routes/ApiRoutes.php");
        $routeInclude = "include_once base_path(\"app/Modules/Management/{$this->ViewModuleName}/Routes/Route.php\");\n";

        if (!str_contains(file_get_contents($filePath), $routeInclude)) {
            file_put_contents($filePath, $routeInclude, FILE_APPEND);
        }
    }

    protected function getModulePath()
    {
        $parts = explode('/', $this->ViewModuleName);
        if (count($parts) > 1) {
            $module = array_pop($parts);
            return implode('/', $parts) . '/' . $module;
        }
        return $this->moduleName;
    }

    /*
    |--------------------------------------------------------------------------
    | Vue js Management Module
    | Vue js Management Module
    |--------------------------------------------------------------------------
    */

    protected function generateVueFiles()
    {
        $role = 'SuperAdmin';
        $fields = $this->fields;
        $vue_format_dir = explode('/', $this->ViewModuleName);
        $ViewModuleName = end($vue_format_dir);
        $vue_module_path_dir = $this->ViewModuleName;

        $roleVueDirectory = resource_path("js/backend/Views/{$role}/Management/");
        $globalVueDirectory = resource_path("js/backend/GlobalManagement/");
        $vueDirectory = $this->createVueDirectories($roleVueDirectory, $vue_format_dir);
        $rolesVueDirectory = $this->createVueDirectories($globalVueDirectory, $vue_format_dir);

        $this->copyVueSourceFiles($vueDirectory, $ViewModuleName);
        $this->copyVueSourceFilesRoles($rolesVueDirectory, $ViewModuleName);
        $this->generateVueSetupFiles($vueDirectory, $ViewModuleName, $vue_module_path_dir, $fields);
        $this->appendToVueRoutesFile($role, $ViewModuleName, $vue_module_path_dir);
        $this->appendToVueSidebar($role, $ViewModuleName);
        $this->generateVueRoleFiles( $rolesVueDirectory, $ViewModuleName);
    }

    /*
    |--------------------------------------------------------------------------
    | CreateVueDirectories
    |--------------------------------------------------------------------------
    */
    protected function createVueDirectories($vueDirectory, $vue_format_dir)
    {
        if (count($vue_format_dir) > 1) {
            array_pop($vue_format_dir);
            $vue_module_dir = implode('/', $vue_format_dir);

            if (!File::isDirectory($vueDirectory . $vue_module_dir)) {
                File::makeDirectory($vueDirectory . $vue_module_dir, 0777, true);
            }

            $vueDirectory .= $vue_module_dir . '/';
        }

        return $vueDirectory;
    }

    /*
    |--------------------------------------------------------------------------
    | CopyVueSourceFiles
    |--------------------------------------------------------------------------
    */

    protected function copyVueSourceFiles($vueDirectory, $ViewModuleName)
    {
        $targetDirectory = $vueDirectory . $ViewModuleName;
        $sourceDirectory = base_path('app/Modules/Helpers/CommandFiles/FrontendModule/Source');

        File::ensureDirectoryExists($targetDirectory);
        if (File::isDirectory(directory: $sourceDirectory)) {
            File::copyDirectory($sourceDirectory, $targetDirectory);
        } else {
            echo "Source directory does not exist.";
        }
    }
    protected function copyVueSourceFilesRoles($vueDirectory, $ViewModuleName)
    {
        $targetDirectory = $vueDirectory . $ViewModuleName;
        $sourceDirectory = base_path('app/Modules/Helpers/CommandFiles/FrontendModule/Source');

        File::ensureDirectoryExists($targetDirectory);
        if (File::isDirectory(directory: $sourceDirectory)) {
            File::copyDirectory($sourceDirectory, $targetDirectory);
        } else {
            echo "Source directory does not exist.";
        }
    }

    protected function generateVueSetupFiles($vueDirectory, $ViewModuleName, $vue_module_path_dir, $fields)
    {
        $SetupDirectory = "{$vueDirectory}{$ViewModuleName}/setup";
        File::ensureDirectoryExists($SetupDirectory);

        File::put("{$SetupDirectory}/form_fields.js", FormField($fields));
        File::put("{$SetupDirectory}/index.ts", SetupIndex($vue_module_path_dir, $fields));
    }

    protected function generateVueRoleFiles($rolesVueDirectory,$ViewModuleName)
    {
        $SetupDirectory = "{$rolesVueDirectory}";
        File::ensureDirectoryExists($SetupDirectory);

        File::put("{$SetupDirectory}/All.vue", ManagementAllPage($ViewModuleName));
        File::put("{$SetupDirectory}/Details.vue", ManagementDetailsPage($ViewModuleName));
        File::put("{$SetupDirectory}/Form.vue", ManagementDetailsPage($ViewModuleName));
    }

    protected function appendToVueRoutesFile($role, $ViewModuleName, $vue_module_path_dir)
    {
        $filePath = base_path("resources/js/backend/Views/{$role}/Routes/routes.js");
        $routeImport = "import {$ViewModuleName}Routes from '../../../GlobalManagement/{$vue_module_path_dir}/setup/routes.js';\n";
        $newRouteChild = "        {$ViewModuleName}Routes,\n";

        $fileContent = file_get_contents($filePath);

        if (strpos($fileContent, $routeImport) === false) {
            $importPosition = strpos($fileContent, "//routes");
            if ($importPosition !== false) {
                $insertPosition = $importPosition + strlen("//routes") + 1;
                $fileContent = substr_replace($fileContent, $routeImport, $insertPosition, 0);
            }
        }

        if (strpos($fileContent, $newRouteChild) === false) {
            $managementRoutesPosition = strpos($fileContent, "//management routes");
            if ($managementRoutesPosition !== false) {
                $insertPosition = $managementRoutesPosition + strlen("//management routes") + 1;
                $fileContent = substr_replace($fileContent, $newRouteChild, $insertPosition, 0);
            }
        }

        file_put_contents($filePath, $fileContent);
    }

    protected function appendToVueSidebar($role, $ViewModuleName)
    {
        $filePath = base_path("resources/js/backend/Views/{$role}/Layouts/Partials/Sidebar/Index.vue");
        $vue_format_dir = explode('/', $this->ViewModuleName);
        $fileContent = file_get_contents($filePath);

        if (count($vue_format_dir) > 1) {
            $parent = ucwords($vue_format_dir[0]);
            $child = ucwords(end($vue_format_dir));
            $menuRoute = "All{$child}";
            $menuItem = <<<MENU
          {
            route_name: `{$menuRoute}`,
            title: `{$child}`,
            icon: `zmdi zmdi-dot-circle-alt`,
          },
MENU;

            $pattern = "/<side-bar-drop-down-menus[^>]*:menu_title=\"`{$parent}`\"[^>]*:menus=\"\\[\s*(.*?)\s*\\]\"/s";

            if (preg_match($pattern, $fileContent, $matches, PREG_OFFSET_CAPTURE)) {
                $menusBlock = $matches[1][0];
                $menusStart = $matches[1][1];

                if (!preg_match('/route_name:\s*`' . preg_quote($menuRoute, '/') . '`/', $menusBlock)) {
                    $insertPos = $menusStart + strlen($menusBlock);
                    $fileContent = substr_replace($fileContent, $menuItem, $insertPos, 0);
                    file_put_contents($filePath, $fileContent);
                }
            } else {
                $sidebarMenuContent = <<<HTML
<side-bar-drop-down-menus
        :icon="`fa fa-plus`"
        :menu_title="`{$parent}`"
        :menus="[
{$menuItem}
        ]"
/>\n
HTML;
                $managementEndPosition = strpos($fileContent, "<!-- Management end -->");
                if ($managementEndPosition !== false) {
                    $fileContent = substr($fileContent, 0, $managementEndPosition) . $sidebarMenuContent . substr($fileContent, $managementEndPosition);
                    file_put_contents($filePath, $fileContent);
                }
            }
        } else {
            $title = ucwords(str_replace('-', ' ', $this->ViewModuleName));
            $menuRoute = "All{$this->ViewModuleName}";
            $sidebarMenuContent = <<<HTML
<side-bar-single-menu :icon="`fa fa-plus`" :menu_title="`{$title}`"  :route_name="`{$menuRoute}`" />\n
HTML;

            if (strpos($fileContent, trim($sidebarMenuContent)) === false) {
                $managementEndPosition = strpos($fileContent, "<!-- Management end -->");
                if ($managementEndPosition !== false) {
                    $fileContent = substr($fileContent, 0, $managementEndPosition) . $sidebarMenuContent . substr($fileContent, $managementEndPosition);
                    file_put_contents($filePath, $fileContent);
                }
            }
        }
    }
}
