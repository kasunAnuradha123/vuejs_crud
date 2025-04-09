<script setup lang="ts">
import { ref } from "vue";
import { Dialog, TransitionRoot,TransitionChild,MenuButton,MenuItem,Menu  } from "@headlessui/vue";
import { Bars3CenterLeftIcon, XMarkIcon } from "@heroicons/vue/20/solid";
import { usePage, Link } from "@inertiajs/vue3";
// import Breadcrumbs from "../elements/header/BreadCumbs.vue";
import { navigationLinks } from "@/lib/SideNavLinks";
import NavItem from "./AdminSidebar/partials/NavItem.vue";

const sidebarOpen = ref(false);

function classNames(...classes: any) {
    return classes.filter(Boolean).join(" ");
}

const { props } = usePage();
const user = props.user;
</script>

<template>
    <TransitionRoot :show="sidebarOpen" as="template">
        <Dialog as="div" class="relative z-[101] lg:hidden" @close="sidebarOpen = false">
            <TransitionChild
                as="template"
                enter="transition-opacity ease-linear duration-300"
                enter-from="opacity-0"
                enter-to="opacity-100"
                leave="transition-opacity ease-linear duration-300"
                leave-from="opacity-100"
                leave-to="opacity-0"
            >
                <div class="fixed inset-0 bg-slate-900 bg-opacity-75" />
            </TransitionChild>

            <div class="fixed inset-0 z-50 flex">
                <TransitionChild
                    as="template"
                    enter="transition ease-in-out duration-300 transform"
                    enter-from="-translate-x-full"
                    enter-to="translate-x-0"
                    leave="transition ease-in-out duration-300 transform"
                    leave-from="translate-x-0"
                    leave-to="-translate-x-full"
                >
                    <Dialog class="relative flex w-full max-w-xs flex-1 flex-col bg-white pb-4 pt-5">
                        <TransitionChild
                            as="template"
                            enter="ease-in-out duration-300"
                            enter-from="opacity-0"
                            enter-to="opacity-100"
                            leave="ease-in-out duration-300"
                            leave-from="opacity-100"
                            leave-to="opacity-0"
                        >
                            <div class="absolute right-0 top-0 -mr-12 pt-2">
                                <button
                                    type="button"
                                    class="ml-1 flex h-10 w-10 items-center justify-center rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                                    @click="sidebarOpen = false"
                                >
                                    <span class="sr-only">Close sidebar</span>
                                    <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true" />
                                </button>
                            </div>
                        </TransitionChild>
                        <nav class="mt-1 h-full flex-shrink-0 overflow-y-auto" aria-label="Sidebar">
                            <img
                                class="w-[120px] h-[46px] items-center mx-auto ml-14"
                                src="https://www.zooplus.com/zooplus-logo.svg"
                            />
                            <div class="mt-9 border-solid rounded-tr-lg border-2 border-l-0 border-b-1 border-borderColor h-auto mr-4">
                                <!-- :routeName="item.route ? route(item.route) : ''" -->
                                <NavItem
                                    v-for="(item, index) in navigationLinks"
                                    :key="item.name + index"
                                    :name="item.name"
                                    :routeName= "item.route ? route(item.route) : ''",
                                    
                                    :startWith="item.startWith"
                                    :icon="item.icon"
                                    :link="item.link"
                                    :border="item.border"
                                    :children="item.children"
                                />
                            </div>
                            <div class="ml-8 border-solid border-2 border-l-0 border-t-0 border-b-0 border-borderColor">
                                <div class="flex justify-center py-6">
                                    <div>
                                        <!-- <img
                                            class="w-[60px] h-[60px] rounded-full object-cover"
                                            :src="user?.avatar"
                                        /> -->
                                    </div>
                                    <div class="w-[112px] ml-4">
                                        <p class="text-start text-base text-gray-600 font-[600] mt-3 truncate">
                                            <!-- {{ user.name }} -->
                                        </p>
                                        <p class="text-start text-base text-gray-600 font-[400] mt-1 overflow-clip">
                                            <!-- {{ user.email }} -->
                                        </p>
                                    </div>
                                    <div class="mt-5 px-4">
                                        <Link
                                            :href="route('logout')"
                                            method="post"
                                            as="button"
                                            class="self-center"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                                class="w-6 h-6 rotate-90"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5"
                                                />
                                            </svg>
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </Dialog>
                </TransitionChild>
                <div class="w-14 flex-shrink-0" aria-hidden="true"></div>
            </div>
        </Dialog>
    </TransitionRoot>

    <div>
        <div class="fixed z-50 top-0 left-0 right-0 lg:relative lg:top-0 lg:flex lg:flex-1 py-3 w-full lg:divide-x">
            <div class="relative w-full px-4 lg:px-0 justify-end lg:w-[210px] flex lg:block lg:justify-start">
                <button
                    type="button"
                    class="focus:outline-none focus:ring-2 focus:ring-inset focus:ring-transparent lg:hidden"
                    @click="sidebarOpen = true"
                >
                    <span class="sr-only">Open sidebar</span>
                    <Bars3CenterLeftIcon
                        class="h-6 w-6 text-slate-900 self-center mt-5"
                        aria-hidden="true"
                    />
                </button>
            </div>
        </div>
        <!-- <div class="lg:ml-4 py-4 px-4 lg:py-0 lg:px-0 lg:bg-transparent flex lg:items-center md:ml-6 justify-between">
            <div class="flex">
                <Menu as="div" class="relative ml-3 self-center">
                    <div>
                        <MenuButton class="flex max-w-xs items-center rounded-full text-sm focus:outline-none focus:ring-transparent group">
                            <span class="ml-3 text-sm font-medium text-gray-700">
                                <span class="sr-only">Open user menu for</span>
                            </span>
                        </MenuButton>
                    </div>
                    <Transition
                        as="template"
                        enter="transition ease-out duration-100"
                        enter-from="transform opacity-0 scale-95"
                        enter-to="transform opacity-100 scale-100"
                        leave="transition ease-in duration-75"
                        leave-from="transform opacity-100 scale-100"
                        leave-to="transform opacity-0 scale-95"
                    >
                        <MenuItems class="dropdown-menu absolute right-0 z-50 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                            <MenuItem>
                                <Link
                                    :href="route('dashboard')"
                                    class="block w-full px-4 py-2 text-left text-sm text-gray-700"
                                >
                                    Profile
                                </Link>
                            </MenuItem>
                            <MenuItem>
                                <Link
                                    :href="route('logout')"
                                    method="post"
                                    as="button"
                                    type="button"
                                    class="block w-full px-4 py-2 text-left text-sm text-gray-700"
                                >
                                    Logout
                                </Link>
                            </MenuItem>
                        </MenuItems>
                    </Transition>
                </Menu>
            </div>
        </div> -->
    </div>
</template>