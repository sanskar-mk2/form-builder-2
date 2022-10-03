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
        <hr class="mt-4">
    </div>
</template>
