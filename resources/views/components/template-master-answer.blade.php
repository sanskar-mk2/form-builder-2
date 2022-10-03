<template x-for="(item, index) in survey" :key="index">
    <div>
        <x-if-text-template-answer />
        <template x-if="item.type=='select'">
            <div class="form-control w-full max-w-xs">
                <label :for="item.name" class="label justify-start gap-1">
                    <span x-text="item.label" class="label-text"></span>
                    <span class="font-bold text-error" x-show="item.required">*</span>
                </label>
                <select :disabled="disabled" x-show="!readonly" x-model="contents[item.name]" :name="item.name" :id="item.name" class="select select-bordered">
                    <option disabled selected value="">Pick one</option>
                    <template x-for="(option, op_index) in item.options" :key="op_index">
                        <option :value="option.value" x-text="option.option"></option>
                    </template>
                </select>
                <input x-show="readonly" readonly type="text" :value="readonly ? item.options.find(e => e.value === contents[item.name]).option : ''" class="input input-bordered w-full max-w-xs" />
            </div>
        </template>
        <template x-if="item.type=='description'">
            <div class="form-control">
                <label :for="item.name" class="label justify-start gap-1">
                    <span x-text="item.label" class="label-text"></span>
                    <span class="font-bold text-error" x-show="item.required">*</span>
                </label> 
                <textarea :disabled="disabled" :readonly="readonly" x-model="contents[item.name]" :id="item.name" :name="item.name" class="textarea textarea-bordered h-24" placeholder="Write here..."></textarea>
            </div>
        </template>
        <template x-if="item.type=='checkbox'">
            <div class="form-control">
                <label :for="item.name" class="label justify-start gap-1">
                    <span x-text="item.label" class="label-text"></span>
                    <span class="font-bold text-error" x-show="item.required">*</span>
                </label>
                <div class="flex gap-8">
                    <template x-for="(option, op_index) in item.options" :key="op_index">
                        <label class="label cursor-pointer w-fit">
                            <input :disabled="disabled||readonly" type="checkbox" x-model="contents[item.name]"
                                :value="option.value" class="disabled:opacity-100 checkbox checkbox-primary" />
                            <span class="ml-1 label-text" x-text="option.option"></span> 
                        </label>
                    </template>
                </div>
            </div>
        </template>
        <template x-if="item.type=='radio'">
            <div class="form-control">
                <label :for="item.name" class="label justify-start gap-1">
                    <span x-text="item.label" class="label-text"></span>
                    <span class="font-bold text-error" x-show="item.required">*</span>
                </label>
                <div>
                    <template x-for="(option, op_index) in item.options" :key="op_index">
                        <label class="label w-fit cursor-pointer">
                            <input :name="item.name" :disabled="disabled||readonly" type="radio"
                                :value="option.value" x-model="contents[item.name]"
                                class="radio disabled:opacity-100 checked:bg-primary" />
                            <span class="label-text ml-2" x-text="option.option"></span> 
                        </label>
                    </template>
                </div>
            </div>
        </template>
        <template x-if="item.type=='likert'">
            <div class="form-control">
                <label :for="item.name" class="label justify-start gap-1">
                    <span x-text="item.label" class="label-text"></span>
                    <span class="font-bold text-error" x-show="item.required">*</span>
                </label>
                <div class="flex gap-8">
                    <template x-for="(option, op_index) in item.options" :key="op_index">
                        <label class="label w-fit cursor-pointer">
                            <input :name="item.name" :disabled="disabled||readonly" type="radio"
                                :value="option.value" x-model="contents[item.name]"
                                class="radio disabled:opacity-100 checked:bg-primary" />
                            <span class="label-text ml-2" x-text="option.option"></span> 
                        </label>
                    </template>
                </div>
            </div>
        </template>
        <template x-if="item.type=='likert_grid'">
            <div class="form-control">
                <label :for="item.name" class="label justify-start gap-1">
                    <span x-text="item.label" class="label-text"></span>
                    <span class="font-bold text-error" x-show="item.required">*</span>
                </label>
                <table>
                    <template x-for="(question, q_index) in item.questions" :key="`${index}.${q_index}`">
                        <tr>
                            <td>
                                <label class="label w-fit cursor-pointer">
                                    <span class="label-text ml-2" x-text="question.label"></span> 
                                </label> 
                            </td>
                            <td>
                                <div class="flex gap-8">
                                    <template x-for="(option, op_index) in item.options" :key="`${index}.${q_index}.${op_index}`">
                                        <label class="label w-fit cursor-pointer">
                                            <input :name="item.name+question.name" :disabled="disabled||readonly" type="radio"
                                                :value="option.value" x-model="contents[item.name][question.name]"
                                                class="radio disabled:opacity-100 checked:bg-primary" />
                                            <span class="label-text ml-2" x-text="option.option"></span> 
                                        </label>
                                    </template>
                                </div>
                            </td>
                        </tr>
                    </template>
                </table>
            </div>
        </template>
        <hr class="mt-4">
    </div>
</template>
