<script setup lang="ts">
import type { PropType } from 'vue'
import AccountSidebar from '@/components/account/AccountSidebar.vue'

type User = {
    name: string
    email: string
    profile_photo_path?: string | null
}

defineProps({
    user: {
        type: Object as PropType<User>,
        required: true,
    },

    role: {
        type: String,
        required: true,
    },
})
</script>

<template>
    <div class="account-layout">

        <!-- Top navigation -->
        <header class="site-header">
            <div class="site-logo">
                LISH
            </div>

            <nav class="site-nav">
                <a href="/">Home</a>
                <a href="#">Courses</a>
                <a href="#">About LISH</a>
                <a href="#">Contact</a>
                <a href="#">FAQ</a>
            </nav>

            <div class="profile-small">
                {{ user.name.charAt(0).toUpperCase() }}
            </div>
        </header>


        <!-- Account area -->
        <div class="dashboard">

            <AccountSidebar :role="role" />

            <!-- Account header -->
            <header class="dashboard-header">
                <div>
                    <p class="page-label">
                        {{ role }} dashboard
                    </p>

                    <h1>
                        Welcome back, {{ user.name }}
                    </h1>

                    <p class="page-description">
                        Let's start
                    </p>
                </div>

                <div class="profile">
                    <strong>{{ user.name }}</strong>

                    <img
                        v-if="user.profile_photo_path"
                        :src="`/storage/${user.profile_photo_path}`"
                        :alt="user.name"
                    >

                    <div
                        v-else
                        class="profile-placeholder"
                    >
                        {{ user.name.charAt(0).toUpperCase() }}
                    </div>
                </div>
            </header>


            <!-- Page content -->
            <main class="dashboard-content">
                <slot />
            </main>

        </div>
    </div>
</template>
