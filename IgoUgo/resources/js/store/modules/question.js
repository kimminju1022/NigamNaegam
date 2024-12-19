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
        getQuestListPagenation(context){
            const url = '/api/question';
            const config = {
                a:{
                    'Authorization':'bearer' + localStorage.getItem('accessToken'),
                }
            }
            axios.get(url)
            .then()
            .catch();
    },
    getters: {

    },
}