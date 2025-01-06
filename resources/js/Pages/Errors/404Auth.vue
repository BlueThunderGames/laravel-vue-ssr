<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <Head title="Page Not Found" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Page Not Found
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div
                    class="overflow-hidden bg-white sm:rounded-lg p-6"
                >
                    <h1 class="text-2xl font-semibold text-gray-800">404</h1>
                    <p>The page you've requested could not be found!</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
