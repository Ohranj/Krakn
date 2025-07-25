<script>
import Chevron from '../Components/svg/Chevron.vue'
import CustomEvents from '../Helpers/CustomEvents'
import Logout from '../Components/svg/Logout.vue'
import Avatar from '../Components/svg/Avatar.vue'
import Box from '../Components/svg/Box.vue'

export default {
    props: {
        isAuth: Boolean,
        userFullName: String
    },
    components: {
        Chevron, Logout, Avatar, Box
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
    <div class="min-h-[75px] bg-slate-800 text-white">
        <div class="flex items-center w-[95%] sm:w-[80%] mx-auto h-full justify-between">
            <h1 class="font-semibold text-2xl text-orange-500">Krakn</h1>
            <div v-if="isAuth" class="text-white text-sm transition-opacity duration-750 starting:opacity-0" :id="dropdown.targetElemId">
                <button class="cursor-pointer hover:bg-slate-600 rounded-md min-w-[95px] px-2 py-1 flex items-center gap-x-1" @click.stop="dropdown.state=!dropdown.state">
                    <span v-text="userFullName"></span>
                    <Chevron class="w-4 h-4" stroke="#FFFFFF" fill="none" />
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