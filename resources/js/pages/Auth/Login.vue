<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post('/login', {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <Head title="Login" />

    <div
        class="min-h-screen flex items-center justify-center bg-gray-100 px-4"
    >
        <div
            class="w-full max-w-md bg-white rounded-xl shadow-sm p-8"
        >
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">
                    School Management
                </h1>

                <p class="text-gray-500 mt-2">
                    Sign in to continue
                </p>
            </div>

            <form
                @submit.prevent="submit"
                class="space-y-5"
            >
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >
                        Email
                    </label>

                    <input
                        v-model="form.email"
                        type="email"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none focus:ring-2 focus:ring-gray-900"
                    >

                    <p
                        v-if="form.errors.email"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.email }}
                    </p>
                </div>

                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 mb-1"
                    >
                        Password
                    </label>

                    <input
                        v-model="form.password"
                        type="password"
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 outline-none focus:ring-2 focus:ring-gray-900"
                    >

                    <p
                        v-if="form.errors.password"
                        class="text-red-500 text-sm mt-1"
                    >
                        {{ form.errors.password }}
                    </p>
                </div>

                <label class="flex items-center gap-2">
                    <input
                        v-model="form.remember"
                        type="checkbox"
                    >

                    <span class="text-sm text-gray-600">
                        Remember me
                    </span>
                </label>

                <button
                    type="submit"
                    :disabled="form.processing"
                    class="w-full rounded-lg bg-gray-900 text-white py-3 font-medium disabled:opacity-50"
                >
                    {{
                        form.processing
                            ? 'Signing in...'
                            : 'Sign In'
                    }}
                </button>
            </form>
        </div>
    </div>
</template>