export default [
  {
    name: "property_name",
    label: "Enter your property name",
    type: "text",
    value: "",
  },
  {
    name: "property_category_id",
    label: "Select property category ",
    type: "select",
    value: "",
    data_list: [],
  },
  {
    name: "price",
    label: "property price ",
    type: "number",
    value: "",
  },
  {
    name: "property_status",
    label: "Select property status",
    type: "select",
    label: "Select property status",
    data_list: [
      {
        label: "Rent",
        value: "rent",
      },
      {
        label: "Sale",
        value: "sale",
      },
    ],
    value: "",
  },

  // {
  // 	name: "date",
  // 	label: "Enter your date",
  // 	type: "date",
  // 	value: "",
  // },

  {
    name: "property_address",
    label: "Enter your property address",
    type: "text",
    value: "",
  },
  {
    name: "map_location_url",
    label: "Enter your map location url",
    type: "text",
    value: "",
  },
  {
    name: "property_video_url",
    label: "Enter your property video url",
    type: "text",
    value: "",
  },

  {
    name: "property_video_thmbnail",
    label: "Upload  property video thmbnail",
    type: "file",
    value: "",
    multiple: false,
  },

  {
    name: "banner_image",
    label: "Enter your banner image",
    type: "file",
    multiple: "true",
    images_list: [],
  },
  {
    name: "gallery",
    label: "Enter your gallery",
    type: "file",
    multiple: "true",
    images_list: [],
  },
  {
    name: "property_description",
    label: "Enter your property description",
    type: "textarea",
    value: "",
    row_col_class: "col-md-12",
  },

  {
    name: "property_detail",
    label: "Enter your property detail",
    type: "textarea",
    value: "",
    row_col_class: "col-md-12",
  },
];
