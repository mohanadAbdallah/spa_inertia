<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, router} from '@inertiajs/vue3';

defineProps({
    product: {
        type: Object,
        required: true,
    }
})
const deleteRow = (id) => {
    if (window.confirm("Are you sure delete ?")) {
        router.delete(route('products.destroy', id))
    }
}

</script>

<template>
    <Head title="Show Product"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Show Products</h2>
                <Link :href="route('products.index')"
                      class="px-3 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Manage Products
                </Link>

            </div>

        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex items-center justify-center">
                    <div class="relative bg-white rounded-lg shadow w-full max-w-2xl max-h-full">
                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Product name</label>
                                    <p class="text-sm text-gray-900 w-full py-2.5">{{ product.name }}</p>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Brand</label>
                                    <p class="text-sm text-gray-900 w-full py-2.5">{{ product.brand }}</p>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Category</label>
                                    <p class="text-sm text-gray-900 w-full py-2.5">{{ product.category.name }}</p>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Price</label>
                                    <p class="text-sm text-gray-900 w-full py-2.5">{{ product.price_formatted }}</p>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Weight (kg)</label>
                                    <p class="text-sm text-gray-900 w-full py-2.5">{{ product.weight }}</p>
                                </div>
                                <div class="col-span-6 sm:col-span-6">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 ">Description</label>
                                    <p class="text-sm text-gray-900 w-full py-2.5">{{ product.description }}</p>
                                </div>
                                <div class="col-span-6 sm:col-span-6 space-x-2 flex items-center justify-between">
                                    <div class="space-x-2">
                                        <Link :href="route('products.edit',product.id)"
                                              class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-indigo-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                            Edit
                                        </Link>
                                        <Link :href="route('products.index')"
                                              class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">
                                            Cancel
                                        </Link>
                                    </div>
                                    <a href="#" @click.prevent="deleteRow(product.id)"
                                       class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Delete</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>



