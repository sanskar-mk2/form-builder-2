<div class="flex flex-col gap-4">
    <input placeholder="name" x-model="content.name" type="text" class="input input-bordered w-full max-w-xs" >
    <input placeholder="label" x-model="content.label" type="text" class="input input-bordered w-full max-w-xs" >
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>Value</th>
                <th>Label</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <template x-for="(option, op_index) in content.options" :key="`${index}.${op_index}`">
                <tr>
                    <td x-text="op_index+1">
                        {{-- Index --}}
                    </td>
                    <td>
                        <input placeholder="value" x-model="option.value" type="text" class="input input-bordered w-full max-w-xs" >
                    </td>
                    <td>
                        <input placeholder="option" x-model="option.option" type="text" class="input input-bordered w-full max-w-xs" >
                    </td>
                    <td>
                        <x-remove x-on:click="remove_option(index, op_index)" />
                    </td>
                </tr>
            </template>
        </tbody>
    </table>
    <button x-on:click="add_option(index)"
        class="btn btn-primary w-32">
        Add Option
    </button>
</div>