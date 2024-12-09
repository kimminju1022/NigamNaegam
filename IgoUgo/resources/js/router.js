import { createRouter, createWebHistory } from 'vue-router';
import HotelListComponent from '../views/components/board/HotelListComponent.vue';

const routes = [
  {
    path: '/hotels',
    component: HotelListComponent,
  },
  // 다른 경로와 컴포넌트 추가 가능
];


const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;