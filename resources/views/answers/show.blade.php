<x-base-layout>
    <section class="flex flex-col gap-4" x-init="make_readonly" x-data="answer_data(@js($answer->survey->contents), @js($answer->contents))" class="w-full">
        <span class="text-xl mt-4 font-extrabold">{{ $answer->survey->name }}</span>
        <span class="text-xl font-bold">Showing Answer | ID: {{ $answer->id }}</span>
        <span class="font-bold text-error">* Required Field</span>
        <x-template-master-answer />
    </section>
</x-base-layout>
