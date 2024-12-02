<script setup>
import Homepage from "@/Layouts/Homepage.vue";
import Footer from "@/Components/Footer.vue";
import Pagination from "@/Components/Pagination.vue";
import { Head, Link } from "@inertiajs/vue3";

// const form = useForm(props.user);

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
    pagination: {
        type: Object,
        required: true,
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

            <Link
                :href="route('posts')"
                class="block mx-auto mt-4 mb-4 w-48 text-center rounded-lg px-4 py-2 text-base font-semibold text-white bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 shadow-md hover:shadow-lg transition"
            >
                Ajouter une maison
            </Link>

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

                    <!-- Boutons Modifier et Supprimer -->
                    <div class="flex space-x-4 mt-4">
                        <!-- Bouton Modifier -->
                        <Link
                            :href="route('posts.edit', maison.id)"
                            class="px-4 py-2 text-sm font-medium bg-blue-500 hover:bg-blue-600 text-white rounded-md transition"
                        >
                            Modifier
                        </Link>

                        <!-- Bouton Supprimer -->
                        <!-- <form
                        @submit.prevent="form.delete(route('posts.destroy'))"
                        enctype="multipart/form-data"
                        class="space-y-6"
                    > -->
                        <button
                            @click="confirmDelete(maison.id)"
                            class="px-4 py-2 text-sm font-medium bg-red-500 hover:bg-red-600 text-white rounded-md transition"
                        >
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>

            <p v-else class="text-center text-gray-500 text-lg mt-10">
                Aucune maison disponible.
            </p>
        </div>
        <Pagination class="m-6" :pagination="pagination" />
    </Homepage>
    <Footer></Footer>
</template>
