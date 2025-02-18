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
// 체험단
import TesterListComponent from '../views/components/tester/TesterListComponent.vue';
import TesterDetailComponent from '../views/components/tester/TesterDetailComponent.vue';
// 공지사항
import NoticeListComponent from '../views/components/notice/NoticeListComponent.vue';
import NoticeDetailComponent from '../views/components/notice/NoticeDetailComponent.vue';
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
import AdminUserManageDetailComponent from '../views/adminComponents/user/UserManageDetailComponent.vue';

// 게시판 관리
import AdminReviewManageComponent from '../views/adminComponents/board/ReviewManageComponent.vue';
import AdminFreeManageComponent from '../views/adminComponents/board/FreeManageComponent.vue';
import AdminBoardDetailComponent from '../views/adminComponents/board/AdminBoardDetailComponent.vue';

// 체험단
import AdminTesterComponent from '../views/adminComponents/tester/TesterComponent.vue';
import AdminTesterDetailComponent from '../views/adminComponents/tester/TesterDetailComponent.vue';
import AdminTesterCreateComponent from '../views/adminComponents/tester/TesterCreateComponent.vue';
import AdminTesterUpdateComponent from '../views/adminComponents/tester/TesterUpdateComponent.vue';

// 공지사항
import AdminNoticeComponent from '../views/adminComponents/notice/NoticeManageComponent.vue';
import AdminNoticeDetailComponent from '../views/adminComponents/notice/NoticeDetailComponent.vue';
import AdminNoticeCreateComponent from '../views/adminComponents/notice/NoticeCreateComponent.vue';
import AdminNoticeUpdateComponent from '../views/adminComponents/notice/NoticeUpdateComponent.vue';

// 문의 관리
import AdminQuestionManageComponent from '../views/adminComponents/question/QuestionManageComponent.vue';
import AdminQuestionManageDetailComponent from '../views/adminComponents/question/QuestionManageDetailComponent.vue';
import AdminFreeDetailComponent from '../views/adminComponents/board/AdminFreeDetailComponent.vue';

// 댓글 관리
import AdminCommentMangeComponent from '../views/adminComponents/comment/CommentManageComponent.vue';
import AdminCommentMangeDetailComponent from '../views/adminComponents/comment/CommentManageDetailComponent.vue';

const chkAuth = (to, from, next) => {

    // 유저가 로그인없이 이용가능한 페이지
    const userSitePathRegexList = [
        /^\/$/
        ,/^\/login$/
        ,/^\/registration$/
        ,/^\/before\/registration$/
        ,/^\/email\/verify$/
        ,/^\/social\/login$/
        ,/^\/email\/verify\/[0-9]+\/[a-z0-9]+$/
        ,/^\/find\/pw\/send-email$/
        ,/^\/find\/pw\/[0-9]+\/[a-z0-9]+$/
        ,/^\/verify\/pw\/[0-9]+$/
        ,/^\/hotels$/
        ,/^\/hotels\/map$/
        ,/^\/hotels\/[0-9]+$/
        ,/^\/products$/
        ,/^\/products\/[0-9]+$/
        ,/^\/products\/[0-9]+\/[0-9]+$/
        ,/^\/boards$/
        ,/^\/boards\/[0-9]+$/
        ,/^\/questions$/
        ,/^\/search$/
        ,/^\/testers$/
        ,/^\/testers\/[0-9]+$/
        ,/^\/notices$/
        ,/^\/notices\/[0-9]+$/
    ];

    const store = useStore();
    const authFlg = store.state.auth.authFlg;
    const managerAuthFlg = store.state.auth.managerAuthFlg;
    const noAuthPassFlg = userSitePathRegexList.some(item => item.test(to.path));
    const managerNoAuthPassFlg = (to.path === '/admin');
    const adminRegex = /admin/;

    if(!authFlg) { // 로그인 X
        if(!managerAuthFlg) { // 매니저 X
            if(!adminRegex.test(to.path)) { // path에 'admin 포함 X'
                if(!noAuthPassFlg) {
                    alert('로그인 후 이용가능');
                    window.location = '/login';
                } else if(noAuthPassFlg) {
                    next();
                }
            } else if(adminRegex.test(to.path)) { // path에 'admin 포함 O'
                if(!managerNoAuthPassFlg) {
                    window.location = '/';
                } else {
                    next();
                }
            }
        } else if(managerAuthFlg) { // 매니저 O
            if(!adminRegex.test(to.path)) { // path에 'admin 포함 X'
                alert('관리자는 이용불가능');
                window.location = '/admin/main';
            } else if(adminRegex.test(to.path)) { // path에 'admin 포함 O'
                if(managerNoAuthPassFlg) {
                    next('/admin/main');
                } else if (!managerNoAuthPassFlg) {
                    next();
                }
            }
        }
    } else if(authFlg) { // 로그인 O -> 일반유저
        if(to.path === '/') {
            next();
        }else if(!adminRegex.test(to.path)) { // path에 'admin 포함 X'
            if(!noAuthPassFlg) {
                next();
            } else if(noAuthPassFlg) {
                next();
            }
        }else if(adminRegex.test(to.path)) { // path에 'admin 포함 O'
            window.location = '/';
        }
    }
}

