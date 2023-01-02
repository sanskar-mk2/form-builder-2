import validate from "./surveys-create-validate.js";
import {
    add_text,
    add_checkbox,
    add_description,
    add_radio,
    add_drag_and_drop_ranking,
    add_likert,
    add_likert_grid,
    add_slider_list,
} from "./add_type";

export default function handler(initial_content = []) {
    return {
        dragged: null,
        add_dd: false,
        dragging: false,
        fake: null,
        over: null,
        error: "",
        contents: initial_content,
        add_drag_and_drop_ranking() {
            this.contents.push(_.cloneDeep(add_drag_and_drop_ranking));
        },
        add_text() {
            this.contents.push(_.cloneDeep(add_text));
        },
        add_checkbox() {
            this.contents.push(_.cloneDeep(add_checkbox));
        },
        add_description() {
            this.contents.push(_.cloneDeep(add_description));
        },
        add_radio() {
            this.contents.push(_.cloneDeep(add_radio));
        },
        add_likert() {
            this.contents.push(_.cloneDeep(add_likert));
        },
        add_likert_grid() {
            this.contents.push(_.cloneDeep(add_likert_grid));
        },
        add_radio_grid() {
            this.contents.push({
                type: "radio_grid",
                name: "",
                label: "",
                questions: [],
                options: [],
                required: false,
            });
        },
        add_checkbox_grid() {
            this.contents.push({
                type: "checkbox_grid",
                name: "",
                label: "",
                questions: [],
                options: [],
                required: false,
            });
        },
        add_slider() {
            this.contents.push({
                type: "slider",
                name: "",
                label: "",
                min: 0,
                max: 10,
                step: 1,
                default: 5,
                label_min: "",
                label_max: "",
                label_mid: "",
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
        add_date_picker() {
            this.contents.push({
                type: "date_picker",
                name: "",
                label: "",
                min: "",
                max: "",
                required: false,
            });
        },
        add_textbox_list() {
            this.contents.push({
                type: "textbox_list",
                name: "",
                label: "",
                questions: [],
                required: false,
            });
        },
        add_continuous_sum() {
            this.contents.push({
                type: "continuous_sum",
                name: "",
                label: "",
                questions: [],
                required: false,
            });
        },
        add_image_multiselect() {
            this.contents.push({
                type: "image_multiselect",
                name: "",
                label: "",
                options: [],
                required: false,
            });
        },
        add_image_singleselect() {
            this.contents.push({
                type: "image_singleselect",
                name: "",
                label: "",
                options: [],
                required: false,
            });
        },
        add_slider_list() {
            this.contents.push(_.cloneDeep(add_slider_list));
        },
        add_page_break() {
            this.contents.push({
                type: "page_break",
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
            this.contents.splice(index, 1);
        },
        validate() {
            return validate(this.contents);
        },
        set_names() {
            for (let i = 0; i < this.contents.length; i++) {
                if (this.contents[i].type === "page_break") continue;
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
        dragstart(idx, node) {
            this.dragging = true;
            this.dragged = idx;
            this.fake = node.cloneNode();
            const other_attr = [...this.fake.attributes].filter(
                (attr) => attr.name !== "class" && attr.name !== "dropzone"
            );

            other_attr.forEach((attr) => {
                this.fake.removeAttribute(attr.name);
            });
            this.fake.addEventListener("dragover", (e) => {
                e.preventDefault();
            });
            this.fake.style.height = `${node.offsetHeight}px`;
            this.fake.style.width = `${node.offsetWidth}px`;
            this.fake.style.opacity = "50%";
            this.fake.style.hidden = false;
        },
        dragend(e) {
            if (e.dataTransfer.dropEffect === "move") {
                const dragged = this.contents[this.dragged];
                // const dragged_over = this.contents[this.over];
                this.contents.splice(this.over, 0, dragged);
                this.contents.splice(
                    this.dragged + (this.over < this.dragged ? 1 : 0),
                    1
                );
            }
            this.fake.remove();
            this.dragged = null;
            this.dragging = false;
        },
        dragenter(idx, node) {},
        dragleave(idx, node) {},
        dragover(idx, node) {
            if (node.getAttribute("dropzone") !== "move") {
                return;
            }
            const rect = node.getBoundingClientRect();
            if (rect.top + rect.height / 2 > event.clientY) {
                node.parentNode.parentNode.insertBefore(
                    this.fake,
                    node.parentNode.nextSibling
                );
                this.over = idx + 1;
            } else {
                node.parentNode.parentNode.insertBefore(
                    this.fake,
                    node.parentNode.previousSibling
                );
                this.over = idx;
            }
        },
    };
}
