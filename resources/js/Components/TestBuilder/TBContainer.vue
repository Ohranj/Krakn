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
        onDragOver({dataTransfer, target, ...rest}) {
            const data = dataTransfer.types[0];
            target.classList.remove('bg-slate-100')
            data == 'completed' 
                ? target.classList.add('bg-orange-300')
                : target.classList.add('bg-yellow-300')
        },
        onDragLeave({target, ...rest}) {
            target.classList.remove('bg-orange-300')
            target.classList.remove('bg-yellow-300')
            target.classList.add('bg-slate-100')
        },
        handleDrop({dataTransfer, ...rest}) {
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
            <DragButton :action="stepBuilderActions['visit']">
                <template v-slot:icon>
                    <Url class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
            <DragButton :action="stepBuilderActions['query']">
                <template v-slot:icon>
                    <Search class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
            <DragButton :action="stepBuilderActions['click']">
                <template v-slot:icon>
                    <Click class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
            <DragButton :action="stepBuilderActions['input']">
                <template v-slot:icon>
                    <Pen class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
            <DragButton :action="stepBuilderActions['sleep']">
                <template v-slot:icon>
                    <Pause class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
            <DragButton :action="stepBuilderActions['screensaver']">
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
                                <small class="text-red-500 absolute left-2 top-2 font-semibold">** Step requires completion **</small>
                                <small>...</small>
                            </template>
                        </ul>
                    </template>
                </Step>
            </template>
            <div>
                <div class="flex items-center gap-x-2">
                    <button class="w-[205px] cursor-pointer border border-dashed border-black rounded-md p-2 shadow shadow-black bg-slate-100 font-semibold" @dragover.prevent="onDragOver($event)" @dragleave.stop="onDragLeave($event)" @drop.prevent="handleDrop($event);onDragLeave($event)">Drop Step Here</button>
                </div>
            </div>
        </div>
    </div>
</template>