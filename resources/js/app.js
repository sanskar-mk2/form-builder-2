import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;

import handler from "./surveys-create";
window.handler = handler;

import answer_data from "./answers-create";
window.answer_data = answer_data;

Alpine.start();

import { themeChange } from "theme-change";
themeChange();
