export default [
  {
    name: "title",
    label: "Title",
    type: "text",
    value: "",
  },
  {
    name: "can_login",
    label: "Can login",
    type: "select",
    value: "0",
    is_visible: true,
    data_list: [
      {
        label: "Yes",
        value: "income",
      },
      {
        label: "No",
        value: "expense",
      },
    ],
  },

  {
    name: "picture",
    label: "picture",
    type: "file",
    multiple: false,
    value: "",
	row_col_class: "col-md-12",
  },

  {
    name: "description",
    label: "description",
    type: "textarea",
    value: "",
    row_col_class: "col-md-12",
  },
];
