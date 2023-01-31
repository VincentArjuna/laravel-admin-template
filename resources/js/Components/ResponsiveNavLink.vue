<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    href: String,
    icon: String,
    active: {
        type: Boolean,
        default: false,
    },
    child: {
        type: Boolean,
        default: false,
    },
    pl: {
        type: Number,
    },
});

const classes = computed(() =>
    props.active
        ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-left text-base font-medium text-indigo-700 bg-white focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out'
        : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-black bg-sky-300  focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out'
);
</script>

<template>
    <div>
        <Link :href="href" :class="classes">
        <slot />
        </Link>
    </div>

</template>
