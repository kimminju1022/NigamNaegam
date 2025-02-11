import { createStore } from 'vuex';
import user from './modules/user';
import auth from './modules/auth';
import board from './modules/board';
import question from './modules/question';
import hotel from './modules/hotel';
import pagination from './modules/pagination';
import product from './modules/product';
import verification from './modules/verification';
import map from './modules/map';
import loading from './modules/loading';
import search from './modules/search';
import userManage from './modules/admin/userManage'
import chart from './modules/admin/chart'
import adminQuestion from './modules/admin/adminQuestion';

export default createStore({
    modules: {
        user,
        auth,
        board,
        question,
        hotel,
        pagination,
        product,
        verification,
        map,
        loading,
        search,
        // 관리자
        userManage,
        chart,
        adminQuestion,
    }
})