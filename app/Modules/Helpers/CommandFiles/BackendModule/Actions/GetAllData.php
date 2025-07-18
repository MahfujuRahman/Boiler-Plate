<?php

use Illuminate\Support\Str;

if (!function_exists('GetAllData')) {
    function GetAllData($moduleName, $fields, $fieldsWithBraces = [])
    {


        $formated_module = explode('/', $moduleName);

        // dd($formated_module);

        if (count($formated_module) > 1) {
            $moduleName = implode('/', $formated_module);
            $moduleName = Str::replace("/", "\\", $moduleName);
        } else {
            $moduleName = Str::replace("/", "\\", $moduleName);
        }

        $form_fields = [];

        foreach ($fields as $field) {

            $form_fields[] = $field[0];
        }

        if ($fieldsWithBraces && !empty($fieldsWithBraces)) {
            $relationName = '';
            foreach ($fieldsWithBraces as $field) {
                $relationName .= "                 \$with = ['{$field['field']}'];\n";
            }
        } else {
            $relationName = "                 \$with = [];\n";
        }




        $content = <<<"EOD"
        <?php

        namespace App\\Modules\\Management\\{$moduleName}\\Actions;

        class GetAllData
        {
            static \$model = \App\Modules\\Management\\{$moduleName}\\Models\\Model::class;

            public static function execute()
            {
                try {

                    \$pageLimit = request()->input('limit') ?? 10;
                    \$orderByColumn = request()->input('sort_by_col') ?? 'id';
                    \$orderByType = request()->input('sort_type') ?? 'desc';
                    \$status = request()->input('status') ?? 'active';
                    \$fields = request()->input('fields') ?? '*';
                    \$start_date = request()->input('start_date');
                    \$end_date = request()->input('end_date');
        
                   {$relationName}
                    \$condition = [];

                    \$data = self::\$model::query();

                    if (request()->has('search') && request()->input('search')) {
                        \$searchKey = request()->input('search');
                        \$data = \$data->where(function (\$q) use (\$searchKey) {
        EOD;
        $first = true;
        foreach ($form_fields as $field) {
            if ($first) {
                $content .= <<<EOD

                    \$q->where('$field', 'like', '%' . \$searchKey . '%');
                EOD;
                $first = false;
            } else {
                $content .= <<<EOD
                    \n
                    \$q->orWhere('$field', 'like', '%' . \$searchKey . '%');
                EOD;
            }
        }

        $content .= <<<EOD
                      \n
                        });
                    }

                    if (\$start_date && \$end_date) {
                         if (\$end_date > \$start_date) {
                            \$data->whereBetween('created_at', [\$start_date . ' 00:00:00', \$end_date . ' 23:59:59']);
                        } elseif (\$end_date == \$start_date) {
                            \$data->whereDate('created_at', \$start_date);
                        }
                    }

                    if (\$status == 'trased') {
                        \$data = \$data->trased();
                    }

                    if (request()->has('get_all') && (int)request()->input('get_all') === 1) {
                        \$data = \$data
                            ->with(\$with)
                            ->select(\$fields)
                            ->where(\$condition)
                            ->where('status', \$status)
                            ->limit(\$pageLimit)
                            ->orderBy(\$orderByColumn, \$orderByType)
                            ->get();
                             return entityResponse(\$data);
                    } else if (\$status == 'trased') {
                        \$data = \$data
                            ->with(\$with)
                            ->select(\$fields)
                            ->where(\$condition)
                            ->orderBy(\$orderByColumn, \$orderByType)
                            ->paginate(\$pageLimit);
                    } else {
                        \$data = \$data
                            ->with(\$with)
                            ->select(\$fields)
                            ->where(\$condition)
                            ->where('status', \$status)
                            ->orderBy(\$orderByColumn, \$orderByType)
                            ->paginate(\$pageLimit);
                    }

                    return entityResponse([
                        ...\$data->toArray(),
                        "active_data_count" => self::\$model::active()->count(),
                        "inactive_data_count" => self::\$model::inactive()->count(),
                        "trased_data_count" => self::\$model::trased()->count(),
                    ]);

                } catch (\Exception \$e) {
                    return messageResponse(\$e->getMessage(), [], 500, 'server_error');
                }
            }
        }
        EOD;

        return $content;
    }
}
