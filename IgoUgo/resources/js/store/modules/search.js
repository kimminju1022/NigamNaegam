import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        searchHotelList: [],
    }),
    mutations: {
        setSearchHotelList(state, data) {
            state.searchHotelList = data;
        },
    },
    actions: {
        searchHotel(context, data) {
            const url = `/api/search/hotel?search=${data.search}&page=${data.page}`;
            // const url = '/api/search/hotel';
            // const config = {
            //     params: {
            //         search: data.search,
            //         page: data.page
            //     },
            // }

            console.log('search.js :',data);
            console.log('url.js :',url);
            
            axios.get(url)
            .then(response => {
                // console.log('setSearchHotelList',response.data);
                context.commit('setSearchHotelList', response.data.hotel.data);
                // context.commit('pagination/setPagination', response.data.data, {root: true});

                router.push('/search');
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        searchBoard(context, data) {
            const url = `/api/search/board?search=${data.search}&page=${data.page}`;
            // const url = '/api/search/hotel';
            // const config = {
            //     params: {
            //         search: data.search,
            //         page: data.page
            //     },
            // }

            console.log('search.js :',data);
            console.log('url.js :',url);
            
            axios.get(url)
            .then(response => {
                // console.log('getUserQuestionList',response.data);
                context.commit('setSearchBoardList', response.data.hotel.data);
                // context.commit('pagination/setPagination', response.data.data, {root: true});

                router.push('/search');
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        // searchList(context, search) {
        //     // const url = `api/search?search=${search}`;
        //     const url = '/api/search';
        //     const config = {
        //         params: {
        //             search: search,
        //         },
        //     }
            
        //     axios.get(url, config)
        //     .then(response => {
        //         // console.log('getUserQuestionList',response.data);
        //         context.commit('setSearchList', response.data);
        //         // context.commit('pagination/setPagination', response.data.data, {root: true});

        //         router.push('/search');
        //     }) 
        //     .catch(error => {
        //         console.error(error);
        //     });
        // },
    },
    getters: {
    },
}