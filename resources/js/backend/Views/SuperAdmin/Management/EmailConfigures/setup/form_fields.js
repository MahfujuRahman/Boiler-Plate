export default [
  {
    name: "host",
    label: "Enter your host",
    type: "text",
    value: "",
  },

  {
    name: "port",
    label: "Enter your port",
    type: "number",
    value: "",
  },

  {
    name: "email",
    label: "Enter your email",
    type: "text",
    value: "",
  },

  {
    name: "username",
    label: "Enter your username",
    type: "text",
    value: "",
  },

  {
    name: "password",
    label: "Enter your password",
    type: "text",
    value: "",
  },

  {
    name: "mail_from_name",
    label: "Enter your mail from name",
    type: "text",
    value: "",
  },

  {
    name: "mail_from_email",
    label: "Enter your mail from email",
    type: "text",
    value: "",
  },

  {
    name: "encryption",
    label: "Enter your encryption",
    type: "select",
    value: '',
    data_list: [
      {
        label: "TLS",
        value: "0",
      },
      {
        label: "SSL",
        value: "1",
      },
    ],
  },
   {
    name: "status",
    label: "Active",
    type: "select",
    value: "",
	 data_list: [
      {
        label: "yes",
        value: "active",
      },
      {
        label: "no",
        value: "inactive",
      },
    ],
  },
];
