<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import type { User } from '@/types';

defineProps<{
    user: User;
}>();
</script>

<template>
    <Head title="Student Dashboard" />

    <main class="page">
        <h1>Student Dashboard</h1>

        <p>
            Welcome, {{ user.name }}!
        </p>

        <Link
            :href="route('logout')"
            method="post"
            as="button"
            class="btn"
        >
            Log out
        </Link>
    </main>
</template>
