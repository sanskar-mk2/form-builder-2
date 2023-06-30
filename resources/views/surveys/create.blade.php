<x-base-layout>
    <section x-data="handler({{ old('contents') }})" class="w-full">
      
        <div class="flex flex-col gap-4 w-full my-4" id="main-container">
            <x-template-master />
        </div>
        <x-add-input x-data="{dd_idx: -1}" />
        <x-reorder x-on:click="reorder()" />
        <form x-on:submit.prevent="()=>{error=validate(); if (! error) $event.target.submit();}" class="form-control pt-4 gap-4" method="POST" action="{{ route('surveys.store') }}">
            @csrf
            <label>
                <input placeholder="Survey Name" name="name" type="text" class="input input-bordered w-full max-w-xs mr-2" >
                <span class="label-text">Survey Name</span>
            </label>
            @error('name')<p class="text-error">{{ $message }}</p>@enderror
            <input x-bind:value="JSON.stringify(contents)" name="contents" type="hidden" class="input input-bordered w-full max-w-xs" >
            <input type="submit" class="btn w-36 btn-primary" >
            <p class="text-error" x-text="error ? error : ''"></p>
        </form>
       
    </section>
</x-base-layout>
