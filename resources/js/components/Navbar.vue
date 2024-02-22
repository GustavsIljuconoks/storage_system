<template>
    <fwb-navbar class="w-full fixed shadow-md">
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
        <fwb-navbar-collapse :is-show-menu="isShowMenu">
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
            <router-link :to="{name: ''}">
              Products
            </router-link>
          </fwb-navbar-link>
          <fwb-navbar-link>
            <router-link :to="{name: ''}">
              Orders
            </router-link>
          </fwb-navbar-link>
          <fwb-navbar-link>
            <router-link :to="{name: ''}">
              Logs
            </router-link>
          </fwb-navbar-link>
          <fwb-navbar-link>
            <router-link :to="{name: ''}">
              Logout
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
  </script>