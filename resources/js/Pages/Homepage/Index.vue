<script setup>
import Homepage from "@/Layouts/Homepage.vue";
import { Head, Link } from "@inertiajs/vue3";

// Cela évite d'imbriquer le layout dans le template, et permet une gestion centralisée des layouts.
defineExpose({
    layout: Homepage,
});

defineProps({
    maisons: {
        type: Array,
    },
    images: {
        type: Array,
    },
});
</script>

<template>
    <Homepage>
        <!-- Contenu principal -->
        <div class="container mx-auto mt-10 px-4">
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">
                Liste des maisons
            </h1>

            <div
                v-if="maisons.length > 0"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
            >
                <div
                    v-for="maison in maisons"
                    :key="maison.id"
                    class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition"
                >
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        {{ maison.title }}
                    </h2>

                    <!-- Affichage des images spécifiques à chaque maison -->
                    <div v-if="maison.images.length > 0" class="mb-4">
                        <img
                            v-for="image in maison.images"
                            :key="image.id"
                            :src="`${/storage/}` + image.path"
                            alt="Image de la maison"
                            class="rounded-lg shadow-lg w-full h-auto"
                        />
                    </div>

                    <p class="text-gray-600 mb-1">
                        <span class="font-medium">Prix :</span>
                        {{ maison.price }} €
                    </p>
                    <p class="text-gray-600 mb-1">
                        <span class="font-medium">Adresse :</span>
                        {{ maison.address }}
                    </p>

                    <p class="text-gray-600 mb-1">
                        <span class="font-medium">Nombre de pièces :</span>
                        {{ maison.rooms }}
                    </p>
                    <p class="text-gray-600 mb-1">
                        <span class="font-medium">Superficie :</span>
                        {{ maison.size }} m²
                    </p>
                    <p class="text-gray-600 mb-1">
                        <span class="font-medium">Description :</span>
                        <span v-if="maison.description">{{
                            maison.description
                        }}</span>
                        <span v-else class="italic text-gray-500"
                            >Non spécifiée</span
                        >
                    </p>
                </div>
            </div>

            <p v-else class="text-center text-gray-500 text-lg mt-10">
                Aucune maison disponible.
            </p>
        </div>
    </Homepage>
</template>
