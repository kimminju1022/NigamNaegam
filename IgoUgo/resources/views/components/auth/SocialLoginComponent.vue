<template>
    <!-- <div>임시거처</div> -->
    <p class="loading-text">소셜 로그인 하는 중</p>
    <div class="loading-container">
        <div id="loading"></div>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useStore } from 'vuex';

const store = useStore();

onMounted(() => {
    store.dispatch('auth/socialAuth');
});
</script>

<style scoped>
.loading-text {
    margin-top: 20vh;
    font-size: 25px;
    justify-self: center;
}

/* 로딩 돌아가는 친구 */
.loading-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20vh;
}
#loading {
    margin-top: 20px;
    display: inline-block;
    width: 100px;
    height: 100px;
    border: 3px solid #aaaaaa4d;
    border-radius: 50%;
    border-top-color: #01083a;
    animation: spin 1s ease-in-out infinite;
    -webkit-animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
    to { -webkit-transform: rotate(360deg); }
}
@-webkit-keyframes spin {
    to { -webkit-transform: rotate(360deg); }
}
</style>