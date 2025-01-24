<template>
    <div>임시거처</div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

onMounted(() => {
    store.dispatch('auth/socialAuth');
});
</script>
<style>
</style>