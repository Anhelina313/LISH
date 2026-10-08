<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <main class="auth-page">
        <div class="auth-wrapper">
            <Link
                :href="route('home')"
                class="auth-brand"
            >
                LISH
            </Link>

            <div class="auth-intro">
                <h1 v-if="title">
                    {{ title }}
                </h1>

                <p v-if="description">
                    {{ description }}
                </p>
            </div>

            <div class="auth-card">
                <slot />
            </div>
        </div>
    </main>
</template>
