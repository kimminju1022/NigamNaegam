import { createRouter, createWebHistory } from 'vue-router';
import LoginComponent from '../views/components/auth/LoginComponent.vue';
import UserRegistrationComponent from '../views/components/user/UserRegistrationComponent.vue';
import ProductListComponent from '../views/components/board/ProductListComponent.vue';
import BoardListComponent from '../views/components/board/BoardListComponent.vue';
import BoardDetailComponent from '../views/components/board/BoardDetailComponent.vue';
import BoardCreateComponent from '../views/components/board/BoardCreateComponent.vue';
import BoardUpdateComponent from '../views/components/board/BoardUpdateComponent.vue';
import BoardQuestionComponent from '../views/components/board/boardQuestionComponent.vue';
import NotFoundComponent from '../views/components/NotFoundComponent.vue';
import MyPageComponent from '../views/components/user/MyPageComponent.vue';
import MyPageUpdateComponent from '../views/components/user/MyPageUpdateComponent.vue';
import PasswordComponent from '../views/components/user/PasswordComponent.vue';
import PasswordUpdateComponent from '../views/components/user/PasswordUpdateComponent.vue';
import MainPageComponent from '../views/components/MainPageComponent.vue';
import HotelListDetailComponent from '../views/components/board/HotelListDetailComponent.vue';
import HotelListComponent from '../views/components/board/HotelListComponent.vue';
import HotelMapComponent from '../views/components/board/HotelMapComponent.vue';
import { useStore } from 'vuex';


const chkAuth = (to, from, next) => {
    const store = useStore();
    const authFlg = store.state.user.authFlg;
    // const noAuthPassFlg = (to.path === '/' || to.path === '/login' || to.path === '/registration');
    const noAuthPassFlg = (to.path === '/login' || to.path === '/registration');
    
    if(authFlg && noAuthPassFlg) {
        next('/');
    } else if(!authFlg && !noAuthPassFlg) {
        alert('로그인 후 이용가능');
        next('/login');
    } else {
        next();
    }
}


const routes = [
    // 다른 경로와 컴포넌트 추가 가능
    {
        path: '/',
        component: MainPageComponent,
    },
    {
        path: '/login',
        component: LoginComponent,
        // beforeEnter: chkAuth,
    },
    {
        path: '/registration',
        component: UserRegistrationComponent,
        // beforeEnter: chkAuth,
    },
    {
        path: '/hotels',
        component: HotelListComponent
    },
    {
        path: '/hotels/detail',
        component: HotelListDetailComponent,
    },
    {
        path: '/hotels/map',
        component: HotelMapComponent,
    },
    {
        path: '/products',
        component: ProductListComponent,
    },
    {
        path: '/boards',
        component: BoardListComponent,
    },
    {
        path: '/boards/detail',
        component: BoardDetailComponent,
    },
    {
        path: '/boards/create',
        component: BoardCreateComponent,
        // beforeEnter: chkAuth,
    },
    {
        path: '/boards/update',
        component: BoardUpdateComponent,
        // beforeEnter: chkAuth,
    },
    {
        path: '/boards/question',
        component: BoardQuestionComponent,
    },
    {
        path: '/myPage',
        component: MyPageComponent,
        // beforeEnter: chkAuth,
    },
    {
        path: '/myPage/update',
        component: MyPageUpdateComponent,
        // beforeEnter: chkAuth,
    },
    {
        path: '/password',
        component: PasswordComponent,
        // beforeEnter: chkAuth,
    },
    {
        path: '/password/update',
        component: PasswordUpdateComponent,
        // beforeEnter: chkAuth,
    },
    {
        path: '/:catchAll(.*)',
        component: NotFoundComponent,
    },
];


const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;