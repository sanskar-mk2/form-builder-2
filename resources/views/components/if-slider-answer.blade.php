<template x-if="item.type=='slider'">
    <div class="form-control w-full max-w-xs">
        <label :for="item.name" class="label justify-start gap-1">
            <span x-text="item.label" class="label-text"></span>
            <span class="font-bold text-error" x-show="item.required">*</span>
        </label>
        <input :min="item.min" :max="item.max" :step="item.step" :disabled="readonly||disabled" x-model="contents[item.name]" type="range" :name="item.name" :id="item.name"
            class="input input-bordered w-full max-w-xs" />
        <div class="w-full flex justify-between text-xs px-2">
            <span x-text="item.label_min"></span>
            <span x-text="item.label_mid"></span>
            <span x-text="item.label_max"></span>
        </div>
    </div>
</template>
