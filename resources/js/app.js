import "./bootstrap";
import Alpine from "alpinejs";

window.Alpine = Alpine;

import handler from "./surveys-create";
window.handler = handler;

Alpine.start();

import { themeChange } from "theme-change";
themeChange();
