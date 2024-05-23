<style>
.show {
  display: block;
}
</style>

<template>
  <section class="dark:bg-gray-500" v-if="roleId == 1">
    <div class="flex flex-col items-center justify-center px-6 mx-auto lg:py-0">
      <div
        class="mt-5 -mb-10 w-full bg-gray-50 rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700"
      >
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
          <h1
            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
          >
            Add User
          </h1>

          <div
            v-if="error"
            :class="{ show: showError, hide: showError == false }"
            class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50"
            role="alert"
          >
            <span class="font-medium">{{ error }}</span>
          </div>

          <div
            v-if="success"
            :class="{ show: showSuccess, hide: !showSuccess }"
            class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert"
          >
            <span class="font-medium">{{ success }}</span>
          </div>

          <form @submit.prevent="registerNewUser" class="space-y-4 md:space-y-6">
            <div>
              <label
                for="name"
                class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="size-5 mr-1"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                  /></svg
                >User's name</label
              >
              <input
                v-model="formData.name"
                type="text"
                name="name"
                id="name"
                class="bg-gray-100 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="John Doe"
              />
            </div>
            <div>
              <label
                for="email"
                class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="size-5 mr-1"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25"
                  /></svg
                >User's email</label
              >
              <input
                v-model="formData.email"
                type="email"
                name="email"
                id="email"
                class="bg-gray-100 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="name@company.com"
              />
            </div>
            <div>
              <label
                for="password"
                class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="size-5 mr-1"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z"
                  /></svg
                >Password</label
              >
              <input
                v-model="formData.password"
                type="password"
                name="password"
                id="password"
                class="bg-gray-100 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="••••••••"
              />
            </div>
            <div>
              <label
                for="confirm-password"
                class="flex mb-2 text-sm font-medium text-gray-900 dark:text-white"
                ><svg
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke-width="1.5"
                  stroke="currentColor"
                  class="size-5 mr-1"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="m4.5 12.75 6 6 9-13.5"
                  /></svg
                >Confirm password</label
              >
              <input
                v-model="formData.password_confirmation"
                type="password"
                name="confirm-password"
                id="confirm-password"
                class="bg-gray-100 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="••••••••"
              />
            </div>

            <button
              id="dropdownDefaultButton"
              data-dropdown-toggle="dropdown"
              class="w-full text-white bg-blue-700 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
              type="button"
              @click="showMenu = !showMenu"
            >
              Role
              <svg
                class="w-2.5 h-2.5 ms-3"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 10 6"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m1 1 4 4 4-4"
                />
              </svg>
            </button>

            <!-- Dropdown menu -->
            <div
              id="dropdown"
              class="p-2 z-10 hidden absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-50 dark:bg-gray-700"
              :class="{ show: showMenu }"
            >
              <div class="p-3" v-for="role in roles" :key="role.id">
                <input
                  :id="role.role_id"
                  :value="role.role_id"
                  v-model="formData.role_id"
                  type="radio"
                  name="default-radio"
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                />
                <label
                  :for="role.role_id"
                  class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                >
                  {{ role.role }}
                </label>
              </div>
            </div>
            <button
              type="submit"
              class="flex justify-center items-center w-full text-white bg-emerald-600 hover:bg-green-500 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke-width="1.5"
                stroke="currentColor"
                class="size-5 mr-1"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z"
                />
              </svg>
              Add User
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ref, onMounted, onUnmounted } from "vue";
import axios from "axios";
import { IFormData } from "../globals";

const roleId = localStorage.getItem("roleId");
const showMenu = ref(false);
let roles = ref([]);

const error = ref(null);
const showError = ref(true);

const success = ref(null);
const showSuccess = ref(true);

const formData = ref<IFormData>({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  role_id: null,
});

const closeDropdown = () => {
  if (showMenu.value) {
    showMenu.value = false;
  }
};

const handleClickOutside = (event) => {
  const dropdown = document.getElementById("dropdown");
  const dropdownButton = document.getElementById("dropdownDefaultButton");
  if (dropdown && !dropdown.contains(event.target) && event.target !== dropdownButton) {
    closeDropdown();
  }
};

const getRoles = async () => {
  await axios
    .get("http://127.0.0.1:8000/api/get-roles")
    .then((response) => {
      roles.value = response.data;
    })
    .catch((err) => {
      console.log(err);
    });
};

const creator = localStorage.getItem("userId");
const registerNewUser = async () => {
  await axios
    .post("http://127.0.0.1:8000/api/register", {
      ...formData.value,
      creator: creator,
    })
    .then((response) => {
      success.value = response.data.message || "Success";
      showSuccess.value = true;

      setTimeout(() => {
        showSuccess.value = false;
      }, 2000);
    })
    .catch((err) => {
      error.value = err.response.data.message || "An error occurred.";

      showError.value = true;
      setTimeout(() => {
        showError.value = false;
      }, 2000);
    });
};

onMounted(() => {
  document.addEventListener("click", handleClickOutside);
  getRoles();
});

onUnmounted(() => {
  document.removeEventListener("click", handleClickOutside);
});
</script>
