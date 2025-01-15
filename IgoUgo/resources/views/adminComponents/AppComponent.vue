<template>
<div class="admin">
    <div class="header-left">
        <div>
            <img class="header-image" src="/logo_IgoUgo.png" alt="">
            <hr>
            <p>유저관리</p>
            <p>게시판관리</p>
            <p>문의 관리</p>
            <p>통계</p>
        </div>
        <div>
            <div class="admin-user">
                <div class="admin-user-image-info">
                    <img class="admin-user-image" src="\logo_gam.png" alt="">
                    <p class="admin-user-name">믿어핑</p>
                </div>
                <div>
                    <div class="admin-user-info">
                        <p>아이디 admin@admin.com</p>
                        <p>유형 직책/닉네임</p>
                    </div>
                </div>
                <div>

                </div>
            </div>
        </div>
        <div>
            <button>로그아웃</button>
        </div>
    </div>
    <div>

    </div>
</div>
</template>

<script setup>

</script>

<style>
/* 왼쪽 오른쪽 나눈거 */
.admin {
    display: grid;
    grid-template-columns: 250px 1fr;
}


/* 왼쪽 헤더 */
.header-left {
    display: grid;
    grid-template-rows: 1fr 1fr 50px;
    background-color: #01083a;
    height: 100vh;
}
.header-image {
    width: 250px;
    padding: 20px 0;
}

/* 유저 회색 박스쪽 */
.admin-user {
    background-color: #dadada;
    height: 420px;
    width: 230px;
    justify-self: center;
    border-radius: 10px;
}
.admin-user-image {
    width: 120px;
    height: 120px;
}
.admin-user-image-info {
    justify-self: center;
    margin-bottom: 20px;
}
.admin-user-name {
    justify-self: center;
    font-size: 25px;
    color: #fff;
}
.admin-user-info {
    display: grid;
    grid-template-rows: 30px 30px;
}
</style>