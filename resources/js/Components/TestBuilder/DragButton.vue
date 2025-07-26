<script>
export default {
    props: {
        action: Object
    },
    methods: {
        onDragStart(e, type) {
            const transferKey = type.complete ? 'completed' : 'incomplete'
            e.dataTransfer.setData(transferKey, JSON.stringify(type))
            this.$emit('isDraggingState');
        }
    }
}
</script>

<template>
    <button class="text-sm md:text-base sm:w-[205px] cursor-pointer font-semibold bg-white rounded-md p-2 border hover:bg-slate-200 relative" draggable="true" @dragstart.stop="onDragStart($event, action)" @dragend.stop="$emit('isDraggingState')">
        <span v-text="action['human_type']"></span>
        <span class="absolute top-1 right-1">
            <slot name="icon" />
        </span>
    </button>
</template>