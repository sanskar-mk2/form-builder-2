export default function handler(initial_content = []) {
    return {
        add_dd: false,
        dragging: false,
        contents: initial_content,
        add_text() {
            this.contents.push({
                type: "text",
                name: "",
                label: "",
                required: false,
            });
        },
        add_checkbox() {
            this.contents.push({
                type: "checkbox",
                name: "",
                label: "",
                options: [],
                required: false,
            });
        },
        add_description() {
            this.contents.push({
                type: "description",
                name: "",
                label: "",
                required: false,
            });
        },
        add_radio() {
            this.contents.push({
                type: "radio",
                name: "",
                label: "",
                options: [],
                required: false,
            });
        },
        add_likert() {
            this.contents.push({
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
            });
        },
        add_likert_grid() {
            this.contents.push({
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
            });
        },
        add_select() {
            this.contents.push({
                type: "select",
                name: "",
                label: "",
                options: [],
                required: false,
            });
        },
        add_date() {
            this.contents.push({
                type: "date",
                name: "",
                label: "",
                required: false,
                format: "YYYY-MM-DD",
            });
        },
        add_question(index) {
            this.contents[index].questions.push({ label: "", name: "" });
        },
        remove_question(index, q_index) {
            this.contents[index].questions.splice(q_index, 1);
        },
        add_option(index) {
            this.contents[index].options.push({ option: "", value: "" });
        },
        remove_option(index, op_index) {
            this.contents[index].options.splice(op_index, 1);
        },
        remove(index) {
            console.log(this.contents);
            this.contents.splice(index, 1);
        },
        reorder(src_idx, target_idx) {
            const temp = this.contents[src_idx];
            this.contents[src_idx] = this.contents[target_idx];
            this.contents[target_idx] = temp;
        },
        validate() {
            // validate if all labels and thus names are unique
            const all_names = this.contents.map((content) => content.name);
            if (new Set(all_names).size !== all_names.length) {
                console.log("Name must be unique");
                return 1;
            }

            for (let i = 0; i < this.contents.length; i++) {
                const self = this.contents[i];

                // validate if all names are filled
                if (!self.name) {
                    console.log(
                        `Missing name at ${i + 1}. ${self.type.toUpperCase()}`
                    );
                    return 1;
                }

                // validate if all labels are filled
                if (!self.label) {
                    console.log(
                        `Missing label at ${i + 1}. ${self.type.toUpperCase()}`
                    );
                    return 1;
                }
                
                // validate date format is filled
                if (self.hasOwnProperty("format")) {
                    if (!self.format) {
                        console.log(
                            `Missing format at ${i + 1}. ${self.type.toUpperCase()}`
                        );
                        return 1;
                    }
                }

                if (self.hasOwnProperty("options")) {
                    // validate if options exist
                    if (self.options.length === 0) {
                        console.log(
                            `Missing options at ${
                                i + 1
                            }. ${self.type.toUpperCase()} | Please add at least one option`
                        );
                        return 1;
                    }

                    for (let j = 0; j < self.options.length; j++) {
                        const selfop = self.options[j];

                        // validate if all option's values are filled
                        if (!selfop.value) {
                            console.log(
                                `Missing value at ${
                                    i + 1
                                }. ${self.type.toUpperCase()} - Option ${j + 1}`
                            );
                            return 1;
                        }

                        // validate if all option's labels are filled
                        if (!selfop.option) {
                            console.log(
                                `Missing label at ${
                                    i + 1
                                }. ${self.type.toUpperCase()} - Option ${j + 1}`
                            );
                            return 1;
                        }
                    }

                    // validate if all option's values are unique
                    const all_op_names = self.options.map((op) => op.value);
                    if (new Set(all_op_names).size !== all_op_names.length) {
                        console.log(
                            `Options must be unique at ${
                                i + 1
                            }. ${self.type.toUpperCase()}`
                        );
                        return 1;
                    }
                }

                // validate questions
                if (self.hasOwnProperty("questions")) {
                    // validate if questions exist
                    if (self.questions.length === 0) {
                        console.log(
                            `Missing questions at ${
                                i + 1
                            }. ${self.type.toUpperCase()} | Please add at least one question`
                        );
                        return 1;
                    }

                    for (let j = 0; j < self.questions.length; j++) {
                        const selfq = self.questions[j];

                        // validate if all questions's names are filled
                        if (!selfq.name) {
                            console.log(
                                `Missing name at ${
                                    i + 1
                                }. ${self.type.toUpperCase()} - Question ${
                                    j + 1
                                }`
                            );
                            return 1;
                        }

                        // validate if all questions's labels are filled
                        if (!selfq.label) {
                            console.log(
                                `Missing label at ${
                                    i + 1
                                }. ${self.type.toUpperCase()} - Question ${
                                    j + 1
                                }`
                            );
                            return 1;
                        }
                    }

                    // validate if all questions's names are unique
                    const all_q_names = self.questions.map((q) => q.name);
                    if (new Set(all_q_names).size !== all_q_names.length) {
                        console.log(
                            `Questions must be unique at ${
                                i + 1
                            }. ${self.type.toUpperCase()}`
                        );
                        return 1;
                    }
                }
            }
            console.log("validate success");
            return 0;
        },
        set_names() {
            for (let i = 0; i < this.contents.length; i++) {
                const self = this.contents[i];
                self.name = this.slugify(self.label);
            }
        },
        slugify(text) {
            return text
                .toString()
                .toLowerCase()
                .replace(/\s+/g, "-") // Replace spaces with -
                .replace(/[^\w\-]+/g, "") // Remove all non-word chars
                .replace(/\-\-+/g, "-") // Replace multiple - with single -
                .replace(/^-+/, "") // Trim - from start of text
                .replace(/-+$/, ""); // Trim - from end of text
        },
    };
}
