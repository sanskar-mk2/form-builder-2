export default function answer_data(survey, initial_content = {}) {
    const all_names = survey.map((content) => content.name);
    const contents = {};
    for (let i = 0; i < all_names.length; i++) {
        const name = all_names[i];
        contents[name] = initial_content[name] || "";
    }
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
