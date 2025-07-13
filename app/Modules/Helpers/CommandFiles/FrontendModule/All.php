
<?php

use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
|
|--------------------------------------------------------------------------
|
*/

if (!function_exists('ManagementAllPage')) {
    function ManagementAllPage($moduleName)
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
            <All-page permision="[{all=true}]"></All-page>
        </template>

        <script>


        import Allpage from '../../../../../GlobalManagement/{$moduleName}/pages/All.vue';


        export default {
            components: {
                AllPage: Allpage,
            },
        }
        </script>

        <style scoped></style>
        EOD;

        return $content;
    }
}
