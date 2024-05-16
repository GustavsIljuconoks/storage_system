<template>
    <div class="flex items-center justify-center">
        <div class="w-full max-w-md px-2 py-10 sm:px-0">
            <TabGroup>
                <TabList class="flex space-x-1 rounded-xl bg-blue-900/20 p-1">
                    <Tab
                    v-for="category in Object.keys(categories)"
                    as="template"
                    :key="category"
                    v-slot="{ selected }"
                    >
                    <button
                        :class="[
                        'w-full rounded-lg py-2.5 text-sm font-medium leading-5',
                        'ring-white/60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
                        selected
                            ? 'bg-white text-blue-700 shadow'
                            : 'text-blue-100 hover:bg-white/[0.12] hover:text-white',
                        ]"
                    >
                        {{ category }}
                    </button>
                    </Tab>
                </TabList>

                <TabPanels class="mt-2">
                    <TabPanel
                        v-for="(posts, idx) in Object.values(categories)"
                        :key="idx"
                        :class="[
                            'rounded-xl bg-white p-3',
                        ]"
                    >
                        <div class="w-full px-4" v-for="post in posts">
                            <div class="shadow-md mx-auto w-full max-w-md rounded-2xl bg-white p-2">
                                <Disclosure as="div" class="mt-2" v-slot="{ open }">
                                    <DisclosureButton
                                        class="flex w-full justify-between rounded-lg bg-blue-100 px-4 py-2 text-left text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring focus-visible:ring-blue-500/75"
                                    >
                                        <span class="text-lg">Log ID: {{ post.log_id }}</span>
                                        <ChevronUpIcon
                                            :class="open ? 'rotate-180 transform' : ''"
                                            class="h-5 w-5 text-blue-500"
                                        />
                                    </DisclosureButton>

<!--                                    Conditional renders-->
                                    <DisclosurePanel class="px-4 pt-4 text-sm text-gray-500" v-if="post.order_id">
                                        Order ID: {{ post.order_id }}
                                    </DisclosurePanel>

                                    <DisclosurePanel class="px-4 pt-4 text-sm text-gray-500" v-if="post.product_id">
                                        Product ID: {{ post.product_id }}
                                    </DisclosurePanel>

<!--                                    End here-->

                                    <DisclosurePanel class="px-4 pt-4 text-sm text-gray-500">
                                        User ID: {{ post.user_id }}
                                    </DisclosurePanel>
                                    <DisclosurePanel class="px-4 pt-4 text-sm text-gray-500">
                                        Action: {{ post.action }}
                                    </DisclosurePanel>
                                    <DisclosurePanel class="px-4 pt-4 text-sm text-gray-500">
                                        Date: {{ post.updated_at }}
                                    </DisclosurePanel>
                                    <DisclosurePanel>
                                        <button class="shadow-md bg-red-600 hover:bg-red-800 p-1 px-4 mt-2 rounded text-white w-full">Delete</button>
                                    </DisclosurePanel>
                                </Disclosure>
                            </div>
                        </div>
                    </TabPanel>
                </TabPanels>
            </TabGroup>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
    import { ChevronUpIcon } from '@heroicons/vue/20/solid'
    import { onMounted, ref } from 'vue'
    import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue'
    import axios from "axios";

    const orderLogs = ref();
    const productLogs = ref();

    const orderLog = async () => {
        await axios.get('http://127.0.0.1:8000/api/log-order')
            .then((response) => {
                console.log(response.data)
                orderLogs.value = response.data;
            })
    }

    const productLog = async () => {
        await axios.get('http://127.0.0.1:8000/api/log-products')
            .then((response) => {
                console.log(response.data)
                productLogs.value = response.data;
            })
    }

    onMounted(() => {
        orderLog();
        productLog();
    });

    const categories = ref({
        Users: [],
        Products: productLogs,
        Orders: orderLogs,
    })
</script>