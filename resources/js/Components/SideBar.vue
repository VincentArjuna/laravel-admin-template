<script setup>
import { ref } from "vue";
import MenuList from "./MenuList.vue";
const isOpen = ref(false);
</script>

<template>
    <div :class="isOpen ? 'w-15' : 'w-60'" class="flex flex-col h-screen p-3 duration-300 bg-gray-800 shadow">
        <div class="space-y-3">
            <div class="flex items-center justify-between p-2">
                <h2 class="text-xl font-bold text-white" :hidden="isOpen" hidden>Dashboard</h2>
                <button @click="isOpen = !isOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>

            <MenuList/>
        </div>
    </div>
</template>