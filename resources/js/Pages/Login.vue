<script>
import GuestLayout from '../Layouts/Guest.vue'
import Header from '../Components/Header.vue'
import JsonResponseHelpers from '../Helpers/JsonResponse'
import CustomEvents from '../Helpers/CustomEvents'
import spinner from '../Components/svg/spinner.vue'

export default {
    components: {
        GuestLayout, Header, spinner
    },
    data() {
        return {
            jsonResponseHelpers: new JsonResponseHelpers(),
            customEvents: new CustomEvents(),
            forms: {
                login: {
                    email: '',
                    password: '',
                }
            },
            success: false
        }
    },
    methods: {
        async onLoginSubmit() {
            const response = await fetch('/login', {
                method: 'POST',
                body: JSON.stringify(this.forms.login),
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.csrfToken
                }
            })
            const json = await response.json()
            if (!response.ok) {
                const errors = this.jsonResponseHelpers.flattenErrors(json.errors);
                for (const x of errors) {
                    this.customEvents.showError(x)
                }
                this.forms.login.password = ''
                return
            }
            this.success = true
            setTimeout(() => {
                location.href = '/dashboard'
            }, 2000)
        }
    },
}
</script>

<template>
    <GuestLayout>
        <template v-slot:nav>
            <Header :isAuth="false" />
        </template>
        <template v-slot:content>
            <div class="grow bg-indigo-200 p-4 flex flex-col items-center justify-center">
                <Transition name="slide-up">
                    <div v-if="!success" class="border flex items-stretch h-[324px] w-full max-w-[850px] bg-slate-800 shadow-lg shadow-slate-600 text-white rounded-lg divide-slate-300 divide-x-2 transition-opacity duration-750 starting:opacity-0">
                        <div class="w-full hidden md:block">
                            <img :src="'/static/images/kraken-8769519_640.jpg'" class="w-full h-full rounded-l-md sepia-50" />
                        </div>
                        <div class="w-full flex flex-col justify-between p-6">
                            <h1 class="text-2xl underline underline-offset-4 decoration-2">Welcome back</h1>
                            <form class="grow flex flex-col justify-center space-y-5" id="f_login" @submit.prevent="onLoginSubmit">
                                <div class="flex flex-col">
                                    <label>Email</label>
                                    <input v-model="forms.login.email" type="email" class="rounded-md border border-slate-400 px-2 py-1 bg-violet-100 text-black focus:outline-amber-800" placeholder="..." />
                                </div>
                                <div class="flex flex-col">
                                    <label>Password</label>
                                    <input v-model="forms.login.password" type="password" class="rounded-md border border-slate-400 px-2 py-1 bg-violet-100 text-black focus:outline-amber-800" placeholder="..." />
                                </div>
                            </form>
                            <button type="submit" form="f_login" class="font-semibold bg-orange-500 px-2 py-1 text-sm min-w-[105px] rounded-md hover:bg-orange-600 cursor-pointer mx-auto">Sign In</button>
                        </div>
                    </div>
                    <div v-else="success" role="status" class="flex flex-col items-center space-y-2">
                        <spinner class="w-10 h-10 text-slate-500 animate-spin fill-amber-600" fill="none" />
                        <span>Loading...</span>
                    </div>
                </Transition>
            </div>
        </template>
    </GuestLayout>
</template>