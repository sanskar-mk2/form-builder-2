export default function answer_data(survey, initial_content = {}) {
    const contents = {};
    survey.forEach((content) => {
        if (content.type === "checkbox") {
            contents[content.name] = initial_content[content.name] || [];
        } else if (content.type === "likert_grid") {
            contents[content.name] =
                initial_content[content.name] ||
                _.defaults(...content.questions.map((q) => ({ [q.name]: "" })));
        } else {
            contents[content.name] = initial_content[content.name] || "";
        }
    });

    return {
        survey: survey,
        contents: contents,
        readonly: false,
        disabled: false,
        make_readonly() {
            this.readonly = true;
        },
        disable() {
            this.disabled = true;
        },
        validate_required() {
            for (let i = 0; i < this.survey.length; i++) {
                const self = this.survey[i];

                // separate validation for likert_grid
                if (self.required && self.type === "likert_grid") {
                    for (let j = 0; j < self.questions.length; j++) {
                        const q = self.questions[j];
                        if (this.contents[self.name][q.name] === "") {
                            console.log("Required likert group field is empty");
                            return 1;
                        }
                    }
                } else {
                    if (self.required && !this.contents[self.name].length) {
                        console.log("Required field is empty");
                        return 1;
                    }
                }
            }
            return 0;
        },
    };
}
