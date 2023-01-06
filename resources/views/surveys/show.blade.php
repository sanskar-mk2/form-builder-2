<x-base-layout>
    <section class="flex flex-col gap-4" x-data="answer_data(@js($survey->contents))" class="w-full">
        <span class="text-xl mt-4 font-extrabold">{{ $survey->name }} (Preview)</span>
        <span class="font-bold text-error">* Required Field</span>
        <x-template-master-answer />
        <form x-on:submit.prevent="prevent=true;" x-data="{prevent:false}" class="form-control pt-4 gap-4">
            @csrf
            <input name="survey_id" type="hidden" value="{{ $survey->id }}">
            <input name="contents" type="hidden" x-bind:value="JSON.stringify(contents)">
            <input type="submit" class="btn w-36 btn-primary" >
            <div x-show="prevent" class="badge badge-warning gap-2">
                <x-heroicon-o-exclamation-circle class="inline-block w-4 h-4 stroke-current"/>
                This is a preview. You cannot submit!
            </div>
            <p></p>
        </form>
    </section>
</x-base-layout>
