<script setup>
import Modal from "@/Components/Modal.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    show: {
        type: Boolean,
        default: false
    },
    products: {
        type: Array,
        required: true
    },
    categories: {
        type: Array,
        required: true
    }
});
const update = () => {
    form.product_ids = props.products.map((product) => product.id)

    form.patch(route('products.bulk-update'), {
        onSuccess: () => {
            form.reset()
            emit('close')
            emit('updated')
        }
    })
}
const form = useForm({
    product_ids: [],
    category_id: ""
})
const emit = defineEmits(['close', 'updated'])
</script>

<template>
    <Modal :show="show" max-width="xl" @close="emit('close')">
        <form class="relative bg-white rounded-lg shadow" @submit.prevent="update">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">

                </h3>
                <button type="button" @click.prevent="emit('close')"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="editUserModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900 ">Products</label>
                        <ul>
                            <li class="flex items-center" v-for="product in products" :key="product.id">
                                <svg class="w-3.5 h-3.5 me-2 text-cyan-500 flex-shrink-0" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                                {{ product.name }}
                            </li>
                        </ul>
                        <div class="font-sm text-red-500 mt-2" v-if="form.errors.product_ids">
                            You need to choose one product or more to proceed
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-6">
                        <label for="category_id"
                               class="block mb-2 text-sm font-medium text-gray-900 ">Category</label>
                        <select name="category_id" id="category_id" v-model="form.category_id"
                                class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                                :class="{ 'bg-red-50 border-red-500 text-red-900': form.errors.category_id,
                                 'bg-gray-50 border-gray-300 text-gray-900': !form.errors.category_id}">

                            <option :value="category.id" v-for="category in categories">{{ category.name }}</option>
                        </select>
                        <div class="font-sm text-red-500 mt-2"
                             v-if="form.errors.category_id">{{ form.errors.category_id }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="text-right p-6 space-x-2 border-t rounded-b">
                <button type="button" @click.prevent="emit('close')"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5">
                    Cancel
                </button>
                <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Update
                </button>
            </div>
        </form>
    </Modal>

</template>
