<script setup>
defineProps({
    data: {
        type: Object,
        required: true,
    },
    updatedPageNumber:
    {
        type: Function,
        required: true,
    }
})

</script>
<template>
    <div class="mt-10 bg-white shadow-md rounded-xl bg-clip-border">
        <div class="flex flex-wrap justify-between items-center px-4 py-3">
            <div class="text-sm text-slate-500 max-lg:w-[100%] max-lg:text-center max-lg:mb-2">
                <div class="has-results" v-if="data.meta.from && data.meta.to">
                    Showing <b>{{ data.meta.from}}-{{ data.meta.to }}</b> of {{ data.meta.total }}
                </div>
                <div class="no-results" v-else>
                    No results found
                </div>
            </div>
            <div class="flex max-md:flex-wrap space-x-1 max-lg:w-[100%] max-lg:text-center max-lg:justify-center">
            <button 
                @click.prevent="updatedPageNumber(link)"
                v-for="(link, index) in data.meta.links" 
                :key="index"
                :disabled="link.active || !link.url"
                class="relative inline-flex items-center px-4 py-2 mb-2 border text-sm font-medium"
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