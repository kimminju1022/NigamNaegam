import { createRouter, createWebHistory } from 'vue-router';
import HotelListComponent from '../views/components/board/HotelListComponent.vue';

const routes = [
  // 다른 경로와 컴포넌트 추가 가능
  {
    path: '/',
    redirect: 'login',
  },
  {
    path: '/login',
    component: LoginComponent,
  },
  {
    path: '/registration',
    component: UserRegistrationComponent,
  },
  {
    path: '/hotels',
    component: HotelListComponent,
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
    path: '/boards/create',
    component: BoardCreateComponent,
  },
  {
    path: '/boards/update',
    component: BoardUpdateComponent,
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