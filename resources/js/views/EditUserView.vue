<style>
.show {
  display: block;
}
</style>

<template>
  <section class="dark:bg-gray-500 mt-4">
    <div class="flex flex-col items-center justify-center mx-auto lg:py-0">
      <div
        class="w-full bg-gray-100 rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700"
      >
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
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

          <h1
            class="text-xl -mb-4 font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
          >
            Edit User
          </h1>
          <div>
            <label
              for="id"
              class="block -mt-4 text-sm font-medium text-purple-900 dark:text-white"
              >User's ID: {{ user.user_id }}</label
            >
          </div>
          <form @submit.prevent="updateUser(user.id)" class="space-y-4 md:space-y-6">
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
                  />
                </svg>
                User's name</label
              >
              <input
                v-model="formData.name"
                type="text"
                name="name"
                id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                :placeholder="user.name"
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
                  />
                </svg>
                User's email</label
              >
              <input
                v-model="formData.email"
                type="email"
                name="email"
                id="email"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                :placeholder="user.email"
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
                  />
                </svg>
                Password</label
              >
              <input
                v-model="formData.password"
                type="password"
                name="password"
                id="password"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
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
                  />
                </svg>
                Confirm password</label
              >
              <input
                v-model="formData.password_confirmation"
                type="password"
                name="confirm-password"
                id="confirm-password"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="••••••••"
              />
            </div>

            <button
              id="dropdownDefaultButton"
              data-dropdown-toggle="dropdown"
              class="w-full text-white bg-blue-600 hover:bg-blue-500 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
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
                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cursor-pointer"
                />
                <label
                  :for="role.role_id"
                  class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300 cursor-pointer"
                >
                  {{ role.role }}
                </label>
              </div>
            </div>
            <button
              type="submit"
              class="flex items-center justify-center w-full text-white bg-emerald-600 hover:bg-emerald-500 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
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
                  d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99"
                />
              </svg>
              Update
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import axios from "axios";
import { ref, onMounted, onUnmounted } from "vue";
import { IFormData } from "../globals";
const props = defineProps(["id"]);

interface IUser {
  name: string;
  id: number;
}

const showMenu = ref(false);
const user = ref<[IUser]>([]);
let roles = ref([]);
const formData = ref<IFormData>({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  role_id: null,
});

const error = ref(null);
const showError = ref(true);

const success = ref(null);
const showSuccess = ref(true);

const closeDropdown = () => {
  if (showMenu.value) {
    showMenu.value = false;
  }
};

const getUser = async () => {
  await axios
    .get("http://127.0.0.1:8000/api/get-users/" + props.id)
    .then((response) => {
      user.value = response.data;
    })
    .catch((error) => {
      console.error("Error fetching user:", error);
    });
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

const updateUser = async (userId: number) => {
  // Get those fields which are filled
  const requestData = {};
  for (const key in formData.value) {
    if (formData.value[key]) {
      requestData[key] = formData.value[key];
      console.log(formData.value);
    }
  }

  await axios
    .put("http://127.0.0.1:8000/api/update-user/" + userId, requestData)
    .then((response) => {
      formData.value = {
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        role_id: null,
      };

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

const handleClickOutside = (event) => {
  const dropdown = document.getElementById("dropdown");
  const dropdownButton = document.getElementById("dropdownDefaultButton");
  if (dropdown && !dropdown.contains(event.target) && event.target !== dropdownButton) {
    closeDropdown();
  }
};

onMounted(() => {
  document.addEventListener("click", handleClickOutside);
  getRoles();
  getUser();
});

onUnmounted(() => {
  document.removeEventListener("click", handleClickOutside);
});
</script>
