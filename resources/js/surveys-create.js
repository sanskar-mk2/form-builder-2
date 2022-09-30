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
        add_description() {
            this.contents.push({
                type: "description",
                name: "",
                label: "",
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
            console.log(this.contents);
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

                if (self.hasOwnProperty("options")) {
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
