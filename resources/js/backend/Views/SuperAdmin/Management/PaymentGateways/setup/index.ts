
import app_config from "../../../../../Config/app_config";
import setup_type from "./setup_type";

const prefix: string = "PaymentGateway";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "payment-gateways",

    module_name: "payment-gateway",
    store_prefix: "payment_gateway",
    route_prefix: "PaymentGateways",
    route_path: "payment-gateway",

    select_fields: [
        "id",
        "provider_name",
            "api_key",
            "secret_key",
            "username",
            "password",
            "live",
        "status",
        "slug",
        "created_at",
        "deleted_at",
    ],

    sort_by_cols: [
        "id",
        "provider_name",
            "api_key",
            "secret_key",
            "username",
            "password",
            "live",
        "status",
        "created_at",
    ],
    table_header_data: [
        "id",
        "provider_name",
            "api_key",
            "secret_key",
            "username",
            "password",
            "live",
        "status",
        "created_at",
    ],
    table_row_data: [
        "id",
        "provider_name",
            "api_key",
            "secret_key",
            "username",
            "password",
            "live",
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
