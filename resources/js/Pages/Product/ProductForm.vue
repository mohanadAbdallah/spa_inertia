<script setup>
defineProps({
    form: {
        type: Object,
        required: true,
    },
    categories: {
        type: Array,
        required: true
    }
})
const emit = defineEmits(['submit'])
</script>
<template>
    <form class="relative bg-white rounded-lg shadow" @submit.prevent="emit('submit')">
        <div class="p-6 space-y-6">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-6">
                    <label for="name"
                           class="block mb-2 text-sm font-medium"
                           :class="{'text-red-700':form.errors.name,'text-gray-900':!form.errors.name}">Product
                        name</label>
                    <input type="text" name="name" v-model="form.name" id="name"
                           class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                           :class="{ 'bg-red-50 border-red-500 text-red-900': form.errors.name,'bg-gray-50 border-gray-300 text-gray-900': !form.errors.name}">
                    <div class="font-sm text-red-500 mt-2" v-if="form.errors.name">
                        {{ form.errors.name }}
                    </div>
                </div>

                <!-- Brand -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="brand"
                           class="block mb-2 text-sm font-medium"
                           :class="{'text-red-700': form.errors.brand, 'text-gray-900': !form.errors.brand}">
                        Brand
                    </label>
                    <input type="text" name="brand" v-model="form.brand" id="brand"
                           class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                           :class="{ 'bg-red-50 border-red-500 text-red-900': form.errors.brand, 'bg-gray-50 border-gray-300 text-gray-900': !form.errors.brand }">
                    <div class="font-sm text-red-500 mt-2" v-if="form.errors.brand">
                        {{ form.errors.brand }}
                    </div>
                </div>

                <!-- Category -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="category_id"
                           class="block mb-2 text-sm font-medium"
                           :class="{'text-red-700': form.errors.category_id, 'text-gray-900': !form.errors.category_id}">
                        Category
                    </label>
                    <select name="category_id" v-model="form.category_id" id="category_id"
                            class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                            :class="{ 'bg-red-50 border-red-500 text-red-900': form.errors.category_id, 'bg-gray-50 border-gray-300 text-gray-900': !form.errors.category_id }">
                        <option :value="category.id" v-for="category in categories"
                                :key="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                    <div class="font-sm text-red-500 mt-2" v-if="form.errors.category_id">
                        {{ form.errors.category_id }}
                    </div>
                </div>

                <!-- Price -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="price"
                           class="block mb-2 text-sm font-medium"
                           :class="{'text-red-700': form.errors.price, 'text-gray-900': !form.errors.price}">
                        Price
                    </label>
                    <input type="number" name="price" v-model="form.price" id="price"
                           class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                           :class="{ 'bg-red-50 border-red-500 text-red-900': form.errors.price, 'bg-gray-50 border-gray-300 text-gray-900': !form.errors.price }">
                    <div class="font-sm text-red-500 mt-2" v-if="form.errors.price">
                        {{ form.errors.price }}
                    </div>
                </div>

                <!-- Weight -->
                <div class="col-span-6 sm:col-span-3">
                    <label for="weight"
                           class="block mb-2 text-sm font-medium"
                           :class="{'text-red-700': form.errors.weight, 'text-gray-900': !form.errors.weight}">
                        Weight
                    </label>
                    <input type="number" name="weight" v-model="form.weight" id="weight"
                           class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                           :class="{ 'bg-red-50 border-red-500 text-red-900': form.errors.weight, 'bg-gray-50 border-gray-300 text-gray-900': !form.errors.weight }">
                    <div class="font-sm text-red-500 mt-2" v-if="form.errors.weight">
                        {{ form.errors.weight }}
                    </div>
                </div>

                <!-- Description -->
                <div class="col-span-6 sm:col-span-6">
                    <label for="description"
                           class="block mb-2 text-sm font-medium"
                           :class="{'text-red-700': form.errors.description, 'text-gray-900': !form.errors.description}">
                        Description
                    </label>
                    <textarea name="description" v-model="form.description" id="description"
                              rows="3"
                              class="shadow-sm border text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5"
                              :class="{ 'bg-red-50 border-red-500 text-red-900': form.errors.description, 'bg-gray-50 border-gray-300 text-gray-900': !form.errors.description }">

                                            </textarea>
                    <div class="font-sm text-red-500 mt-2" v-if="form.errors.description">
                        {{ form.errors.description }}
                    </div>
                </div>
                <div class="col-span-6 sm:col-span-6 space-x-2">
                    <slot/>
                </div>
            </div>
        </div>
    </form>
</template>
