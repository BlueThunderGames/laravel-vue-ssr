<script setup>
import { defineProps, ref, computed, watch } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import Pagination from "@/Components/Pagination.vue";
import { Link } from "@inertiajs/vue3";
import { useForm, router } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";

defineProps({
    students: {
        type: Object,
        required: true,
    },
    search: {
        type: String,
        required: false,
    },
    class_id: {
        type: String,
        required: false,
    },
    classes: {
        type: Object,
        required: true,
    },
});

let search = ref(usePage().props.search),
    pageNumber = ref(1),
    class_id = ref(usePage().props.class_id);

let studentsUrl = computed(() => {
    let url = new URL(route("students.index"));
    url.searchParams.append("page", pageNumber.value);

    if (search.value) {
        url.searchParams.append("search", search.value);
    }

    if (class_id.value) {
        url.searchParams.append("class_id", class_id.value);
    }

    return url;
});

const deleteForm = useForm({});

const deleteStudent = (studentId) => {
    if (confirm("Are you sure you want to delete this student?")) {
        deleteForm.delete(route("students.destroy", studentId), {
            preserveScroll: true,
            onSuccess: () => {},
        });
    }
};

const updatedPageNumber = (link) => {
    pageNumber.value = link.url.split("=")[1];
};

watch(
    () => search.value,
    (value) => {
        if (value) {
            pageNumber.value = 1;
        }
    }
);

watch(
    () => class_id.value,
    (value) => {
        if (value) {
            pageNumber.value = 1;
            console.log(value);
        }
    }
);

watch(
    () => studentsUrl.value,
    (updatedStudentsUrl) => {
        router.visit(updatedStudentsUrl, {
            preserveScroll: true,
            preserveState: true,
            replace: true,
        });
    }
);
</script>

<template>
    <Head title="Students" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Students
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl px-6 lg:px-8">
                <div class="upper-wrapper flex justify-between">
                    <div class="search-wrapper py-3 w-6/12">
                        <h4 class="font-bold mb-2">Students</h4>
                        <p>A list of all of the Students.</p>
                        <form
                            @submit.prevent="searchStudents()"
                            class="pt-4 w-full mb-4"
                        >
                            <div class="flex">
                                <label
                                    for="search-dropdown"
                                    class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white"
                                    >Search Students by Name or Email</label
                                >
                                <div class="relative w-full lg:flex lg:gap-4">
                                    <input
                                        type="search"
                                        id="search-dropdown"
                                        class="block p-2.5 lg:w-7/12 max-lg:w-[260px] max-lg:mb-4 z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                                        placeholder="Search Students by Name or Email"
                                        required
                                        v-model="search"
                                    />
                                    <select v-model="class_id" name="class" id="class" class="block p-2.5 lg:w-5/12 max-lg:w-[260px] z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500">
                                    <option value="">Filter by Class</option>
                                    <option
                                        v-for="classItem in classes.data"
                                        :key="classItem.id"
                                        :value="classItem.id"
                                    >
                                        {{ classItem.name }}
                                    </option>
                                </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div
                        class="links-wrapper py-3 flex justify-end items-start"
                    >
                        <Link
                            :href="route('students.create')"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            >Create Student</Link
                        >
                    </div>
                </div>

                <div
                    class="overflow-auto lg:overflow-visible bg-white shadow-md rounded-xl bg-clip-border"
                >
                    <table class="table text-gray-400 space-y-6 text-sm w-full">
                        <thead class="text-gray-500">
                            <tr>
                                <th
                                    class="p-3 border-b border-blue-gray-100 bg-blue-gray-50 text-center max-lg:hidden"
                                >
                                    ID
                                </th>
                                <th
                                    class="p-3 border-b border-blue-gray-100 bg-blue-gray-50 text-center"
                                >
                                    Name
                                </th>
                                <th
                                    class="p-3 border-b border-blue-gray-100 bg-blue-gray-50 text-center max-lg:hidden"
                                >
                                    Email
                                </th>
                                <th
                                    class="p-3 border-b border-blue-gray-100 bg-blue-gray-50 text-center"
                                >
                                    Class
                                </th>
                                <th
                                    class="p-3 border-b border-blue-gray-100 bg-blue-gray-50 text-center"
                                >
                                    Section
                                </th>
                                <th
                                    class="p-3 border-b border-blue-gray-100 bg-blue-gray-50 text-center max-lg:hidden"
                                >
                                    Date Added
                                </th>
                                <th
                                    class="p-3 border-b border-blue-gray-100 bg-blue-gray-50 text-center"
                                >
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="student in students.data"
                                :key="student.id"
                                class="bg-white"
                            >
                                <td
                                    class="p-3 border-b border-blue-gray-50 text-center max-lg:hidden"
                                >
                                    {{ student.id }}
                                </td>
                                <td
                                    class="p-3 border-b border-blue-gray-50 text-center"
                                >
                                    {{ student.name }}
                                </td>
                                <td
                                    class="p-3 border-b border-blue-gray-50 text-center max-lg:hidden"
                                >
                                    {{ student.email }}
                                </td>
                                <td
                                    class="p-3 border-b border-blue-gray-50 text-center"
                                >
                                    {{ student.class.name }}
                                </td>
                                <td
                                    class="p-3 border-b border-blue-gray-50 text-center"
                                >
                                    {{ student.section.name }}
                                </td>
                                <td
                                    class="p-3 border-b border-blue-gray-50 text-center max-lg:hidden"
                                >
                                    {{ student.created_at }}
                                </td>
                                <td
                                    class="p-3 border-b border-blue-gray-50 text-center"
                                >
                                    <Link
                                        :href="
                                            route('students.edit', student.id)
                                        "
                                        class="mr-2 hover:text-blue-700"
                                        >Edit</Link
                                    >
                                    <button
                                        @click="deleteStudent(student.id)"
                                        href="#"
                                        class="hover:text-red-700"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Pagination
                    :data="students"
                    :updatedPageNumber="updatedPageNumber"
                ></Pagination>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
