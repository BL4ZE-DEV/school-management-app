<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';

const props = defineProps({
    dashboard: Object,
});
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout title="Dashboard">

        <div class="space-y-6">

            <div>
                <h1
                    class="text-2xl font-bold text-gray-900"
                >
                    Welcome back
                </h1>

                <p class="text-gray-500 mt-1">
                    Here's what's happening in your school.
                </p>
            </div>

            <div
                v-if="dashboard.statistics"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4"
            >
                <div
                    v-for="(value, key) in dashboard.statistics"
                    :key="key"
                    class="bg-white rounded-xl border p-5"
                >
                    <p
                        class="text-sm text-gray-500 capitalize"
                    >
                        {{
                            key
                                .replaceAll('_', ' ')
                        }}
                    </p>

                    <p
                        class="text-2xl font-bold text-gray-900 mt-2"
                    >
                        {{ value }}
                    </p>
                </div>
            </div>

        </div>

    </AppLayout>
</template>