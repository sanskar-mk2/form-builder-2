<template x-for="(content, index) in contents" :key="index">
    <div class="flex flex-col gap-4">
        <div x-data="{local_drag: false}"
            x-on:dragend="dragging=false;"
            class="card w-full bg-base-100 shadow-xl">
            <div x-on:dragstart.self="dragging=true;event.dataTransfer.setData('text/plain', index);"
                draggable="true"
                class="px-4 py-2 hover:cursor-move bg-base-300 card-actions items-center justify-between">
                <h3 class="font-extrabold text-2xl text-secondary" x-text="`${index+1}. ${content.type.toUpperCase()}`"></h3>
                <x-remove x-on:click="remove(index)" />
            </div>
            <div x-show="!dragging" class="card-body">
                <input placeholder="name" readonly x-model="content.name" type="text" class="input input-bordered w-full max-w-xs" >
                <template x-if="content.type=='text' || content.type=='description'">
                    <x-template-text />
                </template>
                <template x-if="content.type=='select'">
                    <x-template-select />
                </template>
                <template x-if="content.type=='checkbox'">
                    <x-template-checkbox />
                </template>
                <template x-if="content.type=='radio'">
                    <x-template-radio />
                </template>
                <x-checkbox x-model="content.required" label="Required" />
            </div>
        </div>
        <div x-data="{over_me: false}"
            x-on:dragend.window="over_me=false;"
            x-on:dragover.prevent="over_me=true"
            x-on:dragleave.prevent="over_me=false"
            x-on:drop.prevent="reorder(parseInt($event.dataTransfer.getData('text/plain')), index)"
            x-bind:class="over_me ? 'bg-primary' : 'bg-neutral'"
            x-show="dragging" 
            class="h-8 rounded-full w-full">
            {{-- None --}}
        </div>
    </div>
</template>
