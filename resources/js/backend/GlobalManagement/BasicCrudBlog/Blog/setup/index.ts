import app_config from "../../../../../../Config/app_config";
import setup_type from "./setup_type";

const prefix: string = "Blog";

const setup: setup_type = {
  prefix,
  permission: ["admin", "super_admin"],

  api_host: app_config.api_host,
  api_version: app_config.api_version,
  api_end_point: "blogs",

  module_name: "blog",
  store_prefix: "blog",
  route_prefix: "Blog",
  route_path: "blog",

  select_fields: [
    "id",
    "blog_category_id",
    "title",
    "description",
    "tags",
    "publish_date",
    "writer",
    "meta_description",
    "meta_keywords",
    "thumbnail_image",
    "images",
    "blog_type",
    "url",
    "show_top",
    "status",
    "slug",
    "created_at",
    "deleted_at",
  ],

  sort_by_cols: [
    "id",

    "title",
    "description",
    "tags",
    "publish_date",
    "writer",
    "meta_description",
    "meta_keywords",
    "thumbnail_image",

    "url",
    "show_top",
    "status",
    "created_at",
  ],
  table_header_data: [
    "id",

    "title",
    "description",
    "tags",
    "publish_date",
    "writer",
    "meta_description",
    "meta_keywords",
    "thumbnail_image",

    "url",
    "show_top",
    "status",
    "created_at",
  ],
  table_row_data: [
    "id",
    "title",
    "description",
    "tags",
    "publish_date",
    "writer",
    "meta_description",
    "meta_keywords",
    "thumbnail_image",
    "url",
    "show_top",
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
