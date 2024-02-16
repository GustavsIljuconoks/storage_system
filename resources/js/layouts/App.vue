<template>
    <main class="">
        <Navbar/>
        <router-view></router-view>
    </main>
</template>

<script setup lang="ts">
    import axios from "axios";
    import {useRouter} from "vue-router";
    import Navbar from "../components/Navbar.vue";
</script>
