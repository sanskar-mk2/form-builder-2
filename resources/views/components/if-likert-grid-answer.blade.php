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
