<template>
    <div>
        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:flex lg:w-[300px] lg:flex-col h-full fixed left-0 top-0 bottom-0">
            <!-- Sidebar component -->
            <div class="overflow-y-auto no-scrollbar flex flex-grow flex-col bg-white pr-3 pt-0 sticky">
                <nav
                    class="overflow-revert scrollbar-track-rounded-full sticky scrollbar-thumb-rounded-full flex flex-1 flex-col overscroll-auto scroll-smooth scrollbar-thin  border-solid rounded-tr-lg border-2 border-l-0 border-b-1 border-borderColor"
                    aria-label="Sidebar"
                >
                    <div class="flex justify-between">
                        <img
                            class="w-[241px] h-[56px] mt-10 items-center mx-auto ml-6"
                          src="https://picsum.photos/240/56"
                        />
                    </div>

                    <div class="mt-9 h-full">
                        <div v-for="(item, index) in navigationLinks" :key="index">
                            <!-- Multi Nav -->
                            <NavMulti
                                v-if="item.link && item.children?.length > 0 "
                                :name="item.name"
                                :startWith="item.startWith"
                                :icon="item.img"
                                :children="item.children"
                                :svg="item.svg"
                            />

                            <!-- Single nav -->
                            <NavSingle
                                v-if="item.link && !item.children "
                                :name="item.name"
                                :startWith="item.startWith"
                                :routeName="route(item.route)"
                                :icon="item.icon"
                                :svg="item.svg"
                            />

                            <!-- Nav Separator -->
                            <NavSeparator
                                v-if="!item.link && item.border "
                                :name="item.name"
                            />

                            <!-- Nav Title -->
                            <NavTitle
                                v-if="!item.link && !item.border "
                                :name="item.name"
                            />
                        </div>
                    </div>

                    <div class="ml-8 border-solid border-2 border-l-0 border-t-0 border-b-0 border-borderColor">
                        <div class="flex justify-center py-6">
                            <div>
                                <img
                                    class="w-[60px] h-[60px] rounded-full object-cover mt-2"
                                    :src="user?.avatar"
                                />
                            </div>
                            <div class="w-[112px] ml-4">
                                <p class="text-start text-base text-gray-600 font-[600] mt-3 truncate">
                                    {{ user.name }}
                                </p>
                                <p class="text-start text-base text-gray-600 font-[400] mt-1 truncate">
                                    {{ user.email }}
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
            </div>
        </div>
    </div>
</template>

<script>
import NavMulti from "./partials/NavMulti.vue";
import NavSingle from "./partials/NavSingle.vue";
import NavSeparator from "./partials/NavSeparator.vue";
import NavTitle from "./partials/NavTitle.vue";
import { navigationLinks } from "@/lib/SideNavLinks";
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        NavMulti,
        NavSingle,
        NavSeparator,
        NavTitle,
        Link,
    },
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            navigationLinks,
        };
    },
   
};
</script>

<style scoped>
/* Add your styles here */
</style>
















<!-- 

<template>
    <div>
        <div class="hidden lg:fixed lg:flex lg:w-[300px] lg:flex-col h-full fixed left-0 top-0 bottom-0">
            <div class="overflow-y-auto no-scrollbar flex flex-grow flex-col bg-white pr-3 pt-0 sticky">
                <nav
                    class="overflow-revert scrollbar-track-rounded-full sticky scrollbar-thumb-rounded-full flex flex-1 flex-col overscroll-auto scroll-smooth scrollbar-thin"
                    aria-label="Sidebar"
                >
                    <div class="flex justify-between">
                        <img
                            class="w-[141px] h-[46px] mt-10 items-center mx-auto ml-6"
                            src="/assets/images/logo/S&M-logo.png"
                        />
                    </div>

                    <div class="mt-9 border-solid rounded-tr-lg border-2 border-l-0 border-b-1 border-borderColor h-full">
                        <div v-for="(item, index) in navigationLinks" :key="index">
                            <NavMulti
                                v-if="item.link && item.children?.length > 0 && canContinueArray(item.permissions, user)"
                                :name="item.name"
                                :startWith="item.startWith"
                                :icon="item.img"
                                :children="item.children"
                                :svg="item.svg"
                            />

                            <NavSingle
                                v-if="item.link && !item.children && canContinueArray(item.permissions, user)"
                                :name="item.name"
                                :startWith="item.startWith"
                                :routeName="route(item.route)"
                                :icon="item.icon"
                                :svg="item.svg"
                            />

                            <NavSeparator
                                v-if="!item.link && item.border && canContinueArray(item.permissions, user)"
                                :name="item.name"
                            />

                            <NavTitle
                                v-if="!item.link && !item.border && canContinueArray(item.permissions, user)"
                                :name="item.name"
                            />
                        </div>
                    </div>

                    <div class="ml-8 border-solid border-2 border-l-0 border-t-0 border-b-0 border-borderColor">
                        <div class="flex justify-center py-6">
                            <div>
                                <img
                                    class="w-[60px] h-[60px] rounded-full object-cover mt-2"
                                    :src="user?.avatar"
                                />
                            </div>
                            <div class="w-[112px] ml-4">
                                <p class="text-start text-base text-gray-600 font-[600] mt-3 truncate">
                                    {{ user.full_name }}
                                </p>
                                <p class="text-start text-base text-gray-600 font-[400] mt-1 truncate">
                                    {{ user.email }}
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
            </div>
        </div>
    </div>
</template>

<script>
import NavMulti from "./partials/NavMulti.vue";
import NavSingle from "./partials/NavSingle.vue";
import NavSeparator from "./partials/NavSeparator.vue";
import NavTitle from "./partials/NavTitle.vue";
import { navigationLinks } from "@/lib/SideNavLinks";
import { canContinueArray } from "@/lib/utility";
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        NavMulti,
        NavSingle,
        NavSeparator,
        NavTitle,
        Link,
    },
    props: {
        user: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            navigationLinks,
        };
    },
    methods: {
        canContinueArray,
        route(name) {
            // Replace this with your actual route function
            return `/route/${name}`;
        },
    },
};
</script>

<style scoped>
/* Add your styles here */
</style> -->