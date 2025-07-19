<script>
import GuestLayout from '../Layouts/Guest.vue'
import Header from '../Components/Header.vue'
import JsonResponseHelpers from '../Helpers/JsonResponse'
import CustomEvents from '../Helpers/CustomEvents'

export default {
    components: {
        GuestLayout, Header
    },
    data() {
        return {
            jsonResponseHelpers: new JsonResponseHelpers(),
            customEvents: new CustomEvents(),
            forms: {
                login: {
                    email: '',
                    password: ''
                }
            },
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
                console.log(json.errors)
                const errors = this.jsonResponseHelpers.flattenErrors(json.errors);
                for (const x of errors) {
                    this.customEvents.showError(x)
                }
                this.forms.login.password = ''
                return
            }
            console.log(response)
        }
    },
}
</script>

<template>
    <GuestLayout>
        <template v-slot:nav>
            <Header />
        </template>
        <template v-slot:content>
            <div class="grow bg-indigo-200 p-4 flex items-center justify-center">
                <div class="border flex items-stretch h-[325px] w-full max-w-[850px] bg-slate-800 shadow shadow-slate-600 text-white rounded-lg divide-amber-600 divide-x-2 transition-opacity opacity-100 duration-750 starting:opacity-0">
                    <div class="w-full hidden md:block">2</div>
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
            </div>
        </template>
    </GuestLayout>
</template>