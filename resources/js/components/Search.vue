<template>
    <div class="relative">
        <input
            type="text"
            id="search"
            class="shadow-md w-full px-3 py-2 rounded-lg pl-10 h-10"
            :class="{ 'mt-2 shadow-md px-3 py-2 border rounded-lg pl-10': isSmall }"
            :placeholder="placeholderText"
            @input="$emit('update:search', $event.target.value)"
        />
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="gray"
                class="icon w-6 h-6"
                :class="{'-mb-2': isSmall}"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                />
            </svg>
        </div>
    </div>
</template>

<script setup lang="ts">
  import { defineProps } from 'vue';

  const props = defineProps({
    placeholderText: {
      type: String,
      default: 'Search user'
    },
    isSmall: {
      type: Boolean,
      default: false
    }
  });
</script>