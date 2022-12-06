<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import Supplier from '@/Pages/Admin/Supplier.vue';
import Category from '@/Pages/Admin/Category.vue';
import Location from '@/Pages/Admin/Location.vue';
import Building from '@/Pages/Admin/Building.vue';
import Payments_spa from '@/Pages/Admin/Payments_spa.vue';

import { defineComponent, ref } from 'vue';

const activeKey = ref('1');
</script>

<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <a-tabs v-model:activeKey="activeKey">
                        <a-tab-pane key="1" tab="Supplier">
                            <Supplier/>
                        </a-tab-pane>
                        <a-tab-pane key="2" tab="Category" force-render>
                            <Category/>
                        </a-tab-pane>
                        <a-tab-pane key="3" tab="Location">
                            <Location/>
                        </a-tab-pane>
                        <a-tab-pane key="4" tab="Building">
                            <Building/>
                        </a-tab-pane>
                        <!-- <a-tab-pane key="4" tab="Payment">
                            <Payments_spa/>
                        </a-tab-pane> -->
                    </a-tabs>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
