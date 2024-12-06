<script setup>
import { useForm } from "@inertiajs/vue3";
const props = defineProps({
    maisonID: {
        type: Number,
    },
    title: {
        type: String,
    },
    images: {
        type: Array,
    },
    price: {
        type: Number,
    },
    address: {
        type: String,
    },
    rooms: {
        type: Number,
    },
    size: {
        type: Number,
    },
    description: {
        type: String,
    },
    maisonUserId: {
        type: Number,
    },
    currentUserId: {
        // ID de l'utilisateur connecté
        type: Number,
    },
});
const form = useForm({ maisonId: props.maisonID });
</script>

<template>
    <h2 class="text-xl font-semibold text-gray-800 mb-2">
        {{ title }}
    </h2>

    <!-- Affichage des images spécifiques à chaque maison -->
    <div v-if="images.length > 0" class="mb-4">
        <img
            v-for="image in images"
            :key="image.id"
            :src="`${/storage/}` + image.path"
            alt="Image de la maison"
            class="rounded-lg shadow-lg w-full h-auto"
        />
    </div>

    <p class="text-gray-600 mb-1">
        <span class="font-medium">Prix :</span>
        {{ price }} €
    </p>
    <p class="text-gray-600 mb-1">
        <span class="font-medium">Adresse :</span>
        {{ address }}
    </p>

    <p class="text-gray-600 mb-1">
        <span class="font-medium">Nombre de pièces :</span>
        {{ rooms }}
    </p>
    <p class="text-gray-600 mb-1">
        <span class="font-medium">Superficie :</span>
        {{ size }} m²
    </p>
    <p class="text-gray-600 mb-1">
        <span class="font-medium">Description :</span>
        <span v-if="description">{{ description }}</span>
        <span v-else class="italic text-gray-500">Non spécifiée</span>
    </p>

    <!-- Boutons Modifier et Supprimer -->
    <div v-if="currentUserId === maisonUserId" class="flex space-x-4 mt-4">
        <!-- Bouton Modifier -->
        <form @submit.prevent="form.get(route('posts.edit', maisonID))">
            <button
                class="px-4 py-2 text-sm font-medium bg-blue-500 hover:bg-blue-600 text-white rounded-md transition"
            >
                Modifier
            </button>
        </form>

        <!-- Bouton Supprimer -->
        <form @submit.prevent="form.delete(route('posts.destroy', maisonID))">
            <button
                class="px-4 py-2 text-sm font-medium bg-red-500 hover:bg-red-600 text-white rounded-md transition"
            >
                Supprimer
            </button>
        </form>
    </div>
</template>
