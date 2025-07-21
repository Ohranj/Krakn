<script>
export default {
    props: {
        name: String
    },
    mounted() {
        console.log(2)
    }
}
</script>

<template>
    <button class="w-[160px] text-sm md:text-base sm:w-[205px] cursor-pointer font-semibold bg-white rounded-md p-2 border hover:bg-slate-200" v-text="name"></button>
</template>