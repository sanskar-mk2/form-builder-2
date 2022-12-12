const add_text = {
    type: "text",
    name: "",
    label: "",
    required: false,
};

const add_checkbox = {
    type: "checkbox",
    name: "",
    label: "",
    options: [],
    required: false,
};

const add_description = {
    type: "description",
    name: "",
    label: "",
    required: false,
};

const add_radio = {
    type: "radio",
    name: "",
    label: "",
    options: [],
    required: false,
};

const add_drag_and_drop_ranking = {
    type: "drag_and_drop_ranking",
    name: "",
    label: "",
    options: [],
    required: false,
};

const add_likert = {
    type: "likert",
    name: "",
    label: "",
    options: [
        { option: "Very Dissatisfied", value: "very-dissatisfied" },
        { option: "Dissatisfied", value: "dissatisfied" },
        { option: "Neutral", value: "neutral" },
        { option: "Satisfied", value: "satisfied" },
        { option: "Very Satisfied", value: "very-satisfied" },
    ],
    required: false,
};

const add_likert_grid = {
    type: "likert_grid",
    name: "",
    label: "",
    questions: [],
    options: [
        { option: "Very Dissatisfied", value: "very-dissatisfied" },
        { option: "Dissatisfied", value: "dissatisfied" },
        { option: "Neutral", value: "neutral" },
        { option: "Satisfied", value: "satisfied" },
        { option: "Very Satisfied", value: "very-satisfied" },
    ],
    required: false,
};

export {
    add_text,
    add_checkbox,
    add_description,
    add_radio,
    add_drag_and_drop_ranking,
    add_likert,
    add_likert_grid,
};
