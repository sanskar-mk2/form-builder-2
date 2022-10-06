<template x-for="(content, index) in contents" :key="index">
    <div class="flex flex-col gap-4">
        <div
            class="card w-full bg-base-100 shadow-xl">
            <div x-on:dragstart.self="dragstart(index, $event.target);$event.dataTransfer.effectAllowed='move';"
                draggable="true"
                dropzone="move"
                x-on:dragenter="dragenter(index, $event.target)"
                x-on:dragleave="dragleave(index, $event.target)"
                x-on:dragover="dragover(index, $event.target)"
                x-on:dragend.prevent="dragend($event)"
                x-show="dragged !== index"
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
                <template x-if="content.type=='likert'">
                    <x-template-likert />
                </template>
                <template x-if="content.type=='likert_grid'">
                    <x-template-likert-grid />
                </template>
                <template x-if="content.type=='date'">
                    <x-template-date />
                </template>
                <template x-if="content.type=='radio_grid'">
                    <x-template-radio-grid />
                </template>
                <x-checkbox x-model="content.required" label="Required" />
            </div>
        </div>
    </div>
</template>
