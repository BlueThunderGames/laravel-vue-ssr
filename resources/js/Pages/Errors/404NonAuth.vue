<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Page Not Found" />

    <GuestLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Page Not Found
            </h2>
        </template>
        <h1 class="text-2xl font-semibold text-gray-800">404</h1>
        <p>The page you've requested could not be found!</p>         
    </GuestLayout>
</template>
