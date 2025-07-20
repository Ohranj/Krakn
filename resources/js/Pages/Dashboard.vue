<script>
import AuthenticatedLayout from '../Layouts/Authenticated.vue';
import Header from '../Components/Header.vue';

export default {
    props: {
        userFullName: String
    },
    components: {
        AuthenticatedLayout, Header
    },
}
</script>

<template>
    <AuthenticatedLayout>
        <template v-slot:nav>
            <Header :isAuth="true" :userFullName="userFullName" />
        </template>
        <template v-slot:content>
            <div class="grow bg-indigo-200 py-8">
                <div class="w-full sm:w-[80%] mx-auto h-full">
                    <ul>
                        <li>List tests in a table</li>
                        <li>Create a new test</li>
                    </ul>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>