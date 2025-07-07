
import app_config from "../../../../../../Config/app_config";
import setup_type from "./setup_type";

const prefix: string = "WebsiteMWebsiteBanner";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "website-m-website-banners",

    module_name: "website-m-website-banner",
    store_prefix: "website_m_website_banner",
    route_prefix: "WebsiteMWebsiteBanner",
    route_path: "website-m-website-banner",

    select_fields: [
        "id",
        "title",
            "subtitle",
            "is_featured",
            "image",
            "btn_one_text",
            "btn_one_url",
            "btn_two_text",
            "btn_two_url",
        "status",
        "slug",
        "created_at",
        "deleted_at",
    ],

    sort_by_cols: [
        "id",
        "title",
            "subtitle",
            "is_featured",
            "image",
            "btn_one_text",
            "btn_one_url",
            "btn_two_text",
            "btn_two_url",
        "status",
        "created_at",
    ],
    table_header_data: [
        "id",
        "title",
            "subtitle",
            "is_featured",
            "image",
            "btn_one_text",
            "btn_one_url",
            "btn_two_text",
            "btn_two_url",
        "status",
        "created_at",
    ],
    table_row_data: [
        "id",
        "title",
            "subtitle",
            "is_featured",
            "image",
            "btn_one_text",
            "btn_one_url",
            "btn_two_text",
            "btn_two_url",
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
