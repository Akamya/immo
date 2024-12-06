<script setup>
import Homepage from "@/Layouts/Homepage.vue";
import Footer from "@/Components/Footer.vue";
import Pagination from "@/Components/Pagination.vue";
import MaisonCard from "@/Components/MaisonCard.vue";
import { Head, Link } from "@inertiajs/vue3";

// const form = useForm(props.maison);

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
    userId: {
        type: Number,
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
        </div>
        <div
            v-if="maisons.length > 0"
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
        >
            <div
                v-for="maison in maisons"
                :key="maison.id"
                class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition"
            >
                <MaisonCard
                    :maisonID="maison.id"
                    :title="maison.title"
                    :images="maison.images"
                    :price="maison.price"
                    :address="maison.address"
                    :rooms="maison.rooms"
                    :size="maison.size"
                    :description="maison.description"
                    :maisonUserId="maison.user_id"
                    :currentUserId="userId"
                ></MaisonCard>
            </div>
        </div>

        <p v-else class="text-center text-gray-500 text-lg mt-10">
            Aucune maison disponible.
        </p>
        <Pagination class="m-6" :pagination="pagination" />
    </Homepage>
    <Footer></Footer>
</template>
