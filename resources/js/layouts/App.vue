<template>
    <main class="">
        <Navbar :authenticated="authenticated" />
        <router-view></router-view>
    </main>
</template>

<script setup lang="ts">
    import Navbar from "../components/Navbar.vue";
    import { onBeforeMount, ref } from "vue";

    let authenticated = ref(false);

    onBeforeMount(async () => {
        authenticated = JSON.parse(localStorage.getItem("authenticated"));
    });
</script>
