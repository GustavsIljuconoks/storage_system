<style>
    .pending-link {
        background-color: #ffc266;
    }

    .delivered-link {
        background-color: #0e9f6e;
    }

    .all-link {
        background-color: #4a7cd9;
    }
</style>

<template>
    <PageLayout>
            <div>
                <div class="container mx-auto space-y-2 md:space-y-0 md:flex justify-between items-center">
                    <ul class="bg-blue-900/20 p-1 space-x-1 rounded-xl md:flex space-y-2 md:space-y-0 justify-start md:space-x-2 text-white">
                        <li>
                            <button
                                :class="{ 'all-link': activeLink === 'all'}"
                                @click="getOrder"
                                class="shadow-md inline-block w-full px-10 py-2 rounded-lg bg-blue-900/20 hover:bg-[#4a7cd9] text-blue-100 hover:text-white"
                            >
                                All
                            </button>
                        </li>
                        <li>
                            <button
                                :class="{ 'pending-link': activeLink === 'pending'}"
                                @click="getPendingOrders"
                                class="shadow-md inline-block w-full px-4 py-2 rounded-lg bg-blue-900/20 hover:bg-[#ffc266] text-blue-100 hover:text-white"
                            >
                                Pending
                            </button>
                        </li>
                        <li>
                            <button
                                :class="{ 'delivered-link': activeLink === 'delivered'}"
                                @click="getDeliveredOrders"
                                class="shadow-md inline-block w-full px-4 py-2 rounded-lg bg-blue-900/20 hover:bg-[#0e9f6e] text-blue-100 hover:text-white"
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
                <Search placeholderText="Search Order" :isSmall="true" @update:search="searchText = $event"/>
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
                    <tbody class="bg-blue-200">
                        <tr v-for="order in filteredOrders" :key="order.id">
                            <td class="font-bold px-6 py-4 whitespace-nowrap">{{ order.id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ order.name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ order.category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ order.quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ order.status }}</td>
                            <td class="flex flex-col gap-2 md:flex-row space-y-2 md:space-y-0 pr-3 p-2 justify-end text-right text-sm font-medium">

                                <div v-if="order.status == 'pending'">
                                    <button @click="acceptOrder(order.id)" class="shadow-md bg-green-500 hover:bg-green-600 p-3 px-6 rounded text-white">Accept</button>
                                </div>
                                <div v-if="order.status != 'shipped'">
                                    <button @click="deleteOrder(order.id)" class="shadow-md bg-red-600 hover:bg-red-800 p-3 px-4 rounded text-white">Delete</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </PageLayout>
</template>

<script setup type="ts">
    import PageLayout from '@/components/PageLayout.vue';
    import axios from "axios";
    import { onMounted, ref, computed } from "vue";
    import Search from '@/components/Search.vue';

    const searchText = ref('');
    const orders = ref([]);
    const activeLink = ref('');

    const error = ref(null)
    const showError = ref(true);
    const success = ref(null)
    const showSuccess = ref(true);

    const userId = parseInt(localStorage.getItem('userId'));

    const getOrder = async () => {
        activeLink.value = 'all';
        await axios.get('http://127.0.0.1:8000/api/get-orders')
            .then((response) => {
                orders.value = response.data
            })
            .catch((error) => {
                console.error(error);
            })
    }

    const getPendingOrders = async () => {
        activeLink.value = 'pending';
        await axios.get('http://127.0.0.1:8000/api/pending-order')
            .then((response) => {
                orders.value = response.data;
            })
            .catch((error) => {
                console.error('Error fetching orders:', error);
            });
    }

    const getDeliveredOrders = async () => {
        activeLink.value = 'delivered';

        await axios.get('http://127.0.0.1:8000/api/delivered-order')
            .then((response) => {
                orders.value = response.data;
            })
            .catch((error) => {
                console.error('Error fetching orders:', error);
            });
    }

    const acceptOrder = async (orderId) => {
        await axios.put('http://127.0.0.1:8000/api/change-order-status', {
            orderId: orderId,
            userId: userId
        })
            .then((response) => {
                getOrder();
                console.log(response.data)
            })
            .catch((error) => {
                console.error(error);
            })
    }

    const deleteOrder = async (orderId) => {
        await axios.delete('http://127.0.0.1:8000/api/delete-order', {
            data: {
                orderId: orderId,
                userId: userId
            }
        })
            .then((response) => {
                getOrder();

                success.value = response.data.message || 'Success';
                showSuccess.value = true;

                setTimeout(() => {
                    showSuccess.value = false;
                }, 2000);
            })
            .catch((error) => {
                error.value = error.response.data.message || 'An error occurred.';

                showError.value = true;
                setTimeout(() => {
                    showError.value = false;
                }, 2000);
            })
    }

    const filteredOrders = computed(() => {
        if (!searchText.value) return orders.value;
        const searchNumber = parseInt(searchText.value, 10);
        return orders.value.filter(order => {
            if (!isNaN(searchNumber)) {
                return order.id === searchNumber || order.quantity === searchNumber;
            }
            return order.name.toLowerCase().includes(searchText.value.toLowerCase());
        });
    });

    onMounted(() => {
        getOrder();
    })
</script>