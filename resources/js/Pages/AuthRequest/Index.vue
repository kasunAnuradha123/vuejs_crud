<script setup lang="ts">
    import NavLink from '@/Components/NavLink.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { AuthRequest } from '@/types';
    import { Head } from '@inertiajs/vue3';


    defineProps<{
        authRequests?: AuthRequest[];

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
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 shadow  ">
                <div class="overflow-auto bg-white shadow-sm sm:rounded-lg">
                    <dev class=" grid grid-cols-2">
                        <div class="px-6 py-4">
                            <!-- <ResponsiveNavLink :href="route('profile.edit')">
                            Profile
                        </ResponsiveNavLink> -->
                            <!-- <NavLink :href="route('user.create')" class="text-black bg-indigo-300 rounded-md px-2 ">
                                Add Users
                            </NavLink> -->
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
                                    Browser
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Remark
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Session
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>

                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="authRequest in authRequests" :key="authRequest.id">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ authRequest?.user?.name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ authRequest.user?.email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ authRequest.browser }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ authRequest.remark }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span v-if="authRequest.approval == 1" class="text-green-500">Active</span>
                                    <span v-else class="text-red-500">Inactive</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span v-if="authRequest.is_confirm == 1" class="text-green-500">Used</span>
                                    <span v-else class="text-red-500">not use</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <NavLink :href="route('auth_request.update', {
                                        id: authRequest.id
                                        , type: 1
                                    })" method="post" as="button"
                                        class="text-white mx-auto px-5 bg-blue-500 rounded-md">
                                        Active
                                    </NavLink>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <NavLink :href="route('auth_request.update', { id: authRequest.id, type: 0 })"
                                        method="post" as="button" class="text-white mx-auto bg-red-500 rounded-md px-4">
                                        Inactive 
                                    </NavLink>
                                </td>




                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>