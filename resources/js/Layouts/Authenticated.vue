<script>
import Toast from '../Components/Toast.vue'

export default {
    components: {
        Toast
    },
    data() {
        return {
            errors: [],
            alerts: []
        }
    },
    methods: {
        pushError(item) {
            this.errors.push(item.detail)
            setTimeout(() => this.errors.shift(), 7500)
        }
    }
}
</script>

<template>
    <main class="flex flex-col h-full" id="main" @show-error="pushError">
        <Toast :errors="errors" />
        <slot name="nav" />
        <slot name="content" />
    </main>
</template>