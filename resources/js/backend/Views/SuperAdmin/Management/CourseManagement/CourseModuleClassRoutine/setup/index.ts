
import app_config from "../../../../../../Config/app_config";
import setup_type from "./setup_type";

const prefix: string = "CourseModuleClassRoutine";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "course-module-class-routines",

    module_name: "course-module-class-routine",
    store_prefix: "course_module_class_routine",
    route_prefix: "CourseModuleClassRoutine",
    route_path: "course-module-class-routine",

    select_fields: [
        "id",
        "course_id",
            "module_id",
            "class_id",
            "date",
            "time",
            "topic",
        "status",
        "slug",
        "created_at",
        "deleted_at",
    ],

    sort_by_cols: [
        "id",
        "course_id",
            "module_id",
            "class_id",
            "date",
            "time",
            "topic",
        "status",
        "created_at",
    ],
    table_header_data: [
        "id",
        "course_id",
            "module_id",
            "class_id",
            "date",
            "time",
            "topic",
        "status",
        "created_at",
    ],
    table_row_data: [
        "id",
        "course_id",
            "module_id",
            "class_id",
            "date",
            "time",
            "topic",
        "status",
        "created_at",
    ],

    layout_title: prefix + " Management",
    page_title: `${prefix} Management`,

    all_page_title: "All " + prefix,
    details_page_title: "Details " + prefix,
    create_page_title: "Create " + prefix,
    edit_page_title: "Edit " + prefix,
};

export default setup;
