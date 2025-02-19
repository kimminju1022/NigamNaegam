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
import tester from './modules/tester';
import comment from './modules/comment';
import notice from './modules/notice';
import productSearch from './modules/productSearch'; // add meerkat

// 관리자
import userManage from './modules/admin/userManage'
import chart from './modules/admin/chart'
import adminQuestion from './modules/admin/adminQuestion';
import adminBoard from './modules/admin/adminBoard';
import adminTester from './modules/admin/adminTester';
import adminNotice from './modules/admin/adminNotice';
import adminComment from './modules/admin/adminComment';

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
        tester,
        notice,
        comment,
        productSearch, // add meerkat
        // 관리자
        userManage,
        chart,
        adminQuestion,
        adminBoard,
        adminComment,
        adminTester,
        adminNotice,
    }
})