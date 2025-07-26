<script>
import DragButton from './DragButton.vue';
import Url from '../svg/Url.vue';
import Click from '../svg/Click.vue';
import Pause from '../svg/Pause.vue';
import Camera from '../svg/Camera.vue';
import Search from '../svg/Search.vue';
import Pen from '../svg/Pen.vue'
import Step from './Step.vue';

export default {
    props: {
        stepBuilderActions: Object
    },
    components: {
        DragButton, Url, Click, Pause, Camera, Search, Pen, Step
    },
    data() {
        return {
            isDragging: false,
            tooltip: {
                show: false,
                index: 0,
            },
            builder: [
                {
                    ...this.stepBuilderActions['visit'],
                }
            ],
        }
    },
    methods: {
        toggleIsDraggingState() {
            this.isDragging = !this.isDragging
        },
        onDragOver({dataTransfer, target, ...rest}) {
            const data = dataTransfer.types[0];
            target.classList.remove('bg-slate-100')
            target.classList.add('scale-y-[1.3]')
            target.classList.add('scale-x-[1.05]')
            data == 'completed' 
                ? target.classList.add('bg-indigo-300')
                : target.classList.add('bg-yellow-300')
        },
        onDragLeave({target, ...rest}) {
            target.classList.remove('scale-y-[1.3]')
            target.classList.remove('scale-x-[1.05]')
            target.classList.remove('bg-indigo-300')
            target.classList.remove('bg-yellow-300')
            target.classList.add('bg-slate-100')
        },
        handleDropNew({dataTransfer, ...rest}) {
            const data = dataTransfer.getData(dataTransfer.types[0]);
            const step = JSON.parse(data)
            this.builder.push(step)
        },
        onStepMouseover(index) {
            this.tooltip.index = index;
            this.tooltip.show = true;
        },
        onStepMouseout() {
            this.tooltip.show = false;
        }
    },
}
</script>

<template>
    <div class="border bg-slate-800 min-h-[450px] sm:min-h-[300px] rounded-md mt-2 p-8 shadow shadow-black">
        <div class="flex items-center justify-center lg:justify-start flex-wrap gap-5 mx-auto">
            <DragButton :action="stepBuilderActions['visit']" @isDraggingState="toggleIsDraggingState">
                <template v-slot:icon>
                    <Url class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
            <DragButton :action="stepBuilderActions['query']" @isDraggingState="toggleIsDraggingState">
                <template v-slot:icon>
                    <Search class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
            <DragButton :action="stepBuilderActions['click']" @isDraggingState="toggleIsDraggingState">
                <template v-slot:icon>
                    <Click class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
            <DragButton :action="stepBuilderActions['input']" @isDraggingState="toggleIsDraggingState">
                <template v-slot:icon>
                    <Pen class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
            <DragButton :action="stepBuilderActions['sleep']" @isDraggingState="toggleIsDraggingState">
                <template v-slot:icon>
                    <Pause class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
            <DragButton :action="stepBuilderActions['screenshot']" @isDraggingState="toggleIsDraggingState">
                <template v-slot:icon>
                    <Camera class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
        </div>
        <hr class="mt-[50px] border-dashed text-white">
        <div class="mt-[50px] flex justify-center items-end lg:justify-start flex-wrap gap-x-2 gap-y-12 mx-auto">
            <template v-for="(x, index) in builder">
                <Step :step="x" :index="index" @showTooltip="onStepMouseover" @hideTooltip="onStepMouseout" :tooltip="tooltip">
                    <template v-slot:tooltip>
                        <ul class="mt-2">
                            <li><span class="font-semibold">Type: </span><span v-text="builder[tooltip.index]?.human_type"></span></li>
                            <li><span class="font-semibold">Value: </span><span v-text="builder[tooltip.index]?.value"></span></li>
                            <li v-if="builder[tooltip.index].hasOwnProperty('input_type')"><span class="font-semibold">Input: </span><span v-text="builder[tooltip.index]?.human_input_type"></span></li>
                            <template v-if="!builder[tooltip.index]?.complete">
                                <small class="text-red-500 absolute left-2 top-2 font-semibold">** Step requires configuring **</small>
                                <small>...</small>
                            </template>
                        </ul>
                    </template>
                </Step>
            </template>
            <div>
                <div class="flex items-end gap-x-2">
                    <button class="w-[205px] border border-dashed border-black rounded-md p-2 shadow shadow-black bg-slate-100 font-semibold" @dragover.prevent="onDragOver($event)" @dragleave.stop="onDragLeave($event)" @drop.prevent="handleDropNew($event);onDragLeave($event)">Append Step</button>
                </div>
            </div>
        </div>
    </div>
</template>