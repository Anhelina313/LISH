<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="LISH" />

    <main class="welcome-page">
        <div class="welcome-content">
            <span class="welcome-label">
                English learning platform
            </span>

            <h1 class="welcome-title">
                LISH
            </h1>

            <p class="welcome-text">
                Learn English, build confidence and continue your learning journey.
            </p>

            <div class="welcome-actions">
                <Link
                    :href="route('register')"
                    class="welcome-button"
                >
                    Register
                </Link>

                <Link
                    :href="route('login')"
                    class="welcome-button welcome-button-secondary"
                >
                    Log in
                </Link>
            </div>
        </div>
    </main>
</template>

<style scoped>
.welcome-page {
    min-height: 100vh;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 40px 20px;

    background: var(--lish-purple);
}

.welcome-content {
    width: 100%;
    max-width: 650px;

    text-align: center;
}

.welcome-label {
    display: block;

    margin-bottom: 18px;

    color: var(--lish-cyan);

    font-size: 11px;
    font-weight: 800;

    letter-spacing: 3px;
    text-transform: uppercase;
}

.welcome-title {
    margin: 0 0 20px;

    color: var(--lish-cyan);

    font-family: var(--font-heading);
    font-size: clamp(72px, 12vw, 120px);
    line-height: 1;
}

.welcome-text {
    max-width: 520px;

    margin: 0 auto 36px;

    color: var(--lish-white);

    font-size: 16px;
    line-height: 1.6;
}

.welcome-actions {
    display: flex;
    align-items: center;
    justify-content: center;

    gap: 16px;

    flex-wrap: wrap;
}

.welcome-button {
    min-width: 150px;
    min-height: 48px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 12px 24px;

    background: var(--lish-cyan);
    color: var(--lish-white);

    border: 2px solid var(--lish-cyan);
    border-radius: 8px;

    font-size: 14px;
    font-weight: 700;

    text-decoration: none;

    transition:
        background 0.2s ease,
        color 0.2s ease,
        border-color 0.2s ease,
        transform 0.2s ease;
}

.welcome-button:hover {
    background: var(--lish-white);
    color: var(--lish-purple);

    border-color: var(--lish-white);

    transform: translateY(-2px);
}

.welcome-button-secondary {
    background: transparent;
    color: var(--lish-white);

    border-color: var(--lish-white);
}

.welcome-button-secondary:hover {
    background: var(--lish-white);
    color: var(--lish-purple);
}


/* Mobile */
@media (max-width: 600px) {
    .welcome-page {
        padding: 30px 16px;
    }

    .welcome-title {
        font-size: 64px;
    }

    .welcome-text {
        font-size: 14px;
    }

    .welcome-actions {
        flex-direction: column;
    }

    .welcome-button {
        width: 100%;
        max-width: 280px;
    }
}
</style>
