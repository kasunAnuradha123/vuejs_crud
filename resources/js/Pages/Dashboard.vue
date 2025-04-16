<script setup lang="ts">
    import NavLink from '@/Components/NavLink.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { User } from '@/types';
    import { Head } from '@inertiajs/vue3';


    defineProps({
        usersCount : Number,
    })

</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template>   
        <div class="p-5">
           <span>
            welcome
           </span> 
           <div>Users Count:
            <span class="text-2xl font-bold text-blue-500">
                {{ usersCount }}
            </span>
           </div>
        </div>
    </AuthenticatedLayout>
</template>