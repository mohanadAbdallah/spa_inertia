<script setup>
import {useForm} from '@inertiajs/vue3';
import Modal from "@/Components/Modal.vue";
import {watch} from "vue";

const props = defineProps({
    category: {
        type: Object,
        default: () => ({}),
    },
    showModal: {
        type: Boolean,
        default: false
    },

})
const form = useForm({...props.category})

watch(() => props.category, (newCategory) => {
        form.defaults({...newCategory})
        form.name = newCategory?.name || ''
        form.id = newCategory?.id || null
    },
    {immediate: true}
)
const update = () => {
    form.put(route('categories.update', form.id), {
        onSuccess: () => {
            form.reset();
            emit('close')
        }

    })
}
const emit = defineEmits(['close', 'updated'])

</script>

<template>
    <Modal :show="showModal">
        <form class="relative bg-white rounded-lg shadow" @submit.prevent="update">
            <div class="flex items-start justify-between p-4 border-b rounded-t">
                <h3 class="text-xl font-semibold text-gray-900">
                    Edit Category name
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
                <div class="col-span-6 sm:col-span-3">
                    <label for="name"
                           class="block mb-2 text-sm font-medium"
                           :class="{'text-red-700':form.errors.name,'text-gray-900':!form.errors.name}">Category
                        name</label>
                    <input type="text" name="name" v-model="form.name" id="name"
                           class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                           :class="{ 'bg-red-50 border-red-500 text-red-900': form.errors.name,'bg-gray-50 border-gray-300 text-gray-900': !form.errors.name}">
                    <div class="font-sm text-red-500 mt-2" v-if="form.errors.name">
                        {{ form.errors.name }}
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
