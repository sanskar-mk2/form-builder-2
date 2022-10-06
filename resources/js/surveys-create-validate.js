export default function validate(contents) {
    // validate if contents is not empty
    if (contents.length === 0) {
        return "Please enter some questions";
    }

    // validate if all labels and thus names are unique
    const all_names = contents.map((content) => content.name);
    if (new Set(all_names).size !== all_names.length) {
        return "Name must be unique";
    }

    for (let i = 0; i < contents.length; i++) {
        const self = contents[i];

        // validate if all names are filled
        if (!self.name) {
            return `Missing name at ${i + 1}. ${self.type.replace(/_/g, " ").toUpperCase()}`;
        }

        // validate if all labels are filled
        if (!self.label) {
            return `Missing label at ${i + 1}. ${self.type.replace(/_/g, " ").toUpperCase()}`;
        }

        // validate date format is filled
        if (self.hasOwnProperty("format")) {
            if (!self.format) {
                return `Missing format at ${i + 1}. ${self.type.replace(/_/g, " ").toUpperCase()}`;
            }
        }

        if (self.hasOwnProperty("options")) {
            // validate if options exist
            if (self.options.length === 0) {
                return `Missing options at ${
                    i + 1
                }. ${self.type.replace(/_/g, " ").toUpperCase()} | Please add at least one option`;
            }

            for (let j = 0; j < self.options.length; j++) {
                const selfop = self.options[j];

                // validate if all option's values are filled
                if (!selfop.value) {
                    return `Missing value at ${
                        i + 1
                    }. ${self.type.replace(/_/g, " ").toUpperCase()} - Option ${j + 1}`;
                }

                // validate if all option's labels are filled
                if (!selfop.option) {
                    return `Missing label at ${
                        i + 1
                    }. ${self.type.replace(/_/g, " ").toUpperCase()} - Option ${j + 1}`;
                }
            }

            // validate if all option's values are unique
            const all_op_names = self.options.map((op) => op.value);
            if (new Set(all_op_names).size !== all_op_names.length) {
                return `Options must be unique at ${
                    i + 1
                }. ${self.type.replace(/_/g, " ").toUpperCase()}`;
            }
        }

        // validate questions
        if (self.hasOwnProperty("questions")) {
            // validate if questions exist
            if (self.questions.length === 0) {
                return `Missing questions at ${
                    i + 1
                }. ${self.type.replace(/_/g, " ").toUpperCase()} | Please add at least one question`;
            }

            for (let j = 0; j < self.questions.length; j++) {
                const selfq = self.questions[j];

                // validate if all questions's names are filled
                if (!selfq.name) {
                    return `Missing name at ${
                        i + 1
                    }. ${self.type.replace(/_/g, " ").toUpperCase()} - Question ${j + 1}`;
                }

                // validate if all questions's labels are filled
                if (!selfq.label) {
                    return `Missing label at ${
                        i + 1
                    }. ${self.type.replace(/_/g, " ").toUpperCase()} - Question ${j + 1}`;
                }
            }

            // validate if all questions's names are unique
            const all_q_names = self.questions.map((q) => q.name);
            if (new Set(all_q_names).size !== all_q_names.length) {
                return `Questions must be unique at ${
                    i + 1
                }. ${self.type.replace(/_/g, " ").toUpperCase()}`;
            }
        }
    }
    console.log("validate success");
    return 0;
}
