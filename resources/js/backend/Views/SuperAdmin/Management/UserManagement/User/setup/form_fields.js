export default [
  {
    name: "name",
    label: "  name",
    type: "text",
    value: "",
  },

  {
    name: "email",
    label: "  email",
    type: "text",
    value: "",
  },
  {
    name: "phone_number",
    label: "  phone number",
    type: "text",
    value: "",
  },

  {
    name: "password_in_text",
    label: "  password",
    type: "text",
    value: "",
  },
  {
    name: "present_address",
    label: " present  address",
    type: "text",
    value: "",
  },
  {
    name: "permanent_address",
    label: " permanent address",
    type: "text",
    value: "",
  },
  {
    name: "designation",
    label: " designation",
    type: "text",
    value: "",
  },
  {
    name: "nid",
    label: " nid",
    type: "text",
    value: "",
  },
  {
    name: "role_id",
    label: "Select  role ",
    type: "select",
    value: "",
    data_list: [],
    onchange: "changeAction",
  },
  {
    name: "join_date",
    label: " join date",
    type: "date",
    value: "",
    is_visible: false,
  },

  {
    name: "salery",
    label: "  salary",
    type: "number",
    value: "",
    is_visible: false,
  },

  {
    name: "can_login",
    label: "Can login",
    type: "select",
    value: "0",
    is_visible: false,
    data_list: [
      {
        label: "Yes",
        value: "1",
      },
      {
        label: "No",
        value: "0",
      },
    ],
  },

  {
    name: "image",
    label: "  image",
    type: "file",
    multiple: false,
    value: "",
  },

  {
    name: "description",
    label: "  comment",
    type: "textarea",
    value: "",
    row_col_class: "col-md-12",
  },
];
