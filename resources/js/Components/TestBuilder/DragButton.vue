<script>
export default {
    props: {
        human_type: String,
        type: String,
    },
    methods: {
        onDragStart(e, type) {
            e.dataTransfer.setData('text', type)
        }
    }
}
</script>

<template>
    <button class="w-[160px] text-sm md:text-base sm:w-[205px] cursor-pointer font-semibold bg-white rounded-md p-2 border hover:bg-slate-200 relative" draggable="true" @dragstart.stop="onDragStart($event, type)">
        <span v-text="human_type"></span>
        <span class="absolute top-1 right-1">
            <slot name="icon" />
        </span>
    </button>
</template>