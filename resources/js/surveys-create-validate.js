export default function validate(contents) {
    // validate if all labels and thus names are unique
    const all_names = contents.map((content) => content.name);
    if (new Set(all_names).size !== all_names.length) {
        console.log("Name must be unique");
        return 1;
    }

    for (let i = 0; i < contents.length; i++) {
        const self = contents[i];

        // validate if all names are filled
        if (!self.name) {
            console.log(`Missing name at ${i + 1}. ${self.type.toUpperCase()}`);
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
                        }. ${self.type.toUpperCase()} - Question ${j + 1}`
                    );
                    return 1;
                }

                // validate if all questions's labels are filled
                if (!selfq.label) {
                    console.log(
                        `Missing label at ${
                            i + 1
                        }. ${self.type.toUpperCase()} - Question ${j + 1}`
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
}
