<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
</script>

<template>
    <DashboardLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div>
                        <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                            <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
                               Dashboard
                            </h1>

                            <p class="mt-6 text-gray-500 dark:text-gray-400 leading-relaxed">
                                Text
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
