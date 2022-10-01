<template x-if="item.type=='text'">
    <div class="form-control w-full max-w-xs">
        <label :for="item.name" class="label justify-start gap-1">
            <span x-text="item.label" class="label-text"></span>
            <span class="font-bold text-error" x-show="item.required">*</span>
        </label>
        <input type="text" :name="item.name" :id="item.name"
            class="input input-bordered w-full max-w-xs" />
    </div>
</template>