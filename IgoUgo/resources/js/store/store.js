import { createStore } from 'vuex';
import user from './modules/user';
import auth from './modules/auth';
import board from './modules/board';
import question from './modules/question';

export default createStore({
    modules: {
        user,
        auth,
        board,
        question,
    }
})