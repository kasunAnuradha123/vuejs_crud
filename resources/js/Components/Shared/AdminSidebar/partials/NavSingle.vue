<template>
    <div>
      <Link
        :href="routeName"
        :class="[
          isActive(startWith)
            ? 'text-textBlue bg-secondButton'
            : 'text-slate-500 cursor-pointer hover:bg-secondButton hover:font-bold hover:text-black',
          'group mt-0 flex p-3 items-center text-base font-[600] duration-300 ease-in-out transition-all w-full'
        ]"
        :aria-current="isActive(startWith) ? 'page' : undefined"
      >
        <DynamicHeroIcon
          v-if="icon"
          :icon="icon"
          :class="[
            isActive(startWith) ? 'active text-textBlue' : 'text-navItemSecond duration-300 ease-in-out transition-all hover:font-bold',
            'mr-4 h-[22px] w-[18px] flex-shrink-0 ml-7'
          ]"
          aria-hidden="true"
        />
        <div
          v-else
          :class="[
            isActive(startWith) ? 'active text-navItemSecond' : 'text-navItemSecond duration-300 ease-in-out transition-all',
            'mr-5 ml-6 h-[22px] w-[18px] flex-shrink-0'
          ]"
        >
          <component :is="svg" />
        </div>
  
        <span class="text-base font-[600] hover:font-bold hover:text-black">
          {{ name }}
        </span>
  
      </Link>
    </div>
  </template>
  
  <script setup>
  import { computed } from 'vue'
  import { Link, usePage } from '@inertiajs/vue3'
  import DynamicHeroIcon from '@/Components/elements/icons/DynamicHeroIcon.vue'

  
  
  const props = defineProps({
    startWith: String,
    routeName: String,
    name: [String, Number],
    icon: [String, Object],
    svg: [Object, Function],
  })
  
  const page = usePage()
  const url = computed(() => page.url)
  
  
  function isActive(startWith) {
    if (startWith === '/admin') {
      return url.value === startWith
    }
    return url.value.startsWith(startWith ?? '')
  }
  </script>
  