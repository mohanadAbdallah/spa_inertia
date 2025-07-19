<script setup>
defineProps({
    form: {
        type: Object,
        required: true,
    }
})
const emit = defineEmits(['submit'])
</script>
<template>
    <form class="relative bg-white rounded-lg shadow" @submit.prevent="emit('submit')">
        <div class="p-6 space-y-6 mb-8">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-6">
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

                <div class="col-span-6 sm:col-span-6 space-x-2">
                    <slot/>
                </div>
            </div>
        </div>
    </form>
</template>
