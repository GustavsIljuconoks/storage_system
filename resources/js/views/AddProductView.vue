<style>
.show {
  display: block;
}
</style>

<template>
  <section class="dark:bg-gray-500">
    <div class="flex flex-col items-center justify-center px-6 mx-auto lg:py-0">
      <div
        class="mt-5 -mb-10 w-full bg-gray-50 rounded-lg shadow-md dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700"
      >
        <div class="p-6 space-y-0 md:space-y-6 sm:p-8">
          <h1
            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white"
          >
            Add Product
          </h1>

          <AlertMessage :message="error" :show="showError" type="error" />
          <AlertMessage :message="success" :show="showSuccess" type="success" />

          <form @submit.prevent="addProduct" class="space-y-4 md:space-y-6">
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
                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"
                  />
                </svg>
                Product's name</label
              >
              <input
                v-model="formData.name"
                type="text"
                name="name"
                id="name"
                class="bg-gray-100 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="..."
              />
            </div>
            <div>
              <label
                for="quantity"
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
                    d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z"
                  />
                </svg>
                Quantity</label
              >
              <input
                v-model="formData.quantity_in_stock"
                type="text"
                name="quantity"
                id="quantity"
                class="bg-gray-100 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="..."
              />
            </div>

            <!-- Category dropdown button -->
            <div class="flex flex-col">
              <Menu as="div" class="mb-2 relative inline-block text-left">
                <div>
                  <MenuButton
                    class="flex w-full justify-center gap-x-1.5 rounded-md bg-gray-100 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                  >
                    Category
                    <ChevronDownIcon
                      class="-mr-1 h-5 w-5 text-gray-400"
                      aria-hidden="true"
                    />
                  </MenuButton>
                </div>

                <transition
                  enter-active-class="transition ease-out duration-100"
                  enter-from-class="transform opacity-0 scale-95"
                  enter-to-class="transform opacity-100 scale-100"
                  leave-active-class="transition ease-in duration-75"
                  leave-from-class="transform opacity-100 scale-100"
                  leave-to-class="transform opacity-0 scale-95"
                >
                  <MenuItems
                    class="absolute right-0 z-10 mt-2 w-full h-28 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none overflow-y-auto overflow-x-hidden"
                  >
                    <div class="py-1">
                      <MenuItem
                        v-for="category in categories"
                        :key="category.id"
                        v-slot="{ active }"
                      >
                        <label
                          :class="[
                            active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                            'block px-4 py-2 text-sm cursor-pointer',
                          ]"
                        >
                          <input
                            type="radio"
                            v-model="formData.category_id"
                            :value="category.category_id"
                            class="mr-2 cursor-pointer"
                          />
                          {{ category.name }}
                        </label>
                      </MenuItem>
                    </div>
                  </MenuItems>
                </transition>
              </Menu>

              <!-- Shelf dropdown button -->
              <Menu as="div" class="mb-2 relative inline-block text-left">
                <div>
                  <MenuButton
                    class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-gray-100 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                  >
                    Shelf
                    <ChevronDownIcon
                      class="-mr-1 h-5 w-5 text-gray-400"
                      aria-hidden="true"
                    />
                  </MenuButton>
                </div>

                <transition
                  enter-active-class="transition ease-out duration-100"
                  enter-from-class="transform opacity-0 scale-95"
                  enter-to-class="transform opacity-100 scale-100"
                  leave-active-class="transition ease-in duration-75"
                  leave-from-class="transform opacity-100 scale-100"
                  leave-to-class="transform opacity-0 scale-95"
                >
                  <MenuItems
                    class="absolute right-0 z-10 mt-2 w-full h-28 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none overflow-y-auto overflow-x-hidden"
                  >
                    <div class="py-1">
                      <MenuItem
                        v-for="shelf in shelves"
                        :key="shelf.id"
                        v-slot="{ active }"
                      >
                        <label
                          :class="[
                            active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                            'block px-4 py-2 text-sm cursor-pointer',
                          ]"
                        >
                          <input
                            type="radio"
                            v-model="formData.shelf_id"
                            :value="shelf.shelf_id"
                            class="mr-2 cursor-pointer"
                          />
                          {{ shelf.shelf_id }}
                        </label>
                      </MenuItem>
                    </div>
                  </MenuItems>
                </transition>
              </Menu>

              <!-- Selected shelf's column dropdown button -->
              <Menu as="div" class="mb-2 relative inline-block text-left">
                <div>
                  <MenuButton
                    class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-gray-100 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                  >
                    Column
                    <ChevronDownIcon
                      class="-mr-1 h-5 w-5 text-gray-400"
                      aria-hidden="true"
                    />
                  </MenuButton>
                </div>

                <transition
                  enter-active-class="transition ease-out duration-100"
                  enter-from-class="transform opacity-0 scale-95"
                  enter-to-class="transform opacity-100 scale-100"
                  leave-active-class="transition ease-in duration-75"
                  leave-from-class="transform opacity-100 scale-100"
                  leave-to-class="transform opacity-0 scale-95"
                >
                  <MenuItems
                    class="absolute right-0 z-10 mt-2 w-full h-28 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none overflow-y-auto overflow-x-hidden"
                  >
                    <div class="py-1">
                      <MenuItem
                        v-for="i in parseInt(selectedShelf?.column)"
                        :key="i"
                        v-slot="{ active }"
                      >
                        <label
                          :class="[
                            active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                            'block px-4 py-2 text-sm cursor-pointer',
                          ]"
                        >
                          <input
                            type="radio"
                            class="mr-2 cursor-pointer"
                            :value="i"
                            v-model="selectedColumn"
                          />
                          {{ i }}
                        </label>
                      </MenuItem>
                    </div>
                  </MenuItems>
                </transition>
              </Menu>

              <!-- Selected shelf's row dropdown button -->
              <Menu as="div" class="mb-2 relative inline-block text-left">
                <div>
                  <MenuButton
                    class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-gray-100 px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50"
                  >
                    Row
                    <ChevronDownIcon
                      class="-mr-1 h-5 w-5 text-gray-400"
                      aria-hidden="true"
                    />
                  </MenuButton>
                </div>

                <transition
                  enter-active-class="transition ease-out duration-100"
                  enter-from-class="transform opacity-0 scale-95"
                  enter-to-class="transform opacity-100 scale-100"
                  leave-active-class="transition ease-in duration-75"
                  leave-from-class="transform opacity-100 scale-100"
                  leave-to-class="transform opacity-0 scale-95"
                >
                  <MenuItems
                    class="absolute right-0 z-10 mt-2 w-full h-28 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none overflow-y-auto overflow-x-hidden"
                  >
                    <div class="py-1">
                      <MenuItem
                        v-for="i in parseInt(selectedShelf?.row)"
                        :key="i"
                        v-slot="{ active }"
                      >
                        <label
                          :class="[
                            active ? 'bg-gray-100 text-gray-900' : 'text-gray-700',
                            'block px-4 py-2 text-sm cursor-pointer',
                          ]"
                        >
                          <input
                            type="radio"
                            class="mr-2 cursor-pointer"
                            :value="i"
                            v-model="selectedRow"
                          />
                          {{ i }}
                        </label>
                      </MenuItem>
                    </div>
                  </MenuItems>
                </transition>
              </Menu>
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
                  d="M12 4.5v15m7.5-7.5h-15"
                />
              </svg>
              Add Product
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup lang="ts">
import { ref, onMounted, computed } from "vue";
import axios from "axios";
import AlertMessage from "@/components/AlertMessage.vue";
import { Menu, MenuButton, MenuItem, MenuItems } from "@headlessui/vue";
import { ChevronDownIcon } from "@heroicons/vue/20/solid";
import { useRouter } from "vue-router";

