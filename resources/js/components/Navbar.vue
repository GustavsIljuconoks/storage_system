<template>
    <fwb-navbar class="w-full static shadow-md">
        <template #logo>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" />
                </svg>
                <div class="p-4 hidden sm:block">
                    <h1>Storage control system</h1>
                </div>
            </div>
        </template>
      <template #default="{isShowMenu}">
        <fwb-navbar-collapse :is-show-menu="isShowMenu" v-if="props.authenticated">
          <fwb-navbar-link>
            <router-link :to="{name: 'home'}">
              Home
            </router-link>
          </fwb-navbar-link>
          <fwb-navbar-link>
            <router-link :to="{name: 'users'}">
              Users
            </router-link>
          </fwb-navbar-link>
          <fwb-navbar-link>
            <router-link :to="{name: 'products'}">
              Products
            </router-link>
          </fwb-navbar-link>
          <fwb-navbar-link>
            <router-link :to="{name: 'orders'}">
              Orders
            </router-link>
          </fwb-navbar-link>
          <fwb-navbar-link>
            <router-link :to="{name: ''}">
              Logs
            </router-link>
          </fwb-navbar-link>
          <fwb-navbar-link>
              <div @click="userLogout">
                  Logout
              </div>
          </fwb-navbar-link>
        </fwb-navbar-collapse>
        <fwb-navbar-collapse v-if="!props.authenticated">
            <fwb-navbar-link>
                <router-link :to="{name: 'login'}">
                    Login
                </router-link>
            </fwb-navbar-link>
        </fwb-navbar-collapse>
      </template>
    </fwb-navbar>
</template>

  <script setup type="ts">
  import {
    FwbNavbar,
    FwbNavbarCollapse,
    FwbNavbarLink,
    FwbNavbarLogo,
  } from 'flowbite-vue'
  import axios from "axios";
  import {useRouter} from "vue-router";
  const props = defineProps(['authenticated'])

  const router = useRouter();
  const userToken = localStorage.getItem('userToken')

  const userLogout = async () => {
      const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;

      try {
          const response = await axios.post('http://127.0.0.1:8000/api/logout').finally(() => {
              localStorage.removeItem('userToken');
              localStorage.removeItem('authenticated');
              localStorage.removeItem('roleId');
              axios.defaults.headers.common['Authorization'] = 'Bearer';
              router.push({ name: 'home' });
          });
      } catch (error) {
          console.error('Logout error:', error);
      }
  };
  </script>
