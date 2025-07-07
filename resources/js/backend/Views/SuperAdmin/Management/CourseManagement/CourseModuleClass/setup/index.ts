
import app_config from "../../../../../../Config/app_config";
import setup_type from "./setup_type";

const prefix: string = "CourseModuleClass";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "course-module-classes",

    module_name: "course-module-class",
    store_prefix: "course_module_class",
    route_prefix: "CourseModuleClass",
    route_path: "course-module-class",

    select_fields: [
        "id",
        "course_id",
            "milestone_id",
            "course_modules_id",
            "class_no",
            "title",
            "type",
            "class_video_link",
            "class_video_poster",
        "status",
        "slug",
        "created_at",
        "deleted_at",
    ],

    sort_by_cols: [
        "id",
        "course_id",
            "milestone_id",
            "course_modules_id",
            "class_no",
            "title",
            "type",
            "class_video_link",
            "class_video_poster",
        "status",
        "created_at",
    ],
    table_header_data: [
        "id",
        "course_id",
            "milestone_id",
            "course_modules_id",
            "class_no",
            "title",
            "type",
            "class_video_link",
            "class_video_poster",
        "status",
        "created_at",
    ],
    table_row_data: [
        "id",
        "course_id",
            "milestone_id",
            "course_modules_id",
            "class_no",
            "title",
            "type",
            "class_video_link",
            "class_video_poster",
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
