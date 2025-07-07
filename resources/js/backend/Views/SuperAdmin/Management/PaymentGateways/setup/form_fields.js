export default [
	{
		name: "provider_name",
		label: "Enter your provider name",
		type: "select",
		label: "Select provider name",
		multiple: false,
		data_list: [
			{
				label: "Bkash",
				value: "bkash",
			},
			{
				label: "Nagad",
				value: "nagad",
			},
			{
				label: "Sslcommerze",
				value: "sslcommerze",
			},
		],
		value: "",
	},

	{
		name: "api_key",
		label: "Enter your api key",
		type: "text",
		value: "",
	},

	{
		name: "secret_key",
		label: "Enter your secret key",
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
		name: "live",
		label: "Enter your live",
		type: "radio",
		value: "",
	},
];
