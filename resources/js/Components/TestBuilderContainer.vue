<script>
import TestBuilderDragButton from '../Components/TestBuilderDragButton.vue';
import ArrowLong from './svg/ArrowLong.vue';
import Url from './svg/Url.vue';
import Click from './svg/Click.vue';
import Pause from './svg/Pause.vue';
import Camera from './svg/Camera.vue';
import Search from './svg/Search.vue';
import Pen from './svg/Pen.vue'

export default {
    components: {
        TestBuilderDragButton, ArrowLong, Url, Click, Pause, Camera, Search, Pen
    },
    data() {
        return {
            tooltip: {
                show: false,
                index: 0,
            },
            builder: [
                {
                    type: 'Visit',
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
            this.builder.push({
                type: data,
                human_type: 'Visit URL',
                value: null
            })
            console.log('Need an easy way of linking a human name to the type')
        }
    },
    mounted() {
        console.log(2)
    }
}
</script>

<template>
    <div class="border bg-slate-800 min-h-[450px] sm:min-h-[300px] rounded-md mt-2 p-4 shadow shadow-black">
        <div class="flex items-center justify-center lg:justify-start flex-wrap gap-5 mx-auto">
            <TestBuilderDragButton name="Visit URL">
                <template v-slot:icon>
                    <Url class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </TestBuilderDragButton>
            <TestBuilderDragButton name="Query DOM Element">
                <template v-slot:icon>
                    <Search class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </TestBuilderDragButton>
            <TestBuilderDragButton name="Click DOM Element">
                <template v-slot:icon>
                    <Click class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </TestBuilderDragButton>
            <TestBuilderDragButton name="Action DOM Input">
                <template v-slot:icon>
                    <Pen class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </TestBuilderDragButton>
            <TestBuilderDragButton name="Sleep">
                <template v-slot:icon>
                    <Pause class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </TestBuilderDragButton>
            <TestBuilderDragButton name="Screenshot">
                <template v-slot:icon>
                    <Camera class="w-4 h-4" stroke="#000000" fill="none" />
                </template>
            </TestBuilderDragButton>
        </div>
        <hr class="mt-[50px] border-dashed text-white">
        <div class="mt-[50px] flex justify-center items-end lg:justify-start flex-wrap gap-2 mx-auto">
            <template v-for="(x, index) in builder">
                <div class="relative">
                    <div class="text-white rounded-full flex items-center justify-center w-[35px] h-[35px] ring-2 ring-offset-1 font-semibold ring-white text-lg mb-3 ml-3">
                        <p v-text="index + 1"></p>
                    </div>
                    <div class="flex items-center gap-x-2">
                        <button class="w-[205px] cursor-pointer border border-white rounded-md p-2 shadow shadow-black font-semibold" :class="x.value ? 'bg-orange-500' : 'bg-yellow-300'" v-text="x.human_type" @mouseover="tooltip.index=index;tooltip.show=true" @mouseout="tooltip.show=false"></button>
                        <ArrowLong class="w-10 h-10" stroke="#FFFFFF" fill="none" />
                    </div>
                    <div v-show="tooltip.show && tooltip.index == index" class="border bg-white min-w-[250px] max-w-[275px] min-h-[50px] rounded-md absolute text-black shadow shadow-black p-4 text-sm text-ellipsis overflow-hidden whitespace-nowrap translate-x-[65%] translate-y-[-160%]">
                        <div class="text-right">
                            <p class="font-semibold">Step <span v-text="tooltip.index + 1"></span></p>
                        </div>
                        <ul class="mt-2">
                            <li><span class="font-semibold">Type: </span><span v-text="builder[tooltip.index]?.human_type"></span></li>
                            <li><span class="font-semibold">Value: </span><span v-text="builder[tooltip.index]?.value"></span></li>
                        </ul>
                    </div>
                </div>
            </template>
            <div>
                <div class="flex items-center gap-x-2">
                    <button class="w-[205px] cursor-pointer border border-dashed border-black rounded-md p-2 shadow shadow-black bg-slate-100 font-semibold" @dragover.prevent="onDragOver($event.target)" @dragleave.stop="onDragLeave($event.target)" @drop.prevent="handleDrop($event);onDragLeave($event.target)">Drop Step Here</button>
                </div>
            </div>
        </div>
    </div>
</template>