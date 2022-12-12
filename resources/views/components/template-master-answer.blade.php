<template x-for="(item, index) in survey" :key="index">
    <div>
        <x-if-text-template-answer />
        <x-if-select-template-answer />
        <template x-if="item.type=='description'">
            <div class="form-control">
                <label :for="item.name" class="label justify-start gap-1">
                    <span x-text="item.label" class="label-text"></span>
                    <span class="font-bold text-error" x-show="item.required">*</span>
                </label> 
                <textarea :disabled="disabled" :readonly="readonly" x-model="contents[item.name]" :id="item.name" :name="item.name" class="textarea textarea-bordered h-24" placeholder="Write here..."></textarea>
            </div>
        </template>
        <x-if-checkbox-answer />
        <x-if-radio-answer />
        <x-if-likert-answer />
        <x-if-likert-grid-answer />
        <x-if-date-answer />
        <x-if-radio-grid-answer />
        <x-if-drag-and-drop-ranking-answer />
        <x-if-date-picker-answer />
        <x-if-checkbox-grid-answer />
        <x-if-slider-answer />
        <x-if-textbox_list-answer />
        <x-if-continuous-sum-answer />
        <x-if-image-multiselect-answer />
        <x-if-image-singleselect-answer />
        <hr class="mt-4">
    </div>
</template>
