export default function handler(initial_content = []) {
    console.log(initial_content);
    return {
        add_dd: false,
        dragging: false,
        contents: initial_content,
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
        add_select() {
            this.contents.push({
                type: "select",
                name: "",
                label: "",
                options: [],
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
        }
    };
}
