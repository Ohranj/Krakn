<script>
import AuthenticatedLayout from '../Layouts/Authenticated.vue';

export default {
    components: {
        AuthenticatedLayout
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <template v-slot:nav>
            <div></div>
        </template>
        <template v-slot:content>
            <div>Dashboard</div>
        </template>
    </AuthenticatedLayout>
</template>