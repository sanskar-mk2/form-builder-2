<x-base-layout>
    <section class="flex flex-col gap-4" x-data="answer_data(@js($survey->contents))" class="w-full">
        <span class="text-xl mt-4 font-extrabold">{{ $survey->name }}</span>
        <span class="font-bold text-error">* Required Field</span>
        <form x-on:submit.prevent="()=>{const ret=validate_required(); if (! ret) $event.target.submit();}"
            class="form-control pt-4 gap-4" method="POST" action="{{ route('answers.store') }}">
            @csrf
            <input name="survey_id" type="hidden" value="{{ $survey->id }}">
            <input name="contents" type="hidden" x-bind:value="JSON.stringify(contents)">
            <input type="submit" class="btn w-36 btn-primary" >
        </form>
        <x-template-master-answer />
    </section>
</x-base-layout>
