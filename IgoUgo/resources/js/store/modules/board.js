import axios from "../../axios";
// import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        
    }),
    mutations: {

    },
    actions: {
        /** 게시글획득
         *  @param{*} context
        */
        getBoardListPagenation(context){
            const url = '/api/boards';
            const config = {
                headers:{
                    'Authorization':'bearer' + localStorage.getItem('accessToken'),
                }
            }
            axios.get(url)
            .then()
            .catch();
        },
    },
    getters: {

    },
}