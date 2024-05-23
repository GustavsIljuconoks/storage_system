<template>
  <main class="">
    <Navbar v-if="authenticated" />
    <router-view></router-view>
  </main>
</template>

<script setup lang="ts">
import Navbar from "../components/Navbar.vue";
import { onBeforeMount, ref } from "vue";

let authenticated = ref(false);

onBeforeMount(async () => {
  const authStatus = localStorage.getItem("authenticated");
  authenticated.value = authStatus ? JSON.parse(authStatus) : false;
});
</script>
