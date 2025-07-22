<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';
import ProductForm from "@/Pages/Product/ProductForm.vue";
import CategoryForm from "@/Pages/Category/CategoryForm.vue";

const form = useForm({
    'name': '',
})

const store = () => {
    form.post(route('categories.store'), {
        onSuccess: () => form.reset()
    })
}
</script>

<template>
    <Head title="New Product"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Manage Categories</h2>
                <Link :href="route('products.index')"
                      class="px-3 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    Manage Categories
                </Link>
            </div>
        </template>
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="flex items-center justify-center">
                        <div class="relative w-full max-w-2xl max-h-full">
                            <CategoryForm :form="form" @submit="store">
                                <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    Save
                                </button>
                                <Link :href="route('categories.index')"
                                      class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">
                                    Cancel
                                </Link>
                            </CategoryForm>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