interface IFormData {
  name: string;
  quantity_in_stock: number;
  category_id: number;
  shelf_id: number;
}

const router = useRouter();
const error = ref(null);
const showError = ref(true);
const success = ref(null);
const showSuccess = ref(true);

const userId = parseInt(localStorage.getItem("userId"));
const categories = ref(false);
const shelves = ref([]);
const selectedColumn = ref(null);
const selectedRow = ref(null);
const formData = ref<IFormData>({
  name: "",
  quantity_in_stock: null,
  category_id: null,
  shelf_id: null,
});

const selectedShelf = computed(() => {
  return shelves.value.find((shelf) => shelf.shelf_id === formData.value.shelf_id);
});

const getShelves = async () => {
  try {
    const response = await axios.get("http://127.0.0.1:8000/api/get-shelfes");
    shelves.value = response.data.data;
  } catch (error) {
    console.error(error);
  }
};

const getCategories = async () => {
  await axios
    .get("http://127.0.0.1:8000/api/get-categories")
    .then((response) => {
      categories.value = response.data;
    })
    .catch((err) => {
      console.log(err);
    });
};

const addProduct = async () => {
  const productData = {
    name: formData.value.name,
    quantity_in_stock: formData.value.quantity_in_stock,
    category_id: formData.value.category_id,
    userId: userId,
  };

  try {
    const response1 = await axios.post(
      "http://127.0.0.1:8000/api/add-product",
      productData
    );
    const productId = response1.data.product.product_id;

    const response2 = await axios
      .post("http://127.0.0.1:8000/api/put-item", {
        userId: userId,
        productId: productId,
        shelfId: formData.value.shelf_id,
        column: selectedColumn.value,
        row: selectedRow.value,
      })
      .catch((error) => {
        console.log(error);
        error.value = error.response.data.message || "An error occurred.";

        showError.value = true;
        setTimeout(() => {
          showError.value = false;
        }, 2000);
      });

    success.value =
      response1.data.message || response2.data.message || "Product added successfully";
    showSuccess.value = true;

    setTimeout(() => {
      showSuccess.value = false;
    }, 2000);

    router.push({ name: "products" });
  } catch (err) {
    error.value = error.response.data.message || "An error occurred.";

    showError.value = true;
    setTimeout(() => {
      showError.value = false;
    }, 2000);
  }
};

onMounted(() => {
  getCategories();
  getShelves();
});
</script>
