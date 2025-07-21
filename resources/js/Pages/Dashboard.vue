<script>
import AuthenticatedLayout from '../Layouts/Authenticated.vue';
import Header from '../Components/Header.vue';
import TestBuilderDragButton from '../Components/TestBuilderDragButton.vue';

export default {
    props: {
        userFullName: String
    },
    components: {
        AuthenticatedLayout, Header, TestBuilderDragButton
    },
    data() {
        return {
        }
    }
}
</script>

<template>
    <AuthenticatedLayout>
        <template v-slot:nav>
            <Header :isAuth="true" :userFullName="userFullName" />
        </template>
        <template v-slot:content>
            <div class="grow bg-indigo-200 py-8">
                <div class="w-full sm:w-[80%] mx-auto h-full space-y-20 px-2">
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
                        <div class="border bg-slate-800 min-h-[450px] sm:min-h-[375px] rounded-md mt-5 p-4 shadow shadow-black">
                            <div class="flex items-center justify-center lg:justify-start flex-wrap gap-5 mx-auto">
                                <TestBuilderDragButton name="Visit URL" />
                                <TestBuilderDragButton name="Access DOM Element" />
                                <TestBuilderDragButton name="Click DOM Element" />
                                <TestBuilderDragButton name="Action DOM Input" />
                                <TestBuilderDragButton name="Sleep" />
                                <TestBuilderDragButton name="Screenshot" />
                            </div>
                            <hr class="mt-[50px] border-dashed text-white">
                            <div class="mt-[50px] flex justify-center items-center lg:justify-start flex-wrap gap-5 mx-auto">
                                <div>
                                    <div class="text-white rounded-full flex items-center text-center justify-center w-[35px] h-[35px] ring-2 ring-offset-1 font-semibold ring-white text-lg mb-2 mx-auto">
                                        <p>1</p>
                                    </div>
                                    <button class="w-[205px] border border-dashed border-white rounded-md p-2 shadow shadow-black bg-slate-400">Drop here</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>