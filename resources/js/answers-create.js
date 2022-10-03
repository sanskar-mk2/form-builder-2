export default function answer_data(survey, initial_content = {}) {
    const contents = {};
    survey.forEach((content) => {
        if (content.type === "radio" || content.type === "checkbox") {
            contents[content.name] = initial_content[content.name] || [];
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
                if (self.required && !this.contents[self.name]) {
                    console.log("Required field is empty");
                    return 1;
                }
            }
            return 0;
        },
    };
}
