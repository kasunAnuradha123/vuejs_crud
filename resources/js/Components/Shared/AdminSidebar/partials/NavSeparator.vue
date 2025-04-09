<template>
    <div class="mt-4 border-t-2 border-slate-300 pt-[5px] pl-[20px]">
      <span class="uppercase text-md font-[500] tracking-[0.5px] leading-4 text-black">
        {{ name }}
      </span>
    </div>
  </template>
  
  <script setup>
  defineProps({
    name: [String, Number] // or just use `String` if you want to be strict
  })
  </script>
  