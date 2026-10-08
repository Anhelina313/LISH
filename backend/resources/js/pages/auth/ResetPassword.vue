<script setup lang="ts">
import { computed, ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {
    Eye,
    EyeOff,
    LockKeyhole,
    Mail,
} from 'lucide-vue-next';

import AuthBase from '@/layouts/AuthLayout.vue';

const props = defineProps<{
    token: string;
    email: string;
}>();

const showPassword = ref(false);
const showPasswordConfirmation = ref(false);
const attemptedSubmit = ref(false);

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const passwordError = computed(() => {
    if (form.errors.password) {
        return form.errors.password;
    }

    if (attemptedSubmit.value && form.password === '') {
        return 'Password is required.';
    }

    if (
        attemptedSubmit.value &&
        form.password.length > 0 &&
        form.password.length < 8
    ) {
        return 'Password must contain at least 8 characters.';
    }

    return '';
});

const confirmationError = computed(() => {
    if (form.errors.password_confirmation) {
        return form.errors.password_confirmation;
    }

    if (
        attemptedSubmit.value &&
        form.password_confirmation === ''
    ) {
        return 'Password confirmation is required.';
    }

    if (
        form.password !== '' &&
        form.password_confirmation !== '' &&
        form.password !== form.password_confirmation
    ) {
        return 'Passwords do not match.';
    }

    return '';
});

const submit = () => {
    attemptedSubmit.value = true;

    if (passwordError.value || confirmationError.value) {
        return;
    }

    form.post(route('password.store'), {
        preserveScroll: true,

        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <Head title="Reset password" />

    <AuthBase
        title="Create new password"
        description="Choose a new password for your LISH account."
    >
        <div class="auth-card-label">
            New password
        </div>

        <form @submit.prevent="submit">

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
                        readonly
                        :class="{ 'input-error': form.errors.email }"
                    />
                </div>

                <p
                    v-if="form.errors.email"
                    class="field-error"
                >
                    {{ form.errors.email }}
                </p>
            </div>

            <!-- New password -->
            <div class="form-group">
                <label for="password">
                    New Password
                </label>

                <div class="input-wrapper">
                    <LockKeyhole
                        :size="17"
                        class="input-icon"
                    />

                    <input
                        id="password"
                        v-model="form.password"
                        :type="showPassword ? 'text' : 'password'"
                        autocomplete="new-password"
                        placeholder="Create a new password"
                        :class="{ 'input-error': passwordError }"
                        @input="form.clearErrors('password')"
                    />

                    <button
                        type="button"
                        class="password-toggle"
                        aria-label="Show or hide password"
                        @click="showPassword = !showPassword"
                    >
                        <EyeOff
                            v-if="showPassword"
                            :size="17"
                        />

                        <Eye
                            v-else
                            :size="17"
                        />
                    </button>
                </div>

                <p class="field-help">
                    Password must contain at least 8 characters.
                </p>

                <p
                    v-if="passwordError"
                    class="field-error"
                >
                    {{ passwordError }}
                </p>
            </div>

            <!-- Confirm password -->
            <div class="form-group">
                <label for="password_confirmation">
                    Confirm New Password
                </label>

                <div class="input-wrapper">
                    <LockKeyhole
                        :size="17"
                        class="input-icon"
                    />

                    <input
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        :type="showPasswordConfirmation ? 'text' : 'password'"
                        autocomplete="new-password"
                        placeholder="Confirm your new password"
                        :class="{ 'input-error': confirmationError }"
                        @input="form.clearErrors('password_confirmation')"
                    />

                    <button
                        type="button"
                        class="password-toggle"
                        aria-label="Show or hide password confirmation"
                        @click="showPasswordConfirmation = !showPasswordConfirmation"
                    >
                        <EyeOff
                            v-if="showPasswordConfirmation"
                            :size="17"
                        />

                        <Eye
                            v-else
                            :size="17"
                        />
                    </button>
                </div>

                <p
                    v-if="confirmationError"
                    class="field-error"
                >
                    {{ confirmationError }}
                </p>
            </div>

            <button
                type="submit"
                class="auth-submit"
                :disabled="form.processing"
            >
                {{
                    form.processing
                        ? 'Resetting password...'
                        : 'Reset password'
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
