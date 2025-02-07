import { createRouter, createWebHistory } from 'vue-router';
import { useStore } from 'vuex';
// 메인
import MainPageComponent from '../views/components/MainPageComponent.vue';
// 로그인 관련
import LoginComponent from '../views/components/auth/LoginComponent.vue';
import BeforeUserRegistrationComponent from '../views/components/user/BeforeUserRegistrationComponent.vue';
import UserRegistrationComponent from '../views/components/user/UserRegistrationComponent.vue';
import SocialLoginComponent from '../views/components/auth/SocialLoginComponent.vue';
// 이메일 인증
import VerifiedEmailComponent from '../views/components/auth/VerifiedEmailComponent.vue';
import VerifiedLoadingComponent from '../views/components/auth/VerifiedLoadingComponent.vue';
// 비밀번호 찾기
import FindPasswordComponent from '../views/components/auth/FindPasswordComponent.vue';
import FindPasswordLoadingComponent from '../views/components/auth/FindPasswordLoadingComponent.vue';
import VerifiedPasswordUpdateComponent from '../views/components/user/VerifiedPasswordUpdateComponent.vue';
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
import LoadingComponent from '../views/components/LoadingComponent.vue';
import SearchComponent from '../views/components/SearchComponent.vue';

// -----------------------------------------------
// admin(관리자)
// 로그인
import AdminLoginComponent from '../views/adminComponents/AdminLoginComponent.vue';
// 메인
import AdminMainComponent from '../views/adminComponents/main/MainComponent.vue';

// 유저 관리
import AdminUserManageComponent from '../views/adminComponents/user/UserManageComponent.vue';

// 게시판 관리
import AdminApiManageComponent from '../views/adminComponents/board/ApiManageComponent.vue';
import AdminReviewManageComponent from '../views/adminComponents/board/ReviewManageComponent.vue';
import AdminFreeManageComponent from '../views/adminComponents/board/FreeManageComponent.vue';

// 체험단
import AdminTesterComponent from '../views/adminComponents/tester/TesterComponent.vue';

// 이달의 추천
import AdminMonthlyRecommendComponent from '../views/adminComponents/recommend/MonthlyRecommendComponent.vue';

// 공지사항
import AdminNotificationComponent from '../views/adminComponents/notification/NotificationComponent.vue';

// 문의 관리
import AdminQuestionManageComponent from '../views/adminComponents/question/QuestionManageComponent.vue';

const chkAuth = (to, from, next) => {
    const store = useStore();
    const authFlg = store.state.auth.authFlg;
    const managerAuthFlg = store.state.auth.managerAuthFlg;
    const noAuthPassFlg = (to.path === '/login' || to.path === '/registration' || to.path === '/before/registration' || to.path === '/email/verify');
    const adminRegex = /admin/;
    
    // if(authFlg && noAuthPassFlg && !managerAuthFlg) {
    //     next('/');
    // } else if(!authFlg && !noAuthPassFlg) {
    //     alert('로그인 후 이용가능');
    //     window.location = '/login';
    // } else {
    //     next();
    // }

    if(!authFlg) {
        if(!managerAuthFlg) {
            if(!adminRegex.test(to.path)) {
                if(!noAuthPassFlg) {
                    alert('로그인 후 이용가능');
                    window.location = '/login';
                } else if(noAuthPassFlg) {
                    next();
                }
            } else if(adminRegex.test(to.path)) {
                window.location = '/';
            }
        } else if(managerAuthFlg) {
            if(!adminRegex.test(to.path)) {
                alert('관리자는 이용불가능');
                window.location = '/admin/main';
            } else if(adminRegex.test(to.path)) {
                next();
            }
        }
    } else if(authFlg) {
        if(to.path === '/') {
            next();
        }else if(!adminRegex.test(to.path)) {
            if(!noAuthPassFlg) {
                next();
            } else if(noAuthPassFlg) {
                next('/');
            }
        }else if(adminRegex.test(to.path)) {
            window.location = '/';
        }
    }

    // else if(!managerAuthFlg && adminRegex.test(to.path)) {
    //     // alert('관리자는 이용불가능');
    //     // next('/admin/main');
    //     window.location = '/';
    // } else if(managerAuthFlg && !adminRegex.test(to.path)) {
    //     alert('관리자는 이용불가능');
    //     // next('/admin/main');
    //     window.location = '/admin/main';
    // } else if(managerAuthFlg) {
    //     next();
    // } 
}

