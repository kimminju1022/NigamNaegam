import { createRouter, createWebHistory } from 'vue-router';
import HotelListComponent from '../views/components/board/HotelListComponent.vue';
import LoginComponent from '../views/components/auth/LoginComponent.vue';
import UserRegistrationComponent from '../views/components/auth/UserRegistrationComponent.vue';
import ProductListComponent from '../views/components/board/ProductListComponent.vue';
import BoardListComponent from '../views/components/board/BoardListComponent.vue';
import BoardCreateComponent from '../views/components/board/BoardCreateComponent.vue';
import BoardUpdateComponent from '../views/components/board/BoardUpdateComponent.vue';
import NotFoundComponent from '../views/NotFoundComponent.vue';

const routes = [
  // 다른 경로와 컴포넌트 추가 가능
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