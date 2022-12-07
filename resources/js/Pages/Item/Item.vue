<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ItemList from '@/Pages/Item/ItemList.vue';
</script>

<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Item
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ItemList/>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
