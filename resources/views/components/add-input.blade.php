<div x-bind:class="add_dd ? 'pb-96' : 'pb-32'" class="dropdown">
    <label x-on:click="add_dd=true"
        tabindex="0" class="btn m-1 w-24">
        Add
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
            <a x-on:click="add_date;add_dd=false;">Date</a>
        </li>
    </ul>
</div>
