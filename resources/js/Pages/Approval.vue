<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { onMounted } from 'vue';


// const user = usePage().props.auth.user;

// const getBrowser = () => {
//   const userAgent = navigator.userAgent

//   if (userAgent.includes("Chrome")) return "Chrome"
//   if (userAgent.includes("Firefox")) return "Firefox"
//   if (userAgent.includes("Safari") && !userAgent.includes("Chrome")) return "Safari"
//   if (userAgent.includes("Edg")) return "Edg"
//   if (userAgent.includes("Trident") || userAgent.includes("MSIE")) return "InternetExplorer"

//   return "Unknown"
// }

// onMounted(() => {
//   const browser = getBrowser()
//   const userId = user?.id

//   if (userId) {
//     router.visit(`/sendRequest/${browser}/${userId}`, {
//       method: 'get',
//       preserveState: true,
//       only: [],
//       onSuccess: (page) => {
//         console.log('Request successful', page)
//       },
//       onError: (err) => {
//         console.error('Request failed', err)
//       }
//     })
//   }
// })

</script>

<template>
  <Head title="Approval" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">Approval</h2>
    </template>

    <div class="p-5 space-y-6">
      <div>Approval </div>

   
    </div>
  </AuthenticatedLayout>
</template>
