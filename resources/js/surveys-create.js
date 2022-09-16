export default function handler() {
    return {
        add_dd: false,
        contents: [],
        add_text() {
            this.contents.push({
                type: "text",
                name: "",
                label: "",
            });
        },
        add_description() {
            this.contents.push({
                type: "description",
                name: "",
                label: "",
            });
        },
        remove(index) {
            console.log(this.contents);
            this.contents.splice(index, 1);
        },
    };
}
