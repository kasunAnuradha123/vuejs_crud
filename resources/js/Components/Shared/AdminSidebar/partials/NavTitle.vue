<template>
    <div class="pl-[20px] uppercase text-base font-[500] tracking-[0.5px] leading-4 text-black mt-5">
      {{ name }}
    </div>
  </template>
  
  <script setup>
  defineProps({
    name: {
      type: String,
      required: true
    }
  })
  </script>
  