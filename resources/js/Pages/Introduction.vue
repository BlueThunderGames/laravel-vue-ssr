<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Introduction" />

    <GuestLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Student Management App
            </h2>
        </template>
        <div class="credentials-wrapper pb-6">
                <div className="intro-upper mb-6">
                    <h3 className="text-lg font-bold mb-4">Welcome to my Student Management App driven by Laravel and Vue3</h3>
                    <p>This application allows you to create Students and assign them to Classes/Sections. It features a Search System, Pagination, as well as basic CRUD functionality</p>
                </div>
                <div class="mb-4">
                    <h3 class="font-bold">Test the Application</h3>
                    <p>You can login to the application with the following credentials:</p>
                </div>
                <div class="credential mb-6">
                    <p>Email: admin@admin.com</p> 
                    <p>Password: password</p>
                </div>
                <Link
                    :href="route('login')"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    >Click Here to Login</Link
                >
            </div>
    </GuestLayout>
</template>