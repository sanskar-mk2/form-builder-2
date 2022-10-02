import Chart from "chart.js/auto";
import _ from "lodash";
import uniqolor from "uniqolor";

const make_chart = (canvas_id, data) => {
    const count = _.countBy(data.answers);
    console.log(count);
    const labels = Object.keys(count).map(
        (value) =>
            data.content.options.find((op) => op.value === value)?.option ??
            "Did not answer"
    );
    const ctx = document.getElementById(canvas_id).getContext("2d");
    const chart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: labels,
            datasets: [
                {
                    label: data.content.label,
                    data: Object.values(count),
                    backgroundColor: labels.map((l) => uniqolor(l).color),
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
