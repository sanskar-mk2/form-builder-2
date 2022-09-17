<x-base-layout>
    <section x-data="handler(@js($survey->contents))" class="w-full">
        <form class="form-control pt-4 gap-4" method="POST" action="{{ route('surveys.update', $survey->id) }}">
            @csrf
            @method('PATCH')
            <input placeholder="Survey Name" value="{{ $survey->name }}" name="name" type="text" class="input input-bordered w-full max-w-xs" >
            <input x-bind:value="JSON.stringify(contents)" name="contents" type="hidden" class="input input-bordered w-full max-w-xs" >
            <input type="submit" class="btn w-36 btn-primary" >
        </form>
        <div class="flex flex-col gap-4 w-full my-4">
            <template x-for="(content, index) in contents" :key="index">
                <div class="flex flex-col gap-4">
                    <div x-on:dragstart.self="dragging=true;event.dataTransfer.effectAllowed='move';event.dataTransfer.setData('text/plain', index);"
                        x-on:dragend="dragging=false;"
                        draggable="true" class="card w-full bg-base-100 shadow-xl">
                        <div class="px-4 py-2 bg-base-300 card-actions items-center justify-between">
                            <h3 class="font-extrabold text-2xl text-secondary" x-text="content.type.toUpperCase()"></h3>
                            <x-remove x-on:click="remove(index)" />
                        </div>
                        <div class="card-body">
                            <template x-if="content.type=='text' || content.type=='description'">
                                <x-template-text />
                            </template>
                            <template x-if="content.type=='select'">
                                <x-template-select />
                            </template>
                        </div>
                    </div>
                    <div x-data="{over_me: false}"
                        x-on:drop="console.log('dropped')"
                        x-on:dragover.prevent="over_me=true"
                        x-on:dragleave.prevent="over_me=false"
                        x-on:drop.prevent="reorder(parseInt($event.dataTransfer.getData('text/plain')), index)"
                        x-bind:class="over_me ? 'bg-neutral' : 'bg-primary'"
                        x-show="dragging" 
                        class="h-4 rounded-full w-full">
                        {{-- None --}}
                    </div>
                </div>
            </template>
        </div>
        <div x-bind:class="add_dd ? 'pb-96' : 'pb-32'" class="dropdown">
            <label x-on:click="add_dd=true"
                tabindex="0" class="btn m-1 w-24">
                Add
            </label>
            <ul x-show="add_dd"
                x-on:click.outside="add_dd=false"
                tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                <li>
                    <a x-on:click="add_text; add_dd=false">Text</a>
                </li>
                <li>
                    <a x-on:click="add_description; add_dd=false">Description</a>
                </li>
                <li>
                    <a x-on:click="add_select; add_dd=false">Select</a>
                </li>
                <li><a>Checkbox</a></li>
                <li><a>Radio</a></li>
            </ul>
        </div>
    </section>
</x-base-layout>
