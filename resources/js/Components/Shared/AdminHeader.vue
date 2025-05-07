<script setup lang="ts">
import { ref } from "vue";
import { Dialog, TransitionRoot, TransitionChild } from "@headlessui/vue";
import { Bars3CenterLeftIcon, XMarkIcon } from "@heroicons/vue/20/solid";
import { Link } from "@inertiajs/vue3";
import { navigationLinks } from "@/lib/SideNavLinks";
import NavItem from "./AdminSidebar/partials/NavItem.vue";
import { User } from "@/types";

// Correct props definition
defineProps<{
  user: User;
}>();

// Sidebar open/close state
const sidebarOpen = ref(false);

// Helper function for class names (optional improvement)
function classNames(...classes: (string | boolean | null | undefined)[]) {
  return classes.filter(Boolean).join(' ');
}
</script>

<template>
  <!-- Sidebar for Mobile -->
  <TransitionRoot :show="sidebarOpen" as="template">
    <Dialog as="div" class="relative z-[101] lg:hidden" @close="sidebarOpen = false">
      <!-- Background overlay -->
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
        <!-- Sidebar panel -->
        <TransitionChild
          as="template"
          enter="transition ease-in-out duration-300 transform"
          enter-from="-translate-x-full"
          enter-to="translate-x-0"
          leave="transition ease-in-out duration-300 transform"
          leave-from="translate-x-0"
          leave-to="-translate-x-full"
        >
          <DialogPanel class="relative flex w-full max-w-xs flex-1 flex-col bg-white pb-4 pt-5">
            <!-- Close button -->
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

            <!-- Sidebar content -->
            <nav class="mt-5 flex-1 overflow-y-auto px-2" aria-label="Sidebar">
              <img class="w-[120px] h-[46px] mx-auto" src="https://www.zooplus.com/zooplus-logo.svg" />
              
              <!-- Navigation Links -->
              <div class="mt-9 space-y-1">
                <NavItem
                  v-for="(item, index) in navigationLinks"
                  :key="item.name + index"
                  :name="item.name"
                  :routeName="item.route ? route(item.route) : ''"
                  :startWith="item.startWith"
                  :icon="item.icon"
                  :link="item.link"
                  :border="item.border"
                />
              </div>

              <!-- User Info and Logout -->
              <div class="mt-6 flex items-center space-x-4 px-4">
                <!-- Uncomment this if you have avatar -->
                <!-- <img class="h-10 w-10 rounded-full" :src="user.avatar" alt="User Avatar" /> -->
                <div>
                  <p class="text-sm font-medium text-gray-900">{{ user.name }}</p>
                  <p class="text-sm text-gray-500">{{ user.email }}</p>
                </div>
                <Link
                  :href="route('logout')"
                  method="post"
                  as="button"
                  class="ml-auto text-gray-500 hover:text-gray-700"
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
            </nav>
          </DialogPanel>
        </TransitionChild>

        <!-- Empty div to close sidebar by clicking outside -->
        <div class="w-14 flex-shrink-0" aria-hidden="true"></div>
      </div>
    </Dialog>
  </TransitionRoot>

  <!-- Top Navbar -->
  <div class="fixed z-50 top-0 left-0 right-0 lg:relative py-3 w-full">
    <div class="flex justify-end px-4 lg:px-0">
      <button
        type="button"
        class="lg:hidden flex items-center focus:outline-none"
        @click="sidebarOpen = true"
      >
        <span class="sr-only">Open sidebar</span>
        <Bars3CenterLeftIcon class="h-6 w-6 text-slate-900" aria-hidden="true" />
      </button>
    </div>
  </div>
</template>
