<x-base-layout>
    <section x-data="handler">
        <template x-for="(contents, index) in contents" :key="index">

        </template>
        <div class="dropdown">
            <label x-on:click="add_dd=true"
                tabindex="0" class="btn m-1 w-24">
                Add
            </label>
            <ul x-show="add_dd"
                x-on:click.outside="add_dd=false"
                tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                <li>
                    <a x-on:click="add_text">Text</a>
                </li>
                <li><a>Description</a></li>
                <li><a>Select</a></li>
                <li><a>Checkbox</a></li>
                <li><a>Radio</a></li>
            </ul>
        </div>
    </section>
</x-base-layout>