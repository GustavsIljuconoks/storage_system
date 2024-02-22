<template>
    <PageLayout>
        <!-- Search input and buttons -->
        <div class="flex flex-col gap-3 items-stretch md:flex-row justify-between mb-4">
            <input type="text" class="px-3 py-2 border rounded-lg" placeholder="Search users">
            <div class="flex space-x-2">
                <button class="bg-green-600 w-full hover:bg-green-800 text-white text-md px-4 py-2 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0  0  24  24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18  7.5v3m0  0v3m0-3h3m-3  0h-3m-2.25-4.125a3.375  3.375  0  1  1-6.75  0  3.375  3.375  0  0  1  6.75  0ZM3  19.235v-.11a6.375  6.375  0  0  1  12.75  0v.109A12.318  12.318  0  0  1  9.374  21c-2.331  0-4.512-.645-6.374-1.766Z" />
                    </svg>
                    Add User
                </button>
            </div>
        </div>
  
            <!-- User cards -->
            <div class="p-4">
                <div class="flex flex-colitems-start justify-between md:flex-row">
                    <div class="flex ml-3 gap-x-10">
                        <p class="font-bold">ID</p>
                        <p>Name</p>
                        <p>Role</p>
                        <p>Last order</p>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-md rounded-lg p-4" v-for="user in users" :key="user.id">
                <div class="flex flex-col items-start justify-between md:flex-row">
                    <div class="flex gap-x-10 ml-3 md:text-nowrap">
                        <p class="font-bold">{{ user.id }}</p>
                        <p>{{ user.name }}</p>
                        <p>{{ user.status }}</p>
                        <p>{{ user.lastorder }}</p>
                    </div>
                    <div class="flex items-stretch justify-between w-full md:justify-end md:gap-2">
                        <button class="bg-blue-600 hover:bg-blue-800 text-white px-4 py-2 rounded-lg">Edit User</button>
                        <button class="bg-red-600 hover:bg-red-800 text-white px-4 py-2 rounded-lg">Delete User</button>
                    </div>
                </div>
            </div>
    </PageLayout>
</template>

<script type="ts">
    import PageLayout from '@/components/PageLayout.vue';

    export default {
    components: {
        PageLayout,
    },
    data() {
        return {
        users: [
            // Example user data
            { id:  1, name: 'John Doe', status: 'Admin', lastorder: 'Pending'},
            // Add more users as needed
        ],
        };
    },
    }
</script>