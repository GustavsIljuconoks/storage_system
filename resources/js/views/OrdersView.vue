<template>
    <PageLayout>
            <div>
                <div class="container mx-auto flex justify-between items-center">
                    <ul class="flex justify-start space-x-2 text-white">
                        <li>
                        <button
                            @click="activeTabOne"
                            class="shadow-md inline-block px-10 py-2 rounded-lg bg-gray-500 hover:bg-blue-800"
                        >
                            All
                        </button>
                        </li>
                        <li>
                        <button
                            @click="activeTabTwo"
                            class="shadow-md inline-block px-4 py-2 rounded-lg bg-gray-500 hover:bg-yellow-500"
                        >
                            Pending
                        </button>
                        </li>
                        <li>
                        <button
                            @click="activeTabThree"
                            class="shadow-md inline-block px-4 py-2 rounded-lg bg-gray-500 hover:bg-green-600"
                        >
                            Delivered
                        </button>
                        </li>
                    </ul>
                    <div class="flex justify-end ml-2">
                        <button class="shadow-md bg-green-500 hover:bg-green-600 text-white text-md px-4 py-2 rounded-lg flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="mr-1 w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Add Order
                        </button>
                    </div>
                </div>
            </div>
            <div class="mt-6 bg-white">
            <table class="min-w-full">
                <thead>
                    <tr>
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
                        <td class="px-6 py-4 whitespace-nowrap">{{ order.id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ order.name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ order.category }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ order.quantity }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ order.status }}</td>
                        <td class="space-x-2 space-y-2 text-right text-sm font-medium">
                            <button class="bg-blue-600 hover:bg-blue-800 p-3 px-6 rounded text-white">Edit</button>
                            <button class="bg-red-600 hover:bg-red-800 p-3 px-4 rounded text-white">Delete</button>
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