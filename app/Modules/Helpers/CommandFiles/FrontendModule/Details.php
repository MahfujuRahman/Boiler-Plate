<?php

use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
|
|--------------------------------------------------------------------------
|
*/

if (!function_exists('ManagementDetailsPage')) {
    function ManagementDetailsPage($moduleName)
    {
        $formated_module = explode('/', $moduleName);

        if (count($formated_module) > 1) {

            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }


        $content = <<<EOD
        
        <template>
            <details> </details>
        </template>

        <script>

        import Details from '../../../../../GlobalManagement/{$moduleName}/pages/Details.vue';

        export default {
            components: {
                Details : Details
            },
        
        };
        </script>

        EOD;

        return $content;
    }
}
