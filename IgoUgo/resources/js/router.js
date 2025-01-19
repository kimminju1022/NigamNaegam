import { createRouter, createWebHistory } from 'vue-router';
import { useStore } from 'vuex';
// 메인
import MainPageComponent from '../views/components/MainPageComponent.vue';
// 로그인 관련
import LoginComponent from '../views/components/auth/LoginComponent.vue';
import BeforeUserRegistrationComponent from '../views/components/user/BeforeUserRegistrationComponent.vue';
import UserRegistrationComponent from '../views/components/user/UserRegistrationComponent.vue';
// 이메일 인증
import VerifiedEmailComponent from '../views/components/auth/VerifiedEmailComponent.vue';
// 유저
import MyPageComponent from '../views/components/user/MyPageComponent.vue';
import MyPageUpdateComponent from '../views/components/user/MyPageUpdateComponent.vue';
import PasswordComponent from '../views/components/user/PasswordComponent.vue';
import PasswordUpdateComponent from '../views/components/user/PasswordUpdateComponent.vue';
// 호텔
import HotelListComponent from '../views/components/hotels/HotelListComponent.vue';
import HotelMapComponent from '../views/components/hotels/HotelMapComponent.vue';
import HotelListDetailComponent from '../views/components/hotels/HotelListDetailComponent.vue';
// 상품
import ProductMainComponent from '../views/components/products/ProductMainComponent.vue';
import ProductListComponent from '../views/components/products/ProductListComponent.vue';
import ProductDetailComponent from '../views/components/products/ProductDetailComponent.vue';
// 게시판
import BoardListComponent from '../views/components/board/BoardListComponent.vue';
import BoardDetailComponent from '../views/components/board/BoardDetailComponent.vue';
import BoardCreateComponent from '../views/components/board/BoardCreateComponent.vue';
import BoardUpdateComponent from '../views/components/board/BoardUpdateComponent.vue';

// 문의게시판
import QuestionListComponent from '../views/components/question/QuestionListComponent.vue';
import QuestionCreateComponent from '../views/components/question/QuestionCreateComponent.vue';
import QuestionDetailComponent from '../views/components/question/QuestionDetailComponent.vue';
import QuestionUpdateComponent from '../views/components/question/QuestionUpdateComponent.vue';
// 기타
import NotFoundComponent from '../views/components/NotFoundComponent.vue';

// 테스트
import TestComponent from '../views/components/products/TestComponent.vue';

// admin
import AdminMainComponent from '../views/adminComponents/AppComponent.vue';

const chkAuth = (to, from, next) => {
    const store = useStore();
    const authFlg = store.state.auth.authFlg;
    const noAuthPassFlg = (to.path === '/login' || to.path === '/registration' || to.path === '/registration/chk');
    
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
    // admin
    {
        path: '/admin',
        component: AdminMainComponent,
    },
    // -------------------

    // 메인
    {
        path: '/',
        component: MainPageComponent,
    },
    // 로그인
    {
        path: '/login',
        component: LoginComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/registration/chk',
        component: BeforeUserRegistrationComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/registration',
        component: UserRegistrationComponent,
        beforeEnter: chkAuth,
    },
    // 이메일
    {
        path: '/email/verify/:id',
        component: VerifiedEmailComponent,
        beforeEnter: chkAuth,
    },
    // 유저
    {
        path: '/user/:id',
        component: MyPageComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/user/:id/edit',
        component: MyPageUpdateComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/password/:id',
        component: PasswordComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/password/:id/edit',
        component: PasswordUpdateComponent,
        beforeEnter: chkAuth,
    },
    // 호텔
    {
        path: '/hotels',
        component: HotelListComponent
    },
    {
        path: '/hotels/map',
        component: HotelMapComponent,
    },
    {
        path: '/hotels/:contentid',
        component: HotelListDetailComponent,
    },
    // 상품
    {
        path: '/products',
        component: ProductMainComponent,
    },
    {
        path: '/products/:contenttypeid',
        component: ProductListComponent,
    },
    {
        path: '/products/:contenttypeid/:contentid',
        component: ProductDetailComponent,
    },
    // -------------------------------
    // 테스트
    {
        path: '/testtest',
        component: TestComponent,
    },
    // -------------------------------
    // 게시판
    {
        path: '/boards',
        component: BoardListComponent,
    },
    {
        path: '/boards/:id',
        component: BoardDetailComponent,
    },
    {
        path: '/boards/create',
        component: BoardCreateComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/boards/:id/update',
        component: BoardUpdateComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/boards/edit',
        component: BoardUpdateComponent,
        beforeEnter: chkAuth,
    },
    // 문의게시판
    {
        path: '/questions',
        component: QuestionListComponent,
    },
    {
        path: '/questions/create',
        component: QuestionCreateComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/questions/:id',
        component: QuestionDetailComponent,
    },
    {
        path: '/questions/:id/edit',
        component: QuestionUpdateComponent,
        beforeEnter: chkAuth,
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