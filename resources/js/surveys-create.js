export default function handler() {
    return {
        add_dd: false,
        contents: [],
        add_text() {
            this.contents.push({
                type: 'text' 
            })
        },
        remove(index) {
            this.contents.splice(index, 1);
        },
    };
}
