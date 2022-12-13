<div class="flex flex-col gap-4">
    <x-part-label />
    <table class="table">
        <x-part-option-thead />
        <x-part-option-tbody />
    </table>
    <button x-on:click="add_option(index)"
        class="btn btn-primary w-32">
        Add Option
    </button>
</div>
