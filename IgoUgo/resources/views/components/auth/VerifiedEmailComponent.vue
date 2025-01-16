<template>
    <div>
        <input v-model="user_email" type="email" name="user_email" placeholder="이메일 입력">
        <button @click="verifyEmail">이메일 인증하기</button>
        <div v-if="errMsg">{{ Msg }}</div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useStore } from 'vuex';

const user_email = ref('');
const store = useStore();

const errMsg = '';

const verifyEmail = () => {
    store.dispatch('verification/', user_email.value);
};