const chkManagerAuth = (to, from, next) => {
    const store = useStore();
    const managerAuthFlg = store.state.auth.managerAuthFlg;
    const noAuthPassFlg = (to.path === '/admin');
    
    if(managerAuthFlg && noAuthPassFlg) {
        next('/admin');
    } else if(!authFlg && !noAuthPassFlg) {
        alert('관리자 로그인 후 이용가능');
        next('/admin');
    } else {
        next();
    }
}

const routes = [
    // admin
    // 관리자 페이지_로그인
    {
        path: '/admin',
        component: AdminLoginComponent,
    },
    // 관리자 페이지_메인
    {
        path: '/admin/main',
        component: AdminMainComponent,
        beforeEnter: chkAuth,
    },
    // 관리자 페이지_유저 관리
    {
        path: '/admin/user',
        component: AdminUserManageComponent,
        beforeEnter: chkAuth,
    },
    // 관리자 페이지_게시판_API통합 관리
    {
        path: '/admin/board/api',
        component: AdminApiManageComponent,
        beforeEnter: chkAuth,
    },
    // 관리자 페이지_게시판_리뷰게시판 관리
    {
        path: '/admin/board/review',
        component: AdminReviewManageComponent,
        beforeEnter: chkAuth,
    },
    // 관리자 페이지_게시판_자유게시판 관리
    {
        path: '/admin/board/free',
        component: AdminFreeManageComponent,
        beforeEnter: chkAuth,
    },
    // 관리자 페이지_체험단
    {
        path: '/admin/tester',
        component: AdminTesterComponent,
        beforeEnter: chkAuth,
    },
    // 관리자 페이지_이달의 추천
    {
        path: '/admin/recommend',
        component: AdminMonthlyRecommendComponent,
        beforeEnter: chkAuth,
    },
    // 관리자 페이지_공지사항
    {
        path: '/admin/notification',
        component: AdminNotificationComponent,
        beforeEnter: chkAuth,
    },
    // 관리자 페이지_문의 관리
    {
        path: '/admin/question',
        component: AdminQuestionManageComponent,
        beforeEnter: chkAuth,
    },
    // -------------------

    // 메인
    {
        path: '/',
        component: MainPageComponent,
        beforeEnter: chkAuth,
    },
    // 로그인
    {
        path: '/login',
        component: LoginComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/before/registration',
        component: BeforeUserRegistrationComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/registration',
        // path: '/:id/registration',
        component: UserRegistrationComponent,
        beforeEnter: chkAuth,
    },
    // 소셜 로그인
    {
        path: '/social/login',
        component: SocialLoginComponent,
    },
    // 이메일
    {
        path: '/email/verify',
        component: VerifiedEmailComponent,
    },
    {
        path: '/email/verify/:id/:hash',
        component: VerifiedLoadingComponent,
    },
    // 비밀번호 찾기
    {
        path: '/find/pw/send-email',
        component: FindPasswordComponent,
    },
    {
        path: '/find/pw/:id/:hash',
        component: FindPasswordLoadingComponent,
    },
    {
        path: '/verify/pw/:id',
        component: VerifiedPasswordUpdateComponent,
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
    // 기타기타
    {
        path: '/loading',
        component: LoadingComponent, 
    },
    {
        path: '/search',
        component: SearchComponent,
    },
    {
        path: '/:catchAll(.*)',
        component: NotFoundComponent,
    },
    {
        path: '/board/:id/report',
        component: BoardDetailComponent,
    },
];


const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;