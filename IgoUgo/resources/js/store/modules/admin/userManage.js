import axios from "../../../axios";

export default {
    namespaced: true,
    state: () => ({
        userList: [],
    }),
    mutations: {
        setUserList(state, list) {
            state.userList = list;
        },
    },
    actions: {
        showUserList(context, searchData) {
            const url = '/api/admin/user';
            const config = {
                params: searchData,
            }

            axios.get(url, config)
            .then(response => {
                context.commit('setUserList', response.data.userList.data);
                context.commit('pagination/setPagination', response.data.userList, {root: true});
            })
            .catch(error => {
                console.log(error);
            });
        },
    },
    getters: {
    
    },
}