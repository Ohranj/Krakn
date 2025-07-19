<script>
export default {
    props: {
        errors: Array
    },
}
</script>

<template>
    <div class="flex flex-col text-sm fixed top-[80px] right-0 left-0 items-center gap-y-2">
        <template v-for="x in errors">
            <div class="bg-slate-800 cursor-pointer text-white font-semibold border w-[300px] p-4 rounded-md shadow shadow-black" :class="{'hidden': !x.show}" v-text="x.message" @click="x.show=false"></div>
        </template>
    </div>
</template>

