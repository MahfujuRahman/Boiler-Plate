export default [
	{
		name: "quiz_question_topic_id",
		label: "Enter your quiz question topic id",
		type: "number",
		value: "",
	},

	{
		name: "title",
		label: "Enter your title",
		type: "text",
		value: "",
	},

	{
		name: "question_level",
		label: "Enter your question level",
		type: "select",
		label: "Select question level",
		multiple: false,
		data_list: [
			{
				label: "Easy",
				value: "easy",
			},
			{
				label: "Medium",
				value: "medium",
			},
			{
				label: "Hard",
				value: "hard",
			},
		],
		value: "",
	},

	{
		name: "mark",
		label: "Enter your mark",
		type: "text",
		value: "",
	},

	{
		name: "is_multiple",
		label: "Enter your is multiple",
		type: "radio",
		value: "",
	},

	{
		name: "session_year",
		label: "Enter your session year",
		type: "text",
		value: "",
	},
];
