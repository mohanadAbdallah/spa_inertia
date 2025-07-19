<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, router} from '@inertiajs/vue3';
import Pagination from "@/Components/Pagination.vue";
import {computed, onMounted, ref, watch} from "vue";
import EditModal from "@/Pages/Category/EditModal.vue";
import CreateModal from "@/Pages/Category/CreateModal.vue";

const props = defineProps({
    categories: {
        type: Object,
        required: true,
    },
})
const selectedCategoryId = ref()


const selectedCategory = computed(() => {
    const category = props.categories.data.find(
        (cat) => cat.id === selectedCategoryId.value
    )
    return category
        ? {id: category.id, name: category.name}
        : null
})

const showCreateModal = ref(false)
const showEditModal = ref(false)

const deleteRow = (id) => {
    if (window.confirm('Are you sure delete ?')) {
        router.delete(route('categories.destroy', id), {
            preserveScroll: true
        })
    }

}
</script>

<template>
    <Head title="Manage Products"/>

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Manage Categories</h2>
                <a href="#" @click.prevent="showCreateModal=true"
                      class="px-3 py-2.5 text-sm font-medium text-center text-white bg-blue-700 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                    New Category
                </a>
            </div>
        </template>

        <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                        <thead class="text-xs  text-gray-700 uppercase bg-gray-50 border-b">
                        <tr>
                            <th scope="col" class="px-6 py-3" width="5">
                                No.
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Category Name
                            </th>

                            <th scope="col" class="px-6 py-3">
                                Created at
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="bg-white border-b hover:bg-gray-50" v-for="(category,index) in categories.data"
                            :key="category.id">
                            <td class="px-6 py-4">
                                {{ categories.meta.from + index }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ category.name }}
                            </td>
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                {{ category.created_at }}
                            </td>

                            <td class="px-6 py-4 space-x-2">
                                <Link :href="route('categories.show', category.id)"
                                      class="font-medium text-gray-600 hover:underline">Show
                                </Link>
                                <a href=""
                                   @click.prevent="
                                   selectedCategoryId = category.id;
                                   showEditModal = true;"

                                   class=" font-medium text-blue-600 hover:underline">Edit
                                </a>
                                <a href="#" @click.prevent="deleteRow(category.id)"
                                   class="font-medium text-red-600 hover:underline">Delete</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <Pagination :meta="categories.meta"/>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

    <EditModal :category="selectedCategory" :show="showEditModal" @close="showEditModal = false"
               @updated="selectedCategory= null"/>
    <CreateModal :show="showCreateModal" @close="showCreateModal = false"/>

</template>
