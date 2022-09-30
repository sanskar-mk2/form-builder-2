<x-base-layout>
    <section x-data="{}" class="w-full">
        {{ $survey->name }}
        <form class="form-control pt-4 gap-4" method="POST" action="{{ route('answers.store') }}">
            @csrf
            <input name="survey_id" type="hidden" value="{{ $survey->id }}">
            <input name="contents" type="hidden" value="">
            <input type="submit" class="btn w-36 btn-primary" >
        </form>
    </section>
</x-base-layout>
