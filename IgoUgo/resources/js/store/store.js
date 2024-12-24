import { createStore } from 'vuex';
import user from './modules/user';
import auth from './modules/auth';
import board from './modules/board';
import question from './modules/question';
import hotel from './modules/hotel';
import pagination from './modules/pagination';
import product from './modules/product';

export default createStore({
    modules: {
        user,
        auth,
        board,
        question,
        hotel,
        pagination,
        product,
    }
})