<div class="flex items-center">
    <div x-bind:class="add_dd ? 'pb-96' : 'pb-32'" class="dropdown">
        <label x-on:click="add_dd=true"
            tabindex="0" class="btn m-1 w-24">
            Add Text
        </label>
        <ul x-show="add_dd"
            x-on:click.outside="add_dd=false"
            tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
            <li>
                <a x-on:click="add_text; add_dd=false;">Short Answer</a>
            </li>
            <li>
                <a x-on:click="add_description; add_dd=false;">Long Answer</a>
            </li>
            <li>
                <a x-on:click="add_textbox_list;add_dd=false;">Textbox List</a>
            </li>
            <li>
                <a x-on:click="add_continuous_sum;add_dd=false;">Continuous Sum</a>
            </li>
            {{-- Date is not required by client. They need datepicker --}}
            {{-- <li>
                <a x-on:click="add_date;add_dd=false;">Date</a>
            </li> --}}
        </ul>
    </div>

    <div x-bind:class="add_dd ? 'pb-96' : 'pb-32'" class="dropdown">
        <label x-on:click="add_dd=true"
            tabindex="0" class="btn m-1 w-24">
            Add Choice
        </label>
        <ul x-show="add_dd"
            x-on:click.outside="add_dd=false"
            tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
    <li>
                <a x-on:click="add_select; add_dd=false;">Drop Down</a>
            </li>
            <li>
                <a x-on:click="add_checkbox;add_dd=false;">Checkbox</a>
            </li>
            <li>
                <a x-on:click="add_radio;add_dd=false;">Radio</a>
            </li>
            <li>
                <a x-on:click="add_likert;add_dd=false;">Ranking (Likert Scale)</a>
            </li>
            <li>
                <a x-on:click="add_likert_grid;add_dd=false;">Ranking Grid</a>
            </li>
            <li>
                <a x-on:click="add_radio_grid;add_dd=false;">Radio Grid</a>
            </li>
            <li>
                <a x-on:click="add_drag_and_drop_ranking;add_dd=false;">
                    Drag and Drop Ranking
                </a>
            </li>
            <li>
                <a x-on:click="add_date_picker;add_dd=false;">Date Picker</a>
            </li>
            <li>
                <a x-on:click="add_checkbox_grid;add_dd=false;">Checkbox Grid</a>
            </li>
            <li>
                <a x-on:click="add_slider;add_dd=false;">Slider</a>
            </li>
            <li>
                <a x-on:click="add_slider_list;add_dd=false;">Slider List</a>
            </li>
        </ul>
    </div>

    <div x-bind:class="add_dd ? 'pb-96' : 'pb-32'" class="dropdown">
        <label x-on:click="add_dd=true"
            tabindex="0" class="btn m-1 w-24">
            Add Image
        </label>
        <ul x-show="add_dd"
            x-on:click.outside="add_dd=false"
            tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
            <li>
                <a x-on:click="add_image_multiselect;add_dd=false;">Image Multiselect</a>
            </li>
            <li>
                <a x-on:click="add_image_singleselect;add_dd=false;">Image Singleselect</a>
            </li>
        </ul>
    </div>

    <div x-bind:class="add_dd ? 'pb-96' : 'pb-32'" class="dropdown">
        <label x-on:click="add_dd=true"
            tabindex="0" class="btn m-1 w-24">
            Misc.
        </label>
        <ul x-show="add_dd"
            x-on:click.outside="add_dd=false"
            tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
            <li>
                <a x-on:click="add_page_break;add_dd=false;">Page Break</a>
            </li>
        </ul>
    </div>
</div>