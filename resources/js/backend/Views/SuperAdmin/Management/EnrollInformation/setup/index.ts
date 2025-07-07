
import app_config from "../../../../../Config/app_config";
import setup_type from "./setup_type";

const prefix: string = "EnrollInformation";

const setup: setup_type = {
    prefix,
    permission: ["admin", "super_admin"],

    api_host: app_config.api_host,
    api_version: app_config.api_version,
    api_end_point: "enroll-informations",

    module_name: "enroll-information",
    store_prefix: "enroll_information",
    route_prefix: "EnrollInformation",
    route_path: "enroll-information",

    select_fields: [
        "id",
        "course_id",
            "student_id",
            "batch_id",
            "payment_type",
            "payment_by",
            "receipt_id",
            "trx_id",
            "payment_status",
            "total_amount",
            "paid_amount",
        "status",
        "slug",
        "created_at",
        "deleted_at",
    ],

    sort_by_cols: [
        "id",
        "course_id",
            "student_id",
            "batch_id",
            "payment_type",
            "payment_by",
            "receipt_id",
            "trx_id",
            "payment_status",
            "total_amount",
            "paid_amount",
        "status",
        "created_at",
    ],
    table_header_data: [
        "id",
        "course_id",
            "student_id",
            "batch_id",
            "payment_type",
            "payment_by",
            "receipt_id",
            "trx_id",
            "payment_status",
            "total_amount",
            "paid_amount",
        "status",
        "created_at",
    ],
    table_row_data: [
        "id",
        "course_id",
            "student_id",
            "batch_id",
            "payment_type",
            "payment_by",
            "receipt_id",
            "trx_id",
            "payment_status",
            "total_amount",
            "paid_amount",
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
