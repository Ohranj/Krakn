<script>
import Bell from '../Components/svg/bell.vue'

export default {
    props: {
        errors: Array
    },
    components: {
        Bell
    }
}
</script>

<template>
    <div class="flex flex-col text-sm fixed top-[80px] right-0 left-0 items-center gap-y-2">
        <template v-for="x in errors">
            <div class="bg-slate-800 cursor-pointer text-white font-semibold border w-[300px] p-4 rounded-md shadow shadow-black grid grid-cols-6 items-center" :class="{'hidden': !x.show}" @click="x.show=false">
                <div><Bell class="w-6 h-6" stroke="#FFFFFF" fill="none" /></div>
                <small class="col-span-5" v-text="x.message"></small>
            </div>
        </template>
    </div>
</template>

