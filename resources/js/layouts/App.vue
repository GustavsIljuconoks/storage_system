<template>
    <main class="mx-auto max-w-7xl items-center justify-between p-6 lg:px-8">
        <router-view></router-view>
    </main>
</template>

<script setup lang="ts">
    import axios from "axios";
    import {useRouter} from "vue-router";
</script>
