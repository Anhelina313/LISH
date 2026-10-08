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

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const showPassword = ref(false);

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const loginError = computed(() => {
    return form.errors.email || form.errors.password;
});

const canSubmit = computed(() => {
    return (
        form.email.trim() !== '' &&
        form.password !== '' &&
        !form.processing
    );
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <Head title="Log in" />

    <AuthBase
        title="Log in to your account"
        description="Enter your email and password below to log in."
    >
        <div class="auth-card-label">
            Welcome back
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
                        placeholder="email@example.com"
                        :class="{ 'input-error': loginError }"
                    />
                </div>

                <p
                    v-if="loginError"
                    class="field-error"
                >
                    {{ loginError }}
                </p>
            </div>

            <!-- Password -->
            <div class="form-group">
                <div class="login-password-header">
                    <label for="password">
                        Password
                    </label>

                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                    >
                        Forgot password?
                    </Link>
                </div>

                <div class="input-wrapper">
                    <LockKeyhole
                        :size="17"
                        class="input-icon"
                    />

                    <input
                        id="password"
                        v-model="form.password"
                        :type="showPassword ? 'text' : 'password'"
                        autocomplete="current-password"
                        placeholder="Password"
                        :class="{ 'input-error': loginError }"
                    />

                    <button
                        type="button"
                        class="password-toggle"
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

                <p
                    v-if="loginError"
                    class="field-error"
                >
                    {{ loginError }}
                </p>
            </div>

            <!-- Remember -->
            <div class="remember-row">
                <input
                    id="remember"
                    v-model="form.remember"
                    type="checkbox"
                />

                <label for="remember">
                    Remember me
                </label>
            </div>

            <button
                type="submit"
                class="auth-submit"
                :disabled="!canSubmit"
            >
                {{ form.processing ? 'Logging in...' : 'Log in' }}
            </button>
        </form>

        <div class="auth-footer">
            Don't have an account?

            <Link :href="route('register')">
                Sign up
            </Link>
        </div>
    </AuthBase>
</template>
