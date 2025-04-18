<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import { User } from '@/types';

const props = defineProps<{
    userData: User,
    type: string
}>();

const form = useForm({
    id: props.userData.id ?? '',
    name: props.userData.name ?? '',
    email: props.userData.email ?? '',
    mark: String(props.userData.mark ?? 0),
});
</script>

<template>
    <Head title="Create User" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                User Create
            </h2>
        </template>

        <form
            @submit.prevent="form.post(route('user.update', { id: form.id }))"
            class="grid grid-cols-2 gap-4 max-w-lg mt-10 p-5 bg-white shadow-sm sm:rounded-lg"
        >
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" autofocus autocomplete="name" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput id="email" type="text" class="mt-1 block w-full" v-model="form.email" autocomplete="email" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>  
            <div>
                <InputLabel for="mark" value="Mark" />
                <TextInput id="mark" type="number" class="mt-1 block w-full" v-model="form.mark" autocomplete="mark" />
                <InputError class="mt-2" :message="form.errors.mark" />
            </div>
            <div></div>
            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">
                        Saved.
                    </p>
                </Transition>
            </div>
        </form>
    </AuthenticatedLayout>
</template>