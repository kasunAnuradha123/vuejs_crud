<script setup lang="ts">
import NavLink from '@/Components/NavLink.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { User } from '@/types';
import { Head } from '@inertiajs/vue3';


defineProps<{
    users?:User[];
}>();

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                <dev class=" grid grid-cols-2"> 
                    <div class="px-6 py-4">
                        <!-- <ResponsiveNavLink :href="route('profile.edit')">
                            Profile
                        </ResponsiveNavLink> -->
                     <NavLink
                            :href="route('create')"
                            class="text-black bg-indigo-300 rounded-md px-2 "
                        >
                            Add Users
                        </NavLink>
                    </div>
                    </dev>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Name
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Email
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                >
                                    Created At
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="user in users" :key="user.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ user.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ user.email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ user.created_at }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <NavLink
                                        :href="route('deleteUser', { id: user.id })"
                                        method="delete"
                                        as="button"
                                        class="text-white bg-red-500 rounded-md px-2 py-1"
                                    >
                                        Delete
                                    </NavLink>
                                    <!-- <NavLink
                                        :href="route('deleteUser', user.id,{
                                            method: 'delete',
                                        })"
                                        class="text-black bg-indigo-300 rounded-md px-2 "
                                    >
                                        Delete
                                    </NavLink> -->
                                </td>
                                <!-- delete button  -->
                                <!-- <td class="px-6 py-4 whitespace-nowrap">
                                    <form
                                        @submit.prevent="form.delete(route('deleteUser', user.id))"
                                    >
                                        <PrimaryButton
                                            type="submit"
                                            class="bg-red-500 text-white rounded-md px-2"
                                        >
                                            Delete
                                        </PrimaryButton>
                                    </form>
                                </td> -->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>