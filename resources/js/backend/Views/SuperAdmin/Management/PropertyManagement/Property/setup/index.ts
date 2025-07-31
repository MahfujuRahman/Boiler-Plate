import app_config from "../../../../../../Config/app_config";
import setup_type from "./setup_type";

const prefix: string = "Property";

const setup: setup_type = {
  prefix,
  permission: ["admin", "super_admin"],

  api_host: app_config.api_host,
  api_version: app_config.api_version,
  api_end_point: "properties",

  module_name: "property",
  store_prefix: "property",
  route_prefix: "Property",
  route_path: "property",

  select_fields: [
    "id",
    "banner_image",
    "property_group_id",
    "property_category_id",
    "property_status",
    "date",
    "property_name",
    "property_address",
    "property_description",
    "property_detail",
    "facts_and_features",
    "gallery",
    "amenities",
    "floor_plan",
    "floor_plan_details",
    "property_video_url",
    "map_location_url",
    "status",
    "slug",
    "created_at",
    "deleted_at",
  ],

  sort_by_cols: [
    "id",
    "property_name",
    "property_address",
    "property_description",
    "property_detail",
    "status",
    "created_at",
  ],
  table_header_data: [
    "id",
    "property_name",
    "property_address",
    "property_detail",
    "status",
    "created_at",
  ],
  table_row_data: [
    "id",
    "property_name",
    "property_address",
    "property_detail",
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
