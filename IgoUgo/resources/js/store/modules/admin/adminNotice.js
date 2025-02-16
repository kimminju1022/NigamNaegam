import axios from "../../../axios";
import router from "../../../router";

export default {
    namespaced: true,
    state: () => ({
        noticeList: [],
        noticeDetail: null,
    }),
    mutations: {
        setNoticeList(state, noticeList) {
            state.noticeList = noticeList;
        },
        setNoticeDetail(state, noticeDetail) {
            state.noticeDetail = noticeDetail;
        },
    },
    actions: {
        // 공지사항 리스트
        noticeList(context, searchData) {
            const url = '/api/admin/notice';
            const config = {
                params: searchData,
            }
            axios.get(url, config)
            .then(response => {
                // console.log('noticeList',response.data.data.data);
                context.commit('setNoticeList', response.data.data.data);
                context.commit('pagination/setPagination', response.data.data, {root: true});
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        // 게시글 상세
        noticeDetail(context, data) {
            const url = `/api/admin/notice/${data.board_id}`;

            axios.get(url)
            .then(response => {
                // console.log(response.data);
                context.commit('setNoticeDetail', response.data.data);
            })
            .catch(error => {
                console.error(error);
            });
        },

        // 게시글 작성
        storeNotice(context, data) {
            const url = '/api/admin/notice';
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }
            // console.log(data);

            const formData = new FormData();
            formData.append('board_title', data.board_title);
            formData.append('board_content', data.board_content);
            
            // 이미지 배열 넘기기
            if (data.board_img && data.board_img.length > 0) {
                data.board_img.forEach((file) => {
                    formData.append('board_img[]', file);
                });
            }

            axios.post(url, formData, config)
            .then(response => {
                // console.log(response.data);                
                context.commit('setNoticeList', response.data.data.data);
                
                router.replace('/admin/notice');
            })
            .catch(error => {
                console.error(error);
            });
        },

        // 게시글 수정
        updateNotice(context, data) {
            const url = `/api/admin/notice/${data.noticeDetail.board_id}`;
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                },
            }
            // console.log('data : ',data);

            const formData = new FormData();
            formData.append('board_title', data.testerDetail.board_title);
            formData.append('board_content', data.testerDetail.board_content);     
            formData.append('user_id', data.user_id);
            formData.append('board_id', data.board_id);

            // 이미지 배열 넘기기
            if (data.noticeDetail.board_images && data.noticeDetail.board_images.length > 0) {
                data.noticeDetail.board_images.forEach((image) => {
                    formData.append('board_img_path[]', image.board_img);
                });
            }

            if (data.board_img && data.board_img.length > 0) {
                data.board_img.forEach((file) => {
                    formData.append('board_img_file[]', file);
                });
            }

            // console.log('board_images', question.questionDetail.board_images);
            // console.log('file', question.board_img);

            axios.post(url, formData, config)
            .then(response => {
                // console.log(response.data);
                context.commit('setNoticeList', response.data.board);

                alert('수정 성공');
                router.replace(`/admin/notice/${data.noticeDetail.board_id}`);
                }
            )
            .catch(error => {
                alert('수정 실패');
                console.error(error.response.data);
            });
        },

        // 게시글 삭제
        destroyNotice(context, id) {
            const url = `/api/admin/notice/${id}`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.delete(url, config)
            .then(response => {
                alert('삭제 성공');
                router.push('/admin/notice');
            })
            .catch(error => {
                console.error(error.response.data);
                alert('삭제 실패');
            });
        },   
    },
    getters: {
    },
}