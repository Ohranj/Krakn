<script>
import Chevron from '../Components/svg/Chevron.vue'
import CustomEvents from '../Helpers/CustomEvents'
import Logout from './svg/Logout.vue'
import Avatar from './svg/Avatar.vue'
import Box from './svg/Box.vue'
import Checklist from './svg/Checklist.vue'

export default {
    props: {
        isAuth: Boolean,
        userFullName: String
    },
    components: {
        Chevron, Logout, Avatar, Box, Checklist
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
    <div class="min-h-[55px] bg-indigo-50 border-b border-slate-300">
        <div class="flex items-center w-[95%] sm:w-[80%] mx-auto h-full justify-between">
            <h1 class="font-semibold text-2xl text-indigo-600">Krakn</h1>
            <div v-if="isAuth" class="text-sm transition-opacity duration-750 starting:opacity-0 font-semibold" :id="dropdown.targetElemId">
                <button class="cursor-pointer hover:bg-slate-300 rounded-md min-w-[95px] px-2 py-1 flex items-center gap-x-1" @click.stop="dropdown.state=!dropdown.state">
                    <span v-text="userFullName"></span>
                    <Chevron class="w-4 h-4" stroke="#000000" fill="none" />
                </button>
                <transition name="collapse">
                    <template v-if="dropdown.state">
                        <div class="absolute right-[2.5%] sm:right-[10%] min-w-[225px] mt-1 rounded-md bg-white transition ease-in-out duration-[0.4s] origin-top text-black shadow shadow-black">
                            <ul>
                                <li class="cursor-pointer p-2 flex items-center gap-x-1 hover:bg-slate-200 rounded-t-md">
                                    <Avatar class="w-6 h-6" stroke="#000000" fill="none" />
                                    <span>My Profile</span>
                                </li>
                                <li class="cursor-pointer p-2 flex items-center gap-x-1 hover:bg-slate-200 rounded-t-md">
                                    <Box class="w-6 h-6" stroke="#000000" fill="none" />
                                    <span>My Sheets</span>
                                </li>
                                <li class="cursor-pointer p-2 flex items-center gap-x-1 hover:bg-slate-200 rounded-t-md">
                                    <Checklist class="w-6 h-6" stroke="#000000" fill="none" />
                                    <span>Activity</span>
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
                    </template>
                </transition>
            </div>
        </div>
    </div>
</template>