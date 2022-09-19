<x-base-layout>
    <section x-data="handler(@js($survey->contents))" class="w-full">
        <form x-on:submit.prevent="()=>{const ret=validate(); if (! ret) $event.target.submit();}" class="form-control pt-4 gap-4" method="POST" action="{{ route('surveys.update', $survey->id) }}">
            @csrf
            @method('PATCH')
            <input placeholder="Survey Name" value="{{ $survey->name }}" name="name" type="text" class="input input-bordered w-full max-w-xs" >
            <input x-bind:value="JSON.stringify(contents)" name="contents" type="hidden" >
            <input type="submit" class="btn w-36 btn-primary" >
        </form>
        <div class="flex flex-col gap-4 w-full my-4">
            <x-template-master />
        </div>
        <x-add-input />
    </section>
</x-base-layout>