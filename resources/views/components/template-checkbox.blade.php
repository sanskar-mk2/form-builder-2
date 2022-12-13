<div class="flex flex-col gap-4">
    <label>
        <span class="label-text">Label</span>
        <input placeholder="label" x-on:keyup="set_names" x-model="content.label" type="text" class="input input-bordered w-full max-w-xs ml-2" >
    </label>
    <table class="table">
        <x-part-option-thead />
        <x-part-option-tbody />
    </table>
    <button x-on:click="add_option(index)"
        class="btn btn-primary w-32">
        Add Option
    </button>
</div>
