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
    }
})