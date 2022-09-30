<template x-for="(content, index) in contents" :key="index">
    <div class="flex flex-col gap-4">
        <div x-on:dragstart.self="dragging=true;event.dataTransfer.effectAllowed='move';event.dataTransfer.setData('text/plain', index);"
            x-on:dragend="dragging=false;"
            draggable="true" class="card w-full bg-base-100 shadow-xl">
            <div class="px-4 py-2 bg-base-300 card-actions items-center justify-between">
                <h3 class="font-extrabold text-2xl text-secondary" x-text="`${index+1}. ${content.type.toUpperCase()}`"></h3>
                <x-remove x-on:click="remove(index)" />
            </div>
            <div class="card-body">
                <input placeholder="name" readonly x-model="content.name" type="text" class="input input-bordered w-full max-w-xs" >
                <template x-if="content.type=='text' || content.type=='description'">
                    <x-template-text />
                </template>
                <template x-if="content.type=='select'">
                    <x-template-select />
                </template>
                <x-checkbox x-model="content.required" label="Required" />
            </div>
        </div>
        <div x-data="{over_me: false}"
            x-on:drop="console.log('dropped')"
            x-on:dragover.prevent="over_me=true"
            x-on:dragleave.prevent="over_me=false"
            x-on:drop.prevent="reorder(parseInt($event.dataTransfer.getData('text/plain')), index)"
            x-bind:class="over_me ? 'bg-neutral' : 'bg-primary'"
            x-show="dragging" 
            class="h-4 rounded-full w-full">
            {{-- None --}}
        </div>
    </div>
</template>
