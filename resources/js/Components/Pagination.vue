<script setup>
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const { pagination } = defineProps({
    pagination: {
        type: Object,
        required: true,
        validator: (obj) => {
            return (
                obj.hasOwnProperty("current_page") &&
                obj.hasOwnProperty("total") &&
                obj.hasOwnProperty("per_page")
            );
        },
    },
});

const showingFrom = computed(
    () => (pagination.current_page - 1) * pagination.per_page + 1
);
const showingTo = computed(() =>
    Math.min(pagination.current_page * pagination.per_page, pagination.total)
);
</script>

<template>
    <nav
        v-if="pagination.last_page > 1"
        role="navigation"
        aria-label="Pagination Navigation"
        class="flex items-center justify-between"
    >
        <!-- Version mobile -->
        <div class="flex justify-between flex-1 sm:hidden">
            <Link
                v-if="pagination.prev_page_url"
                :href="pagination.prev_page_url"
                preserve-scroll
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300"
            >
                Previous
            </Link>
            <span
                v-else
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600"
            >
                Previous
            </span>

            <Link
                v-if="pagination.next_page_url"
                :href="pagination.next_page_url"
                preserve-scroll
                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300"
            >
                Next
            </Link>
            <span
                v-else
                class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600"
            >
                Next
            </span>
        </div>

        <!-- Version desktop -->
        <div
            class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between"
        >
            <div>
                <p class="text-sm text-gray-700 leading-5 dark:text-gray-400">
                    Showing
                    <span class="font-medium">{{ showingFrom }}</span>
                    to
                    <span class="font-medium">{{ showingTo }}</span>
                    of
                    <span class="font-medium">{{ pagination.total }}</span>
                    results
                </p>
            </div>

            <div>
                <span
                    class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md"
                >
                    <!-- Bouton Previous -->
                    <Link
                        v-if="pagination.prev_page_url"
                        :href="pagination.prev_page_url"
                        preserve-scroll
                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </Link>
                    <span
                        v-else
                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5 dark:bg-gray-800 dark:border-gray-600"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </span>

                    <!-- Numéros de page -->
                    <template
                        v-for="link in pagination.links.slice(1, -1)"
                        :key="link.label"
                    >
                        <span
                            v-if="link.active"
                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-blue-600 bg-blue-50 border border-gray-300 cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600"
                            >{{ link.label }}</span
                        >
                        <Link
                            v-else
                            :href="link.url"
                            preserve-scroll
                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400"
                            >{{ link.label }}</Link
                        >
                    </template>

                    <!-- Bouton Next -->
                    <Link
                        v-if="pagination.next_page_url"
                        :href="pagination.next_page_url"
                        preserve-scroll
                        class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </Link>
                    <span
                        v-else
                        class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5 dark:bg-gray-800 dark:border-gray-600"
                    >
                        <svg
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </span>
                </span>
            </div>
        </div>
    </nav>
</template>
