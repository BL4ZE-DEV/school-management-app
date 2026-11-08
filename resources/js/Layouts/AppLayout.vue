<script setup>
import {
    Link,
    router,
    usePage
} from '@inertiajs/vue3';

import { computed } from 'vue';

defineProps({
    title: {
        type: String,
        default: 'Dashboard',
    },
});

const page = usePage();

const user = computed(() => {
    return page.props.auth?.user;
});

const roles = computed(() => {
    return user.value?.roles ?? [];
});

const hasRole = (role) => {
    return roles.value.includes(role);
};

const isAdmin = computed(() => {
    return (
        hasRole('Tenant Admin') ||
        hasRole('Principal') ||
        hasRole('Vice Principal')
    );
});

const isTeacher = computed(() => {
    return hasRole('Teacher');
});

const isBursar = computed(() => {
    return hasRole('Bursar');
});

const isStudent = computed(() => {
    return hasRole('Student');
});

const logout = () => {
    router.post('/logout');
};
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <div class="flex min-h-screen">

            <!-- Sidebar -->
            <aside
                class="w-64 bg-gray-900 text-white hidden md:flex flex-col"
            >
                <div class="px-6 py-6 border-b border-gray-800">
                    <h1 class="font-bold text-xl">
                        School MS
                    </h1>
                </div>

                <nav class="flex-1 px-4 py-6 space-y-2">

                    <Link
                        href="/dashboard"
                        class="block rounded-lg px-4 py-3 hover:bg-gray-800"
                    >
                        Dashboard
                    </Link>

                    <!-- Admin links -->
                    <template v-if="isAdmin">

                        <Link
                            href="/students"
                            class="block rounded-lg px-4 py-3 hover:bg-gray-800"
                        >
                            Students
                        </Link>

                        <Link
                            href="/teachers"
                            class="block rounded-lg px-4 py-3 hover:bg-gray-800"
                        >
                            Teachers
                        </Link>

                        <Link
                            href="/classes"
                            class="block rounded-lg px-4 py-3 hover:bg-gray-800"
                        >
                            Classes
                        </Link>

                        <Link
                            href="/subjects"
                            class="block rounded-lg px-4 py-3 hover:bg-gray-800"
                        >
                            Subjects
                        </Link>

                    </template>

                    <!-- Admin + Teacher -->
                    <template v-if="isAdmin || isTeacher">

                        <Link
                            href="/attendance"
                            class="block rounded-lg px-4 py-3 hover:bg-gray-800"
                        >
                            Attendance
                        </Link>

                        <Link
                            href="/results"
                            class="block rounded-lg px-4 py-3 hover:bg-gray-800"
                        >
                            Results
                        </Link>

                    </template>

                    <!-- Admin + Bursar -->
                    <template v-if="isAdmin || isBursar">

                        <Link
                            href="/bursary"
                            class="block rounded-lg px-4 py-3 hover:bg-gray-800"
                        >
                            Bursary
                        </Link>

                    </template>

                    <!-- Student -->
                    <template v-if="isStudent">

                        <Link
                            href="/my-results"
                            class="block rounded-lg px-4 py-3 hover:bg-gray-800"
                        >
                            My Results
                        </Link>

                        <Link
                            href="/my-attendance"
                            class="block rounded-lg px-4 py-3 hover:bg-gray-800"
                        >
                            My Attendance
                        </Link>

                        <Link
                            href="/my-fees"
                            class="block rounded-lg px-4 py-3 hover:bg-gray-800"
                        >
                            My Fees
                        </Link>

                    </template>

                </nav>

                <div class="p-4 border-t border-gray-800">
                    <button
                        @click="logout"
                        class="w-full text-left px-4 py-3 rounded-lg hover:bg-gray-800"
                    >
                        Logout
                    </button>
                </div>
            </aside>

            <!-- Main -->
            <main class="flex-1">

                <header
                    class="bg-white border-b px-6 py-4 flex items-center justify-between"
                >
                    <h2
                        class="text-xl font-semibold text-gray-900"
                    >
                        {{ title }}
                    </h2>

                    <div
                        v-if="user"
                        class="text-right"
                    >
                        <p class="font-medium text-gray-900">
                            {{ user.first_name }}
                            {{ user.last_name }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ user.roles.join(', ') }}
                        </p>
                    </div>
                </header>

                <div class="p-6">
                    <slot />
                </div>

            </main>

        </div>
    </div>
</template>