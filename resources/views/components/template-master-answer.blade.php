<template x-for="(item, index) in survey" :key="index">
    <div>
        <x-if-text-template-answer />
        <template x-if="item.type=='select'">
            <div class="form-control w-full max-w-xs">
                <label :for="item.name" class="label justify-start gap-1">
                    <span x-text="item.label" class="label-text"></span>
                    <span class="font-bold text-error" x-show="item.required">*</span>
                </label>
                <select x-model="contents[item.name]" :name="item.name" :id="item.name" class="select select-bordered">
                    <option disabled selected value="">Pick one</option>
                    <template x-for="(option, op_index) in item.options" :key="op_index">
                        <option :value="option.value" x-text="option.option"></option>
                    </template>
                </select>
            </div>
        </template>
        <template x-if="item.type=='description'">
            <div class="form-control">
                <label :for="item.name" class="label justify-start gap-1">
                    <span x-text="item.label" class="label-text"></span>
                    <span class="font-bold text-error" x-show="item.required">*</span>
                </label> 
                <textarea x-model="contents[item.name]" :id="item.name" :name="item.name" class="textarea textarea-bordered h-24" placeholder="Write here..."></textarea>
            </div>
        </template>
        <hr class="mt-4">
    </div>
</template>
