import Chart from "chart.js/auto";
import _ from "lodash";

const make_chart = (canvas_id, data) => {
    const count = _.countBy(data.answers);
    const ctx = document.getElementById(canvas_id).getContext("2d");
    const chart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: Object.keys(count).map(
                (value) =>
                    data.content.options.find((op) => op.value === value).option
            ),
            datasets: [
                {
                    label: data.content.label,
                    data: Object.values(count),
                    backgroundColor: ["rgb(54, 162, 235)", "rgb(255, 99, 132)"],
                    hoverOffset: 4,
                },
            ],
        },
    });
    return chart;
};

const alpine_pie = {
    make(id, content, answers) {
        const data = { content, answers };
        console.log(data);
        make_chart(id, data);
    },
};

export { make_chart, alpine_pie };
