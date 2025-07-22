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
                    type: 'visit',
                    human_type: 'Visit URL',
                    value: 'https://example.com'
                }
            ]
        }
    },
    methods: {
        onDragOver(elem) {
            elem.classList.remove('bg-slate-100')
            elem.classList.add('bg-yellow-300')
        },
        onDragLeave(elem) {
            elem.classList.remove('bg-yellow-300')
            elem.classList.add('bg-slate-100')
        },
        handleDrop(e) {
            const data = e.dataTransfer.getData("text");
            const step = {
                type: this.stepBuilderActions[data].type,
                human_type: this.stepBuilderActions[data].human_type,
                value: null
            }
            this.builder.push(step)
        }
    },
}
</script>

<template>
    <div class="border bg-slate-800 min-h-[450px] sm:min-h-[300px] rounded-md mt-2 p-8 shadow shadow-black">
        <div class="flex items-center justify-center lg:justify-start flex-wrap gap-5 mx-auto">
            <DragButton human_type="Visit URL" type="visit">
                <template v-slot:icon>
                    <Url class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
            <DragButton human_type="Query DOM Element" type="query">
                <template v-slot:icon>
                    <Search class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
            <DragButton human_type="Click DOM Element" type="click">
                <template v-slot:icon>
                    <Click class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
            <DragButton human_type="Action DOM Input" type="input">
                <template v-slot:icon>
                    <Pen class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
            <DragButton human_type="Sleep" type="sleep">
                <template v-slot:icon>
                    <Pause class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
            <DragButton human_type="Screenshot" type="screensaver">
                <template v-slot:icon>
                    <Camera class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </DragButton>
        </div>
        <hr class="mt-[50px] border-dashed text-white">
        <div class="mt-[50px] flex justify-center items-end lg:justify-start flex-wrap gap-x-2 gap-y-12 mx-auto">
            <template v-for="(x, index) in builder">
                <Step :step="x" :index="index" :tooltip="tooltip">
                    <template v-slot:tooltip>
                        <ul class="mt-2">
                            <li><span class="font-semibold">Type: </span><span v-text="builder[tooltip.index]?.human_type"></span></li>
                            <template v-if="builder[tooltip.index]?.value">
                                <li><span class="font-semibold">Value: </span><span v-text="builder[tooltip.index]?.value"></span></li>
                            </template>
                            <template v-else>
                                <small class="text-red-500 absolute left-2 top-2 font-semibold">** Step requires completion **</small>
                                <small>...</small>
                            </template>
                        </ul>
                    </template>
                </Step>
            </template>
            <div>
                <div class="flex items-center gap-x-2">
                    <button class="w-[205px] cursor-pointer border border-dashed border-black rounded-md p-2 shadow shadow-black bg-slate-100 font-semibold" @dragover.prevent="onDragOver($event.target)" @dragleave.stop="onDragLeave($event.target)" @drop.prevent="handleDrop($event);onDragLeave($event.target)">Drop Step Here</button>
                </div>
            </div>
        </div>
    </div>
</template>