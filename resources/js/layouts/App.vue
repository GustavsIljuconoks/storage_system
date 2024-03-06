<template>
    <main class="">
        <Navbar :authenticated="authenticated" />
        <router-view></router-view>
    </main>
</template>

<script setup lang="ts">
    import Navbar from "../components/Navbar.vue";
    import { ref } from "vue";

    const userToken = localStorage.getItem('userToken')
    const authenticated = ref(JSON.parse(localStorage.getItem("authenticated")));
</script>
