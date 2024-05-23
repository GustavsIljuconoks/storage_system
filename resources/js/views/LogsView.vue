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
            :class="['rounded-xl bg-white p-3']"
          >
            <div class="w-full px-4" v-for="post in posts">
              <div class="shadow-md mx-auto w-full max-w-md rounded-2xl bg-white p-2">
                <Disclosure as="div" class="mt-2" v-slot="{ open }">
                  <DisclosureButton
                    class="flex w-full justify-between rounded-lg bg-gray-200 px-4 py-2 text-left text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus-visible:ring focus-visible:ring-gray-500/75"
                  >
                    <span class="text-lg">Log ID: {{ post.log_id }}</span>
                    <ChevronUpIcon
                      :class="open ? 'rotate-180 transform' : ''"
                      class="h-5 w-5 text-gray-500"
                    />
                  </DisclosureButton>

                  <!--                                    Conditional renders-->
                  <DisclosurePanel
                    class="px-4 pt-4 text-sm text-gray-500"
                    v-if="post.order_id"
                  >
                    Order ID: {{ post.order_id }}
                  </DisclosurePanel>

                  <DisclosurePanel
                    class="flex px-4 pt-4 text-sm text-gray-500"
                    v-if="post.product_id"
                  >
                    <p class="mr-1 font-bold">Product ID:</p>
                    {{ post.product_id }}
                  </DisclosurePanel>

                  <DisclosurePanel
                    class="flex px-4 pt-4 text-sm text-gray-500"
                    v-if="post.created_id"
                  >
                    <p class="mr-1 font-bold">Created ID:</p>
                    {{ post.created_id }}
                  </DisclosurePanel>
                  <!--                                    End here-->

                  <DisclosurePanel class="flex px-4 pt-4 text-sm text-gray-500">
                    <p class="mr-1 font-bold">User ID:</p>
                    {{ post.user_id }}
                  </DisclosurePanel>
                  <DisclosurePanel class="flex px-4 pt-4 text-sm text-gray-500">
                    <p class="mr-1 font-bold">Action:</p>
                    {{ post.action }}
                  </DisclosurePanel>
                  <DisclosurePanel class="flex px-4 pt-4 text-sm text-gray-500">
                    <p class="mr-1 font-bold">Date:</p>
                    {{ post.updated_at }}
                  </DisclosurePanel>
                  <DisclosurePanel>
                    <button
                      class="flex justify-center items-center shadow-md bg-red-600 hover:bg-red-800 p-1 px-4 mt-2 rounded text-white w-full"
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
                        /></svg
                      >Delete
                    </button>
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
import { Disclosure, DisclosureButton, DisclosurePanel } from "@headlessui/vue";
import { ChevronUpIcon } from "@heroicons/vue/20/solid";
import { onMounted, ref } from "vue";
import { TabGroup, TabList, Tab, TabPanels, TabPanel } from "@headlessui/vue";
import axios from "axios";

const orderLogs = ref();
const productLogs = ref();
const userLogs = ref();

const orderLog = async () => {
  await axios.get("http://127.0.0.1:8000/api/log-order").then((response) => {
    orderLogs.value = response.data;
  });
};

const productLog = async () => {
  await axios.get("http://127.0.0.1:8000/api/log-products").then((response) => {
    productLogs.value = response.data;
  });
};

const userLog = async () => {
  await axios.get("http://127.0.0.1:8000/api/log-users").then((response) => {
    userLogs.value = response.data;
  });
};

onMounted(() => {
  orderLog();
  productLog();
  userLog();
});

const categories = ref({
  Users: userLogs,
  Products: productLogs,
  Orders: orderLogs,
});
</script>
