<x-base-layout>
    <section x-data="handler" class="w-full">
        <div class="flex flex-col gap-4 w-full my-4">
            <template x-for="(content, index) in contents" :key="index">
                <div class="card w-full bg-base-100 shadow-xl">
                    <div class="card-body">
                        <div class="card-actions items-center justify-between">
                            <p class="font-bold" x-text="content.type.toUpperCase()"></p>
                            <x-remove x-on:click="remove(index)" />
                        </div>
                        <template x-if="content.type=='text' || content.type=='description'">
                            <div class="flex flex-col gap-4">
                                <input placeholder="name" x-model="content.name" type="text" class="input input-bordered w-full max-w-xs" >
                                <input placeholder="label" x-model="content.label" type="text" class="input input-bordered w-full max-w-xs" >
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>
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
                <li>
                    <a x-on:click="add_description">Description</a>
                </li>
                <li><a>Select</a></li>
                <li><a>Checkbox</a></li>
                <li><a>Radio</a></li>
            </ul>
        </div>
    </section>
</x-base-layout>