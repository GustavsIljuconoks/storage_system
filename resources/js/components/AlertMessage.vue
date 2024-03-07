<template>
    <div v-if="show && message" :class="alertClasses" role="alert">
        <span class="font-medium">{{ message }}</span>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    message: {
        type: String,
        required: true,
    },
    show: {
        type: Boolean,
        required: true,
    },
    type: {
        type: String,
        default: 'info',
        validator: (value) => ['success', 'error', 'warning', 'info'].includes(value),
    },
});

const alertClasses = computed(() => {
    return {
        'p-4 mb-4 text-sm rounded-lg': true,
        'text-green-800 bg-green-50 dark:bg-gray-800 dark:text-green-400': props.type === 'success',
        'text-red-800 bg-red-50': props.type === 'error',
        'text-yellow-800 bg-yellow-50': props.type === 'warning',
        'text-blue-800 bg-blue-50 dark:bg-gray-800 dark:text-blue-400': props.type === 'info',
    };
});
</script>