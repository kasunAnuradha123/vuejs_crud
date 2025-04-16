<script setup lang="ts">
    import NavLink from '@/Components/NavLink.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { User } from '@/types';
    import { Head } from '@inertiajs/vue3';


    defineProps<{
        users?: User[];
    }>();

</script>

<template>

    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Users
            </h2>
        </template>

        <div class="py-12 shadow-sm bg-blue-100 rounded-sm">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 shadow  " >
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <dev class=" grid grid-cols-2">
                        <div class="px-6 py-4">
                            <!-- <ResponsiveNavLink :href="route('profile.edit')">
                            Profile
                        </ResponsiveNavLink> -->
                            <NavLink :href="route('user.create')" class="text-black bg-indigo-300 rounded-md px-2 ">
                                Add Users
                            </NavLink>
                        </div>
                    </dev>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
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
                                    <div class="grid grid-cols-2">
                                        <NavLink :href="route('user.edit', { id: user.id })" method="get"
                                            as="button" class="text-white mx-auto px-5 bg-blue-500 rounded-md">
                                            Edit
                                        </NavLink>
                                        <NavLink :href="route('user.delete', { id: user.id })" method="delete"
                                            as="button" class="text-white mx-auto bg-red-500 rounded-md px-4">
                                            Delete
                                        </NavLink>
                                    </div>

                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>