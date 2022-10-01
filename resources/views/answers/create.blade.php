<x-base-layout>
    <section class="flex flex-col gap-4" x-data="answer_data(@js($survey->contents))" x-init="survey.forEach(e => console.log(e.type))" class="w-full">
        <span class="text-xl mt-4 font-extrabold">{{ $survey->name }}</span>
        <span class="font-bold text-error">* Required Field</span>
        <form class="form-control pt-4 gap-4" method="POST" action="{{ route('answers.store') }}">
            @csrf
            <input name="survey_id" type="hidden" value="{{ $survey->id }}">
            <input name="contents" type="hidden" x-bind:value="contents">
            <input type="submit" class="btn w-36 btn-primary" >
        </form>
        <template x-for="(item, index) in survey" :key="index">
            <div>
                <x-if-text-template-answer />
                <template x-if="item.type=='select'">
                    <div class="form-control w-full max-w-xs">
                        <label :for="item.name" class="label justify-start gap-1">
                            <span x-text="item.label" class="label-text"></span>
                            <span class="font-bold text-error" x-show="item.required">*</span>
                        </label>
                        <select :name="item.name" :id="item.name" class="select select-bordered">
                            <option disabled selected>Pick one</option>
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
                        <textarea :id="item.name" :name="item.name" class="textarea textarea-bordered h-24" placeholder="Write here..."></textarea>
                    </div>
                </template>
                <hr class="mt-4">
            </div>
        </template>
    </section>
</x-base-layout>
