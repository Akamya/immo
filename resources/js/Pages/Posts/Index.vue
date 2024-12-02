<script setup>
import Homepage from "@/Layouts/Homepage.vue";
import Footer from "@/Components/Footer.vue";
import { useForm } from "@inertiajs/vue3";

defineExpose({
    layout: Homepage,
});

// Initialisation des champs du formulaire
const form = useForm({
    title: "",
    image: "",
    address: "",
    price: "",
    rooms: "",
    size: "",
    description: "",
});
</script>

<template>
    <Homepage>
        <div class="py-12">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6"
                >
                    <h2 class="text-2xl font-bold mb-6 text-gray-700">
                        Ajouter une maison
                    </h2>

                    <!-- Formulaire -->
                    <form
                        @submit.prevent="form.post(route('posts.store'))"
                        enctype="multipart/form-data"
                        class="space-y-6"
                    >
                        <!-- Titre -->
                        <div>
                            <label
                                for="title"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Titre
                            </label>
                            <input
                                type="text"
                                id="title"
                                v-model="form.title"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Titre de la maison"
                            />
                            <div
                                v-if="form.errors.title"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.title }}
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <label
                                for="image"
                                class="block text-sm font-medium text-gray-700"
                                >Image</label
                            >
                            <input
                                id="image"
                                type="file"
                                @change="
                                    (e) => (form.image = e.target.files[0])
                                "
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                            />
                            <div
                                v-if="form.errors.image"
                                class="text-red-500 text-sm mt-1"
                            >
                                {{ form.errors.image }}
                            </div>
                        </div>

                        <!-- Adresse -->
                        <div>
                            <label
                                for="address"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Adresse
                            </label>
                            <input
                                type="text"
                                id="address"
                                v-model="form.address"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Adresse de la maison"
                            />
                            <div
                                v-if="form.errors.address"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.address }}
                            </div>
                        </div>

                        <!-- Prix -->
                        <div>
                            <label
                                for="price"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Prix (€)
                            </label>
                            <input
                                type="number"
                                id="price"
                                v-model="form.price"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Prix"
                            />
                            <div
                                v-if="form.errors.price"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.price }}
                            </div>
                        </div>

                        <!-- Nombre de pièces -->
                        <div>
                            <label
                                for="rooms"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Nombre de pièces
                            </label>
                            <input
                                type="number"
                                id="rooms"
                                v-model="form.rooms"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Nombre de pièces"
                            />
                            <div
                                v-if="form.errors.rooms"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.rooms }}
                            </div>
                        </div>

                        <!-- Superficie -->
                        <div>
                            <label
                                for="size"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Superficie (m²)
                            </label>
                            <input
                                type="number"
                                id="size"
                                v-model="form.size"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                placeholder="Superficie"
                            />
                            <div
                                v-if="form.errors.size"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.size }}
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label
                                for="description"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Description
                            </label>
                            <textarea
                                id="description"
                                v-model="form.description"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                rows="4"
                                placeholder="Description de la maison"
                            ></textarea>
                            <div
                                v-if="form.errors.description"
                                class="text-sm text-red-500 mt-1"
                            >
                                {{ form.errors.description }}
                            </div>
                        </div>

                        <!-- Bouton -->
                        <div class="mt-6 flex justify-end">
                            <button
                                type="submit"
                                class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition"
                            >
                                Ajouter
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Homepage>
    <Footer></Footer>
</template>
