<script>
import Chevron from '../Components/svg/Chevron.vue'
import CustomEvents from '../Helpers/CustomEvents'
import Logout from '../Components/svg/Logout.vue'
import Avatar from '../Components/svg/Avatar.vue'

export default {
    props: {
        isAuth: Boolean
    },
    components: {
        Chevron, Logout, Avatar
    },
    data() {
        return {
            customEvents: new CustomEvents(),
            dropdown: {
                state: false,
                targetElemId: 'authSettingsDropdown'
            }
        }
    },
    created() {
        document.addEventListener('click', (e) => {
            if (!this.dropdown.state) return;
            this.dropdown.state = this.customEvents.wasClickOutsideElement(e.target, this.dropdown.targetElemId);
        })
    }
}
</script>

<template>
    <div class="h-[75px] bg-slate-800 text-white border-b border-slate-200">
        <div class="flex items-center w-[80%] mx-auto h-full justify-between">
            <h1 class="font-semibold text-2xl text-orange-500">Krakn</h1>
            <div v-if="isAuth" class="text-white text-sm transition-opacity duration-750 starting:opacity-0" :id="dropdown.targetElemId">
                <button class="cursor-pointer hover:bg-slate-600 rounded-md min-w-[95px] px-2 py-1 flex items-center gap-x-1" @click.stop="dropdown.state=!dropdown.state">
                    <span>Settings</span>
                    <Chevron class="w-4 h-4" stroke="#FFFFFF" fill="none" />
                </button>
                <transition name="collapse">
                    <div v-if="dropdown.state" class="absolute min-w-[200px] mt-1 rounded-md bg-white transition ease-in-out duration-[0.4s] origin-top text-black shadow shadow-black">
                        <ul class="space-y-1.5">
                            <li class="cursor-pointer p-2 flex items-center gap-x-1 hover:bg-slate-200 rounded-t-md">
                                <Avatar class="w-6 h-6" stroke="#000000" fill="none" />
                                <span>My Profile</span>
                            </li>
                            <hr class="border-dashed">
                            <li class="rounded-b-md bg-red-100 hover:bg-red-200">
                                <a href="/logout" class="flex items-center gap-x-1 p-2">
                                    <Logout class="w-6 h-6" stroke="#000000" fill="none" />
                                    <span>Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</template>