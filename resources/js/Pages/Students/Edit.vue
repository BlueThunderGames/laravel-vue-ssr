<script setup>
import { defineProps } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Head } from "@inertiajs/vue3";
import { usePage, useForm } from "@inertiajs/vue3";
import { watch, ref, onMounted } from "vue";

defineProps({
    classes: {
        type: Object,
        required: true,
    },
    student: {
        type: Object,
        required: true,
    }
});

let sections = ref({});
let student = usePage().props.student;

const form = useForm({
    name: student.name,
    email: student.email,
    class_id: student.class.id,
    section_id: student.section.id,
});

watch(
    () => form.class_id,
    (value) => {
        getSections(value);
    }
);

const getSections = (classId) => {
    axios.get("/api/sections?class_id=" + classId).then((response) => {
        sections.value = response.data;
    });
};

const updateStudent = () => {
    form.put(route("students.update"), {student: student.id});
    //form.put(route("students.update"), {student: props.student.id});
};

onMounted(() => {
    getSections(form.class_id);
});
</script>
<template>
    <Head title="Update Student" />
    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Update Student
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="px-8 py-8 bg-white">
                    <h3 class="font-bold">Student Information</h3>
                    <p>Use this form to edit this student.</p>
                    <form @submit.prevent="updateStudent" class="w-full mt-8">
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-name"
                                >
                                    Name
                                </label>
                                <input
                                    v-model="form.name"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    :class="{ 'border-red-500 ': form.errors.name }"
                                    id="grid-name"
                                    type="text"
                                    placeholder="Jane Doe"
                                />
                                <InputError
                                    :message="form.errors.name"
                                    class="mt-2 text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300"
                                />
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-email"
                                >
                                    Email
                                </label>
                                <input
                                    v-model="form.email"
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    :class="{ 'border-red-500 ': form.errors.email }"
                                    id="grid-email"
                                    type="email"
                                    placeholder="email@gmail.com"
                                />
                                <InputError
                                    :message="form.errors.email"
                                    class="mt-2 text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300"
                                />
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3 mb-6">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label
                                    for="grid-class-id"
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    >Choose a Class</label
                                >
                                <select
                                    v-model="form.class_id"
                                    name="class-id"
                                    id="grid-class"
                                    class="w-full block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    :class="{ 'border-red-500 ': form.errors.class_id }"
                                >
                                    <option value="" disabled selected>
                                        Choose a Class
                                    </option>
                                    <option
                                        v-for="item in classes.data"
                                        :key="item.id"
                                        :value="item.id"
                                    >
                                        {{ item.name }}
                                    </option>
                                </select>
                                <InputError
                                    :message="form.errors.class_id"
                                    class="mt-2 text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300"
                                />
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label
                                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                                    for="grid-section"
                                    >Choose a Section</label
                                >
                                <select
                                    v-model="form.section_id"
                                    name="section"
                                    id="grid-section"
                                    class="w-full appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    :class="{ 'border-red-500 ': form.errors.section_id }"
                                >
                                    <option value="" disabled selected>
                                        Select a Section
                                    </option>
                                    <option
                                        v-for="section in sections.data"
                                        :key="section.id"
                                        :value="section.id"
                                    >
                                        {{ section.name }}
                                    </option>
                                </select>
                                <InputError
                                    :message="form.errors.section_id"
                                    class="mt-2 text-red-900 focus:ring-red-500 focus:border-red-500 border-red-300"
                                />
                            </div>
                        </div>
                        <div class="flex justify-center text-center py-6">
                            <button
                                class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow"
                                type="submit"
                            >
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
