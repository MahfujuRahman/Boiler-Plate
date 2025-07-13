



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
        <Form></Form>
        </template>

        <script>

        import Form from '../../../../../GlobalManagement/{$moduleName}/pages/Form.vue';

        export default {
            components: {
                Form : Form
            },
        
        };
        </script>


        EOD;

        return $content;
    }
}
