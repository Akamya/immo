<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <!-- Barre de navigation -->
    <nav v-if="canLogin" class="bg-gray-800 text-white p-4">
        <div class="container mx-auto flex justify-end">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="rounded-md px-4 py-2 text-sm font-medium bg-[#FF2D20] hover:bg-[#e0261c] transition"
            >
                Dashboard
            </Link>

            <template v-else>
                <Link
                    :href="route('login')"
                    class="rounded-md px-4 py-2 text-sm font-medium bg-blue-500 hover:bg-blue-600 transition mr-2"
                >
                    Log in
                </Link>

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="rounded-md px-4 py-2 text-sm font-medium bg-green-500 hover:bg-green-600 transition"
                >
                    Register
                </Link>
            </template>
        </div>
    </nav>
    <!-- Contenu de chaque page -->
    <main class="container mx-auto mt-6">
        <slot />
    </main>
</template>
