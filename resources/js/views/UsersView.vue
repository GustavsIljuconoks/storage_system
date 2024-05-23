<template>
  <PageLayout>
    <!-- Search input and buttons -->
    <div class="flex flex-col gap-3 items-stretch md:flex-row justify-between mb-4">
      <Search @update:search="searchText = $event" />
      <div class="flex space-x-2">
        <router-link
          :to="{ name: 'adduser' }"
          class="shadow-md bg-emerald-600 hover:bg-emerald-500 text-white text-md px-4 py- w-full md:w-auto rounded-lg flex items-center justify-center h-10"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0  0  24  24"
            stroke-width="1.5"
            stroke="currentColor"
            class="w-5 h-5 mr-2"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M18  7.5v3m0  0v3m0-3h3m-3  0h-3m-2.25-4.125a3.375  3.375  0  1  1-6.75  0  3.375  3.375  0  0  1  6.75  0ZM3  19.235v-.11a6.375  6.375  0  0  1  12.75  0v.109A12.318  12.318  0  0  1  9.374  21c-2.331  0-4.512-.645-6.374-1.766Z"
            />
          </svg>
          Add User
        </router-link>
      </div>
    </div>

    <!-- User cards -->
    <div class="mt-6 overflow-auto relative">
      <table class="min-w-full border-separate border-spacing-y-2">
        <thead>
          <tr class="bg-gray-300">
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              ID
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              Name
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              Role
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            >
              Last Order
            </th>
            <th
              class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
            ></th>
          </tr>
        </thead>
        <tbody class="bg-gray-100">
          <tr v-for="user in filteredUsers" :key="user.id">
            <td class="font-bold px-6 py-4 whitespace-nowrap">{{ user.id }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ user.name }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ user.role }}</td>
            <td class="px-6 py-4 whitespace-nowrap">{{ user.lastorder }}</td>
            <td
              class="flex flex-col gap-2 md:flex-row space-y-2 md:space-y-0 pr-3 p-2 justify-end text-right text-sm font-medium"
            >
              <router-link
                :to="{ name: 'edituser', params: { id: user.id } }"
                class="flex shadow-md bg-blue-600 hover:bg-blue-500 p-3 px-6 rounded text-white text-center"
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
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                  />
                </svg>
                Edit</router-link
              >
              <button
                @click="userDelete(user.id)"
                class="flex shadow-md bg-red-600 hover:bg-red-500 p-3 px-4 rounded text-white"
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
                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                  />
                </svg>
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </PageLayout>
</template>

<script setup type="ts">
import PageLayout from '@/components/PageLayout.vue';
import Search from '@/components/Search.vue';
import axios from "axios";
import { onMounted, ref, computed } from "vue";

const users = ref([]);
const searchText = ref('');

const getUsers = async () => {
    await axios.get('http://127.0.0.1:8000/api/get-users')
        .then((response) => {
            users.value = response.data
        })
        .catch((err)=> {
            console.log(err);
        })
}

const userDelete = async (userId) => {
    await axios.delete('http://127.0.0.1:8000/api/delete-user', {
        data: {
            userId: userId
        }
    })
        .then((response) => {
            getUsers();
        })
        .catch((err)=> {
            console.log(err);
        })
}

const filteredUsers = computed(() => {
    if (!searchText.value) return users.value;
    const searchNumber = parseInt(searchText.value, 10);
    return users.value.filter(user => {
        if (!isNaN(searchNumber)) {
            return user.id === searchNumber;
        }
        return user.name.toLowerCase().includes(searchText.value.toLowerCase());
    });
});

onMounted(() => {
    getUsers();
})
</script>
