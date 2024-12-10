<script setup>
import { defineProps} from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3'
import Pagination from '@/Components/Pagination.vue';
import { Link } from '@inertiajs/vue3'


defineProps({
    students: {
        type: Object,
        required: true,
    },
});

const page = usePage();
</script>

<template>
    <Head title="Students" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800"
            >
                Students
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="links-wrapper py-3 flex justify-end">
                    <Link :href="route('students.create')" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create Student</Link>
                </div>
                <div class="overflow-auto lg:overflow-visible bg-white shadow-md rounded-xl bg-clip-border">
                    <table class="table text-gray-400 space-y-6 text-sm w-full">
                        <thead class="text-gray-500 ">
                            <tr>
                                <th class="p-3 border-b border-blue-gray-100 bg-blue-gray-50 text-center">ID</th>
                                <th class="p-3 border-b border-blue-gray-100 bg-blue-gray-50 text-center">Name</th>
                                <th class="p-3 border-b border-blue-gray-100 bg-blue-gray-50 text-center">Email</th>
                                <th class="p-3 border-b border-blue-gray-100 bg-blue-gray-50 text-center">Class</th>
                                <th class="p-3 border-b border-blue-gray-100 bg-blue-gray-50 text-center">Section</th>
                                <th class="p-3 border-b border-blue-gray-100 bg-blue-gray-50 text-center">Date Added</th>
                                <th class="p-3 border-b border-blue-gray-100 bg-blue-gray-50 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="student in students.data" :key="student.id" class="bg-white">
                                <td class="p-3 border-b border-blue-gray-50 text-center">
                                    {{ student.id }}
                                </td>
                                <td class="p-3 border-b border-blue-gray-50 text-center">
                                    {{ student.name }}
                                </td>
                                <td class="p-3 border-b border-blue-gray-50 text-center">
                                    {{ student.email }}
                                </td>
                                <td class="p-3 border-b border-blue-gray-50 text-center">
                                    {{ student.class.name }}
                                </td>
                                <td class="p-3 border-b border-blue-gray-50 text-center">
                                    {{ student.section.name }}
                                </td>
                                <td class="p-3 border-b border-blue-gray-50 text-center">
                                    {{ student.created_at }}
                                </td>
                                <td class="p-3 border-b border-blue-gray-50 text-center">
                                    <Link :href="route('students.edit', student.id)" class="mr-2">Edit</Link>
                                    <a href="#">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Pagination :data="students"></Pagination>
            </div>
        </div>
        
    </AuthenticatedLayout>
</template>