
import app_config from "@config/app_config";
import setup_type from "./setup_type";

const prefix: string = "Gallery";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "galleries",

    module_name: "gallery",
    store_prefix: "gallery",
    route_prefix: "Gallery",
    route_path: "gallery",

    select_fields: [
        "id",
        "gallery_category_id",
            "title",
            "description",
            "image",
            "top_image",
        "status",
        "slug",
        "created_at",
        'deleted_at'
    ],

    sort_by_cols: [
        "id",
        "gallery_category_id",
            "title",
            "description",
            "image",
            "top_image",
        "status",
        "created_at",
    ],
    table_header_data: [
        "id",
        "gallery_category_id",
            "title",
            "description",
            "image",
            "top_image",
        "status",
        "created_at",
    ],
    table_row_data: [
        "id",
        "gallery_category_id",
            "title",
            "description",
            "image",
            "top_image",
        "status",
        "created_at",
    ],
    quick_view_data: [
        "id",
        "gallery_category_id",
            "title",
            "description",
            "image",
            "top_image",
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
