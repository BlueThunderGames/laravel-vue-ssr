<script setup>
import { usePage} from '@inertiajs/vue3';
import {router} from '@inertiajs/vue3';

defineProps({
    data: {
        type: Object,
        required: true,
    },
})
const page = usePage();

const updatePageNumber = (link) => {
    let pageNumber = link.url.split('=')[1];
    router.visit('/students/?page=' + pageNumber, {preserveScroll: true});
}
</script>
<template>
    <div class="mt-10 bg-white shadow-md rounded-xl bg-clip-border">
        <div class="flex justify-between items-center px-4 py-3">
            <div class="text-sm text-slate-500">
            Showing <b>{{ data.meta.from}}-{{ data.meta.to }}</b> of {{ data.meta.total }}
            </div>
            <div class="flex space-x-1">
            <button 
                @click.prevent="updatePageNumber(link)"
                v-for="(link, index) in data.meta.links" 
                :key="index"
                :disabled="link.active || !link.url"
                class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                :class="{
                    'z-19 bg-indigo-50 border-indigo-500 text-indigo-600': link.active,
                    'bg-white border-gray-300 text-gray-500 hover:bg-gray-50': !link.active,
                }"
            >
                <span v-html="link.label"></span>
            </button>
            </div>
        </div>
    </div>
</template>