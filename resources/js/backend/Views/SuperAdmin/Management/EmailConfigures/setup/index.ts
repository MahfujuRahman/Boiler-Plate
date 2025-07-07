
import app_config from "../../../../../Config/app_config";
import setup_type from "./setup_type";

const prefix: string = "EmailConfigure";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "email-configures",

    module_name: "email-configure",
    store_prefix: "email_configure",
    route_prefix: "EmailConfigure",
    route_path: "email-configure",

    select_fields: [
        "id",
        "host",
            "port",
            "email",
            "username",
            "password",
            "mail_from_name",
            "mail_from_email",
            "encryption",
        "status",
        "slug",
        "created_at",
        "deleted_at",
    ],

    sort_by_cols: [
        "id",
        "host",
            "port",
            "email",
            "username",
            "password",
            "mail_from_name",
            "mail_from_email",
            "encryption",
        "status",
        "created_at",
    ],
    table_header_data: [
        "id",
        "host",
            "port",
            "email",
            "username",
            "password",
            "mail_from_name",
            "mail_from_email",
            "encryption",
        "status",
        "created_at",
    ],
    table_row_data: [
        "id",
        "host",
            "port",
            "email",
            "username",
            "password",
            "mail_from_name",
            "mail_from_email",
            "encryption",
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
