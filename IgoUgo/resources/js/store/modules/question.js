import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        boardList: [],
    }),
    mutations: {
        setBoardList(state, boardList) {
            state.boardList = boardList;
        },
    },
    actions: {
        /** 게시글획득
         *  @param{*} context
        */

        // 유저 1:1 문의내역
        getUserQuetionList(context,userInfo) {}
    },
    getters: {
    
    },
}