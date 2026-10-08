<script setup lang="ts">
import { computed, ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { Mail } from 'lucide-vue-next';

import AuthBase from '@/layouts/AuthLayout.vue';

defineProps<{
    status?: string;
}>();

const attemptedSubmit = ref(false);

const form = useForm({
    email: '',
});

const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

const emailError = computed(() => {
    if (form.errors.email) {
        return form.errors.email;
    }

    if (attemptedSubmit.value && form.email.trim() === '') {
        return 'Email address is required.';
    }

    if (
        attemptedSubmit.value &&
        form.email.trim() !== '' &&
        !emailPattern.test(form.email)
    ) {
        return 'Please enter a valid email address.';
    }

    return '';
});

const submit = () => {
    attemptedSubmit.value = true;

    if (emailError.value) {
        return;
    }

    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot password" />

    <AuthBase
        title="Forgot password?"
        description="Enter your email address and we will send you a password reset link."
    >
        <div class="auth-card-label">
            Reset password
        </div>

        <form @submit.prevent="submit">
            <div
                v-if="status"
                class="alert alert-success"
            >
                {{ status }}
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">
                    Email Address
                </label>

                <div class="input-wrapper">
                    <Mail
                        :size="17"
                        class="input-icon"
                    />

                    <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        autocomplete="email"
                        autofocus
                        placeholder="student@gmail.com"
                        :class="{ 'input-error': emailError }"
                        @input="form.clearErrors('email')"
                    />
                </div>

                <p
                    v-if="emailError"
                    class="field-error"
                >
                    {{ emailError }}
                </p>
            </div>

            <button
                type="submit"
                class="auth-submit"
                :disabled="form.processing"
            >
                {{
                    form.processing
                        ? 'Sending reset link...'
                        : 'Send reset link'
                }}
            </button>
        </form>

        <div class="auth-footer">
            Remember your password?

            <Link :href="route('login')">
                Back to log in
            </Link>
        </div>
    </AuthBase>
</template>
