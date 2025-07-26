<script>
import ArrowLong from '../svg/ArrowLong.vue';

export default {
    props: {
       step: Object,
       index: Number,
       tooltip: Object,
    },
    components: {
        ArrowLong
    },
    data() {
        return {
            hoveringStep: {
                seconds: 0,
                intval: null
            }
        }
    },
    methods: {
        onMouseover(index) {
            this.hoveringStep.intval = setInterval(() => {
            this,this.hoveringStep.seconds += 1;
            if (this.hoveringStep.seconds >= 1) {
                this.$emit('showTooltip', index)
                this.resetStepHover()
            }
            }, 1000)
        },
        onMouseout() {
            this.resetStepHover()
            this.$emit('hideTooltip')
        },
        resetStepHover() {
            clearInterval(this.hoveringStep.intval)
            this.hoveringStep.seconds = 0;
        },
        onDragOver() {
            //Emit an event that splices a step in between
            console.log(2)
        }
    }
}
</script>

<template>
    <div class="relative">
        <div class="text-white rounded-full flex items-center justify-center w-[35px] h-[35px] ring-2 ring-offset-1 font-semibold ring-white text-lg mb-3 ml-3">
            <p v-text="index + 1"></p>
        </div>
        <div class="flex items-center gap-x-2">
            <button class="w-[175px] cursor-pointer border border-white rounded-md p-2 shadow shadow-black font-semibold" :class="step.complete ? 'bg-indigo-600 hover:bg-indigo-700 text-white' : 'bg-yellow-300 hover:bg-yellow-400'" v-text="step.human_type" @mouseover="onMouseover(index)" @mouseout="onMouseout('hideTooltip')" @dragover.prevent="onDragOver()"></button>
            <ArrowLong class="w-10 h-10" stroke="#FFFFFF" fill="none" />
        </div>
        <div v-show="tooltip.show && tooltip.index == index" class="z-20 border bg-white min-w-[250px] max-w-[275px] min-h-[50px] rounded-md absolute text-black shadow shadow-black p-4 text-sm text-ellipsis overflow-hidden whitespace-nowrap translate-x-[30%] translate-y-[-150%]">
            <div class="text-right">
                <p class="font-semibold">step <span v-text="tooltip.index + 1"></span></p>
            </div>
            <slot name="tooltip" />
        </div>
    </div>
</template>