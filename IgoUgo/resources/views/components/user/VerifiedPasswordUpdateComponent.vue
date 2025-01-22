<template>
    <div class="password">
        <h1>비밀번호 변경</h1>
        <!-- <div class="password-err" v-if="errorMsgList.length"> -->
        <div class="password-err">
            <!-- <p v-for="msg in $store.state.user.errorMsgList" :key="msg">{{ msg }}</p> -->
        </div>
        <!-- <div class="password-err">
            <p>비밀번호가 맞지 않습니다.</p>
        </div> -->
        <div class="password-item">
            <p class="bg-navy">변경할 비밀번호</p>
            <input v-model="userInfo.newPassword" type="password" name="newPassword"  placeholder="문자, 숫자, 특수문자 포함 8-20글자">
        </div>
        <div class="password-item">
            <p class="bg-navy">변경할 비밀번호 확인</p>
            <input v-model="userInfo.newPasswordChk" type="password" name="newPasswordChk" placeholder="비밀번호 확인">
        </div>
        <div class="my-profile-chk-btn">
            <button @click="$store.dispatch('user/verifiedPWUpdate', userInfo)" class="btn bg-clear">변경</button>
            <button @click="backToRoot" class="btn bg-clear btn-chk">취소</button>
            <!-- <router-link :to="`/user/${$store.state.auth.userInfo.user_id}`"><button class="btn bg-clear">취소</button></router-link> -->
        </div>
    </div>
</template>

<script setup>
import { reactive} from 'vue';
import { useRoute } from 'vue-router';
import { useStore } from 'vuex';

const store = useStore();
const route = useRoute();

const userInfo = reactive({ 
    id: route.params.id
    ,user_email: localStorage.getItem('verifiedEmail')
    ,newPassword: ''
    ,newPasswordChk: ''
});

console.log('Component의 user: ', userInfo);

// const errorMsgList = ref({});

const backToRoot = () => {
    router.replace('/');
};
</script>

<style scoped>
.password {
    max-width: 500px;
    gap: 20px;
    margin: 0 auto 26px auto;
    text-align: center;
}

.password h1 {
    color: #01083a;
    margin: 60px auto;
    font-size: 3rem;
}

.password-err {
    display: flex;
    justify-content: flex-end;
    color: red;
    font-size: 15px;
    margin-bottom: 15px;
}

.password-item {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 20px;
    margin-bottom: 10px;
}

.password-item :nth-child(1) {
    min-width: 100px;
    padding: 10px 15px;
    text-align: center;
    border-radius: 15px;
    font-size: 18px;
}

.password-item :nth-child(2) {
    min-width: 200px;
    padding: 10px 15px;
    font-weight: 500;
    font-size: 18px;
    background: transparent;
    padding: 10px 15px;
    font-size: 18px;
    border-bottom: 2px solid #01083a;
}

/* 수정 버튼 */

.my-profile-chk-btn {
    display: flex;
    justify-content: flex-end;
    padding: 10px 5px;
}

.my-profile-chk-btn button {
    font-size: 20px;  
    padding: 7px 15px;
    border-radius: 50px;
}

.my-profile-chk-btn :nth-child(1):hover {
    color: #f00;
    font-weight: 600;
}
.my-profile-chk-btn :nth-child(2) button:hover {
    color: #01083a;
    font-weight: 600;
}
</style>