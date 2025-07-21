<script>
export default {
    props: {
        name: String,
    },
}
</script>

<template>
    <button class="w-[160px] text-sm md:text-base sm:w-[205px] cursor-pointer font-semibold bg-white rounded-md p-2 border hover:bg-slate-200 relative" draggable="true" @dragstart.stop="$event.dataTransfer.setData('text', name)">
        <span v-text="name"></span>
        <span class="absolute top-1 right-1">
            <slot name="icon" />
        </span>
    </button>
</template>