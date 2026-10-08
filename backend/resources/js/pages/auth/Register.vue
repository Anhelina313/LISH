<script setup lang="ts">
import { computed, ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {
    CircleAlert,
    Eye,
    EyeOff,
    LockKeyhole,
    Mail,
    UserRound,
} from 'lucide-vue-next';

import AuthBase from '@/layouts/AuthLayout.vue';

const showPassword = ref(false);
const showPasswordConfirmation = ref(false);
const attemptedSubmit = ref(false);

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

const nameError = computed(() => {
    if (form.errors.name) {
        return form.errors.name;
    }

    if (attemptedSubmit.value && form.name.trim() === '') {
        return 'Full name is required.';
    }

    return '';
});

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

const passwordError = computed(() => {
    if (
        attemptedSubmit.value &&
        form.password === ''
    ) {
        return 'Password is required.';
    }

    if (
        attemptedSubmit.value &&
        form.password !== '' &&
        form.password.length < 8
    ) {
        return 'Password must contain at least 8 characters.';
    }

    if (form.errors.password) {
        return form.errors.password;
    }

    return '';
});

const confirmationError = computed(() => {
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

    if (form.errors.password_confirmation) {
        return form.errors.password_confirmation;
    }

    return '';
});

const termsError = computed(() => {
    if (form.errors.terms) {
        return form.errors.terms;
    }

    if (attemptedSubmit.value && !form.terms) {
        return 'You must accept the Terms of Service and Privacy Policy.';
    }

    return '';
});

const hasErrors = computed(() => {
    return Boolean(
        nameError.value ||
        emailError.value ||
        passwordError.value ||
        confirmationError.value ||
        termsError.value
    );
});

const submit = () => {
    attemptedSubmit.value = true;

    if (hasErrors.value) {
        return;
    }

    form.post(route('register'), {
        onFinish: () => {
            form.reset('password', 'password_confirmation');
        },
    });
};
</script>

<template>
    <Head title="Register" />

    <AuthBase
        title="Create account"
        description="Enter your details below to begin your personalized learning path."
    >
        <div class="auth-card-label">
            New student
        </div>

        <form @submit.prevent="submit">
            <!-- Error summary -->
            <div
                v-if="hasErrors"
                class="auth-error-summary"
            >
                <CircleAlert :size="17" />

                <span>
                    Please fix the errors below to continue.
                </span>
            </div>

            <!-- Full name -->
            <div class="form-group">
                <label for="name">
                    Full Name
                </label>

                <div class="input-wrapper">
                    <UserRound
                        :size="17"
                        class="input-icon"
                    />

                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        autocomplete="name"
                        placeholder="e.g., Alexander Smith"
                        :class="{ 'input-error': nameError }"
                        @input="form.clearErrors('name')"
                    />
                </div>

                <p
                    v-if="nameError"
                    class="field-error"
                >
                    {{ nameError }}
                </p>
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

            <!-- Password -->
            <div class="form-group">
                <label for="password">
                    Password
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
                        placeholder="Create a strong password"
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
                    Confirm Password
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
                        placeholder="Verify your password"
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

            <!-- Terms -->
            <div class="terms-row">
                <input
                    id="terms"
                    v-model="form.terms"
                    type="checkbox"
                    @change="form.clearErrors('terms')"
                />

                <label for="terms">
                    I agree to the
                    <a
                        href="#"
                        @click.prevent
                    >
                        Terms of Service
                    </a>
                    and
                    <a
                        href="#"
                        @click.prevent
                    >
                        Privacy Policy
                    </a>.
                </label>
            </div>

            <p
                v-if="termsError"
                class="field-error"
            >
                {{ termsError }}
            </p>

            <!-- Submit -->
            <button
                type="submit"
                class="auth-submit"
                :disabled="form.processing"
            >
                {{ form.processing ? 'Creating account...' : 'Create account' }}
            </button>

            <p class="required-message">
                * All fields are required to proceed.
            </p>
        </form>

        <div class="auth-footer">
            Already have an account?

            <Link :href="route('login')">
                Log in
            </Link>
        </div>
    </AuthBase>
</template>
