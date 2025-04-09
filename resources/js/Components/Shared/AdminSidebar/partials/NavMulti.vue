<template>
    <div>
      <span
        @click="dropState = !dropState"
        :class="[
          isActive(startWith)
            ? 'text-textBlue bg-navItemPrimary'
            : 'text-slate-500 hover:text-black hover:bg-secondButton cursor-pointer',
          'group flex items-center text-sm p-3 font-medium duration-300 ease-in-out transition-all w-full'
        ]"
        :aria-current="isActive(startWith) ? 'page' : undefined"
      >
        <DynamicHeroIcon
          v-if="icon"
          :icon="icon"
          :class="[
            isActive(startWith) ? 'active text-navItemSecond' : 'text-navItemSecond duration-300 ease-in-out transition-all',
            'mr-4 ml-7 h-[22px] w-[18px] flex-shrink-0'
          ]"
          aria-hidden="true"
        />
        <div
          v-if="svg"
          :class="[
            isActive(startWith) ? 'active text-navItemSecond' : 'text-navItemSecond duration-300 ease-in-out transition-all',
            'mr-5 ml-6 h-[22px] w-[18px] flex-shrink-0'
          ]"
        >
          <component :is="svg" />
        </div>
  
        <span class="text-base font-[600] hover:font-bold mt-1">{{ name }}</span>
  
      
  
        <component
          :is="dropState || isActive(startWith) ? ChevronDownIcon : ChevronUpIcon"
          class="text-slate-500 w-[18px] h-[18px] ml-auto"
        />
      </span>
  
      <div
        :class="[
          (dropState || isActive(startWith)) ? 'block' : 'hidden',
          'duration-300 ease-in-out transition-all w-full bg-white rounded-lg'
        ]"
      >
        <ul>
          <li v-for="(child, index) in children" :key="index" class="mt-2">
            <Link
              :href="route(child.route, { status: child.status })"
              :class="[
                isActive(child.startWith)
                  ? 'text-textBlue bg-secondButton'
                  : 'text-navItemSecond hover:text-black hover:bg-secondButton',
                'group mt-0 flex items-center text-base font-[600] leading-6 duration-200 ease-in-out transition-color w-full py-2'
              ]"
              :aria-current="isActive(child.startWith) ? 'page' : undefined"
            >
              <span class="text-base font-[600] ml-20 hover:font-bold py-1">{{ child.name }}</span>
              <div v-if="getChildBadgeCount(child) > 0" class="relative ml-3 top-[-3px] left-[90%] sm:top-[-2px] sm:left-[79%]">
                <span class="absolute -right-2 -top-2 inline-flex h-5 w-5 items-center justify-center rounded-full bg-red-500 p-1 text-center text-xs text-white">
                  {{ getChildBadgeCount(child) }}
                </span>
              </div>
            </Link>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue'
  import { usePage, Link } from '@inertiajs/vue3'
  import { ChevronDownIcon, ChevronUpIcon } from '@heroicons/vue/20/solid'
  import DynamicHeroIcon from '@/Components/elements/icons/DynamicHeroIcon.vue'
  
  const props = defineProps({
    startWith: String,
    name: String,
    icon: Object,
    children: Array,
    svg: Object,
  })
  
  const page = usePage()
  const url = page.url
  
  
  
  const dropState = ref(false)
  
  const isActive = (path) => {
    if (path === '/admin') return url === path
    return url.startsWith(path ?? '')
  }
  

  
  const badgeWrapperClass = computed(() => {
    return 'relative ml-3 top-[-3px] left-[90%] sm:top-[-2px] sm:left-[79%]'
  })
  

  </script>
  