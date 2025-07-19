<script>
import AuthenticatedLayout from '../Layouts/Authenticated.vue';
import Header from '../Components/Header.vue';

export default {
    components: {
        AuthenticatedLayout, Header
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <template v-slot:nav>
            <Header />
        </template>
        <template v-slot:content>
            <div class="grow bg-indigo-200">Dashboard</div>
        </template>
    </AuthenticatedLayout>
</template>