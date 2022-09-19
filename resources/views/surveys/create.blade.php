<x-base-layout>
    <section x-data="handler" class="w-full">
        <form x-on:submit.prevent="()=>{const ret=validate(); if (! ret) $event.target.submit();}" class="form-control pt-4 gap-4" method="POST" action="{{ route('surveys.store') }}">
            @csrf
            <input placeholder="Survey Name" name="name" type="text" class="input input-bordered w-full max-w-xs" >
            <input x-bind:value="JSON.stringify(contents)" name="contents" type="hidden" class="input input-bordered w-full max-w-xs" >
            <input type="submit" class="btn w-36 btn-primary" >
        </form>
        <div class="flex flex-col gap-4 w-full my-4">
            <x-template-master />
        </div>
        <x-add-input />
    </section>
</x-base-layout>