const routes = [
    // admin
    // 관리자 페이지_로그인
    {
        path: '/admin',
        component: AdminLoginComponent,
        beforeEnter: chkAuth,
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
    {
        path: '/admin/user/:id',
        component: AdminUserManageDetailComponent,
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
    {
        path: '/admin/tester/:id',
        component: AdminTesterDetailComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/admin/tester/create',
        component: AdminTesterCreateComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/admin/tester/:id/edit',
        component: AdminTesterUpdateComponent,
        beforeEnter: chkAuth,
    },
    // 관리자 페이지_공지사항
    {
        path: '/admin/notice',
        component: AdminNoticeComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/admin/notice/:id',
        component: AdminNoticeDetailComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/admin/notice/create',
        component: AdminNoticeCreateComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/admin/notice/:id/edit',
        component: AdminNoticeUpdateComponent,
        beforeEnter: chkAuth,
    },
    // 관리자 페이지_문의 관리
    {
        path: '/admin/question',
        component: AdminQuestionManageComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/admin/question/:id',
        component: AdminQuestionManageDetailComponent,
        beforeEnter: chkAuth,
    },
    // 관리자 페이지_게시판_상세
    {
        path: '/admin/board/review/:boardid',
        component: AdminBoardDetailComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/admin/board/free/:boardid',
        component: AdminFreeDetailComponent,
        beforeEnter: chkAuth,
    },
    // 관리자 페이지_댓글 관리
    {
        path: '/admin/comment',
        component: AdminCommentMangeComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/admin/comment/:commentid',
        component: AdminCommentMangeDetailComponent,
        beforeEnter: chkAuth,
    },

    // ---------------------------------------------------------------------------------------------

    // 유저사이트
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
        beforeEnter: chkAuth,
    },
    {
        path: '/email/verify/:id/:hash',
        component: VerifiedLoadingComponent,
        beforeEnter: chkAuth,
    },
    // 비밀번호 찾기
    {
        path: '/find/pw/send-email',
        component: FindPasswordComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/find/pw/:id/:hash',
        component: FindPasswordLoadingComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/verify/pw/:id',
        component: VerifiedPasswordUpdateComponent,
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
        component: HotelListComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/hotels/map',
        component: HotelMapComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/hotels/:contentid',
        component: HotelListDetailComponent,
        beforeEnter: chkAuth,
    },
    // 상품
    {
        path: '/products',
        component: ProductMainComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/products/:contenttypeid',
        component: ProductListComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/products/:contenttypeid/:contentid',
        component: ProductDetailComponent,
        beforeEnter: chkAuth,
    },
    // 게시판
    {
        path: '/boards',
        component: BoardListComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/boards/:id',
        component: BoardDetailComponent,
        beforeEnter: chkAuth,
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
        beforeEnter: chkAuth,
    },
    {
        path: '/questions/create',
        component: QuestionCreateComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/questions/:id',
        component: QuestionDetailComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/questions/:id/edit',
        component: QuestionUpdateComponent,
        beforeEnter: chkAuth,
    },
    // 체험단
    {
        path: '/testers',
        component: TesterListComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/testers/:id',
        component: TesterDetailComponent,
        beforeEnter: chkAuth,
    },
    // 공지사항
    {
        path: '/notices',
        component: NoticeListComponent,
        beforeEnter: chkAuth,
    },
    {
        path: '/notices/:id',
        component: NoticeDetailComponent,
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
        beforeEnter: chkAuth,
    },
    {
        path: '/:catchAll(.*)',
        component: NotFoundComponent,
    },
    // {
    //     path: '/board/:id/report',
    //     component: BoardDetailComponent,
    // },
];


const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;