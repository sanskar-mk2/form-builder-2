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
    };
}
