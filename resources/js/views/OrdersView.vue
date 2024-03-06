<template>
    <PageLayout>
            <div>
                <div class="container mx-auto space-y-2 md:space-y-0 md:flex justify-between items-center">
                    <ul class="md:flex space-y-2 md:space-y-0 justify-start md:space-x-2 text-white">
                        <li>
                        <button
                            @click="activeTabOne"
                            class="shadow-md inline-block w-full px-10 py-2 rounded-lg bg-gray-500 hover:bg-blue-800"
                        >
                            All
                        </button>
                        </li>
                        <li>
                        <button
                            @click="activeTabTwo"
                            class="shadow-md inline-block w-full px-4 py-2 rounded-lg bg-gray-500 hover:bg-yellow-500"
                        >
                            Pending
                        </button>
                        </li>
                        <li>
                        <button
                            @click="activeTabThree"
                            class="shadow-md inline-block w-full px-4 py-2 rounded-lg bg-gray-500 hover:bg-green-600"
                        >
                            Delivered
                        </button>
                        </li>
                    </ul>
                    <div class="flex justify-end ml-0 md:ml-2">
                        <router-link :to="{name: 'addorder'}" 
                            class="shadow-md bg-green-500 hover:bg-green-600 text-white text-md px-4 py-2 w-full md:w-auto rounded-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-1 w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            Add Order
                        </router-link>
                    </div>
                </div>
                <div class="mt-2 relative">
                    <input type="text" id="search" class="w-full shadow-md px-3 py-2 border rounded-lg pl-10" placeholder="Search order">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="gray" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="mt-6 overflow-auto relative">
                <table class="min-w-full border-separate border-spacing-y-2">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-blue-200" v-show="tab === 1">
                        <tr v-for="order in orders" :key="order.id">
                            <td class="font-bold px-6 py-4 whitespace-nowrap">{{ order.id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ order.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ order.category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ order.quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ order.status }}</td>
                            <td class="flex flex-col gap-2 md:flex-row space-y-2 md:space-y-0 pr-3 p-2 justify-end text-right text-sm font-medium">
                                <button class="shadow-md bg-green-500 hover:bg-green-600 p-3 px-6 rounded text-white">Accept</button>
                                <router-link :to="{name: 'editorder'}" class="shadow-md bg-blue-600 hover:bg-blue-800 p-3 px-6 rounded text-white text-center">Edit</router-link>
                                <button class="shadow-md bg-red-600 hover:bg-red-800 p-3 px-4 rounded text-white">Delete</button>
                            </td>
                        </tr>
                    </tbody>

                    <tbody class="bg-blue-200" v-show="tab === 1">
                        <tr v-for="order in orders" :key="order.id">
                            <td class="font-bold px-6 py-4 whitespace-nowrap">{{ order.id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ order.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ order.category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ order.quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">Delivered</td>
                            <td class="flex flex-col gap-2 md:flex-row space-y-2 md:space-y-0 pr-3 p-2 justify-end text-right text-sm font-medium">
                                <router-link :to="{name: 'editorder'}" class="shadow-md bg-blue-600 hover:bg-blue-800 p-3 px-6 rounded text-white text-center">Edit</router-link>
                                <button class="shadow-md bg-red-600 hover:bg-red-800 p-3 px-4 rounded text-white">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                    <tbody class="bg-blue-200" v-show="tab === 2">
                        <!-- Pending orders -->
                    </tbody>
                    <tbody class="bg-blue-200" v-show="tab === 3">
                        <!-- Completed orders -->
                    </tbody>
                </table>
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
        tab: 1,
        orders: [
            { id: 1, name: 'Chocolate cookies', category: 'Cookies', quantity: '69', status: 'Pending'},
        ],
        };
    },
    methods: {
        activeTabOne() {
        this.tab = 1;
        },
        activeTabTwo() {
        this.tab = 2;
        },
        activeTabThree() {
        this.tab = 3;
        },
    },
    };
</script>