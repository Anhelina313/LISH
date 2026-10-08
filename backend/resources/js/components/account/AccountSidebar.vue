<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'

defineProps({
    role: {
        type: String,
        required: true,
    },
})

const page = usePage()

const isActive = (path: string): boolean => {
    return page.url.startsWith(path)
}
</script>

<template>
    <aside class="dashboard-nav">

        <!-- Student navigation -->
        <template v-if="role === 'student'">
            <Link
                href="/student/dashboard"
                :class="{ active: isActive('/student/dashboard') }"
            >
                Dashboard
            </Link>

            <span class="nav-disabled">
                My Lessons
            </span>
        </template>

        <!-- Teacher navigation -->
        <template v-if="role === 'teacher'">
            <Link
                href="/teacher/dashboard"
                :class="{ active: isActive('/teacher/dashboard') }"
            >
                Dashboard
            </Link>

            <span class="nav-disabled">
                My Students
            </span>
        </template>

        <!-- Shared navigation -->
        <span class="nav-disabled">
            Calendar
        </span>

        <span class="nav-disabled">
            Classroom
        </span>

        <div class="nav-bottom">
            <Link
                href="/settings/profile"
                :class="{ active: isActive('/settings') }"
            >
                Account Settings
            </Link>

            <Link
                href="/logout"
                method="post"
                as="button"
                class="nav-signout"
            >
                Sign Out
            </Link>
        </div>
    </aside>
</template>
