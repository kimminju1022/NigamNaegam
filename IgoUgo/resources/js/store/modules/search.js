import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        searchList: [],
    }),
    mutations: {
        setSearchList(state, searchList) {
            state.searchList = searchList;
        },
    },
    actions: {
        search(context, search) {
            // const url = `api/search?search=${search}`;
            const url = '/api/search';
            // const config = {
            //     params: {
            //         search: search,
            //     },
            // }

            console.log('search.js :',search);
            console.log('url.js :',url);
            
            axios.get(url)
            .then(response => {
                // console.log('getUserQuestionList',response.data);
                context.commit('setSearchList', response.data);
                // context.commit('pagination/setPagination', response.data.data, {root: true});

                router.push('/search');
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        searchList(context, search) {
            const url = `api/search?search=${search}`;
            // const url = '/api/search';
            // const config = {
            //     params: {
            //         search: search,
            //     },
            // }
            
            axios.get(url)
            .then(response => {
                // console.log('getUserQuestionList',response.data);
                context.commit('setSearchList', response.data);
                // context.commit('pagination/setPagination', response.data.data, {root: true});

                router.push('/search');
            }) 
            .catch(error => {
                console.error(error);
            });
        },
    },
    getters: {
    },
}