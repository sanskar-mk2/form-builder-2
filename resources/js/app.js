import "./bootstrap";
import Alpine from "alpinejs";
import { alpine_pie } from "./select-pie-chart";
import dayjs from "dayjs";
import customParseFormat from "dayjs/plugin/customParseFormat";
dayjs.extend(customParseFormat);

window.dayjs = dayjs;
window.Alpine = Alpine;

import handler from "./surveys-create";
window.handler = handler;

import answer_data from "./answers-create";
window.answer_data = answer_data;

document.addEventListener("alpine:init", () => {
    Alpine.data("alpine_pie", () => ({ ...alpine_pie }));
});
window.alpine_pie = alpine_pie;
Alpine.start();

import { themeChange } from "theme-change";
themeChange();
