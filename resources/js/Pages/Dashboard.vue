<script>
import AuthenticatedLayout from '../Layouts/Authenticated.vue';
import Header from '../Components/Header.vue';
import TBContainer from '../Components/TestBuilder/TBContainer.vue';
import Rocket from '../Components/svg/Rocket.vue'
import Bookmark from '../Components/svg/Bookmark.vue';

export default {
    props: {
        userFullName: String,
        stepBuilderActions: Object
    },
    components: {
        AuthenticatedLayout, Header, TBContainer, Rocket, Bookmark
    },
}
</script>

<template>
    <AuthenticatedLayout>
        <template v-slot:nav>
            <Header :isAuth="true" :userFullName="userFullName" />
        </template>
        <template v-slot:content>
            <div class="grow bg-indigo-200 py-16">
                <div class="w-full sm:w-[80%] mx-auto h-full space-y-[150px] px-2">
                    <div>
                        <h1 class="text-xl font-semibold">My Stored Tests</h1>
                        <div class="w-full shadow shadow-black rounded-md mt-1">
                            <div class="grid grid-cols-3 sm:grid-cols-6 gap-x-1 px-1 py-1.5 font-semibold bg-slate-800 text-white rounded-t-md">
                                <small>Reference</small>
                                <small class="hidden sm:inline-block">Test Steps</small>
                                <small class="hidden sm:inline-block">Last Run</small>
                                <small class="hidden sm:inline-block">Created</small>
                                <small>Author</small>
                                <small class="text-center">Action</small>
                            </div>
                            <div class="p-1 grid grid-cols-3 sm:grid-cols-6 items-center gap-x-1">
                                <small>One</small>
                                <small class="hidden sm:inline-block">One</small>
                                <small class="hidden sm:inline-block">One</small>
                                <small class="hidden sm:inline-block">One</small>
                                <small>One</small>
                                <small class="text-center"><button type="button" class="cursor-pointer hover:bg-orange-600 font-semibold min-w-[75px] px-2 py-0.5 bg-orange-500 rounded-md shadow shadow-black">Manage</button></small>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h1 class="text-xl font-semibold">Create New Test</h1>
                        <small>Use the drag and drop builder to create your test. Tests should be built with a single user in mind. Once built and saved, you will have the option to swap out static properties for dynamic properties to run your load test against.</small>
                        <TBContainer :stepBuilderActions="stepBuilderActions" /> 
                        <div class="flex justify-end gap-x-2 mt-2">
                            <button type="button" class="cursor-pointer hover:bg-orange-600 font-semibold min-w-[95px] px-2 py-1 bg-orange-500 rounded-md shadow shadow-black text-xs flex items-center gap-x-1"><Rocket class="w-4 h-4" stroke="#000000" fill="none" />Run Test</button>
                            <button type="button" class="cursor-pointer hover:bg-orange-600 font-semibold min-w-[95px] px-2 p-1 bg-orange-500 rounded-md shadow shadow-black text-xs flex items-center gap-x-1"><Bookmark class="w-4 h-4" stroke="#000000" fill="none" />Store Test</button>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>