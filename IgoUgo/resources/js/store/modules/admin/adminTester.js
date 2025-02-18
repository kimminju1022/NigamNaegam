import axios from "../../../axios";
import router from '../../../router';

export default {
    namespaced: true,
    state: () => ({
        boardList: [],
        testerList: [],
        boardDetail: null,
    }),
    mutations: {
        setBoardList(state, boardList) {
            state.boardList = boardList;
        },
        setTesterList(state, testerList) {
            state.testerList = testerList;
        },
        setBoardDetail(state, boardDetail) {
            state.boardDetail = boardDetail;
        },
    },
    actions: {
        // 체험단 게시글 리스트
        testerList(context, searchData) {
            const url = '/api/admin/tester';
            const config = {
                params: searchData,
            }

            axios.get(url, config)
            .then(response => {
                // console.log(response.data);
                context.commit('setBoardList', response.data.data.data);
                context.commit('pagination/setPagination', response.data.data, {root: true});
            }) 
            .catch(error => {
                console.error(error);
            });
        },

        // 게시글 상세
        testerDetail(context, data) {
            const url = `/api/admin/tester/${data.board_id}`;
            const config = {
                params: data,
            }

            axios.get(url, config)
            .then(response => {
                // console.log(response.data);
                context.commit('setBoardDetail', response.data.data);
            })
            .catch(error => {
                console.error(error.response.data);
            });
        },

        // 체험단 작성
        storeTester(context, data) {
            const url = '/api/admin/tester';
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
            formData.append('tester_place', data.tester_place);     
            formData.append('tester_area', data.tester_area);
            formData.append('tester_code', data.tester_code);
            formData.append('tester_name', data.tester_name);
            formData.append('due_date', data.due_date);
            
            // 이미지 배열 넘기기
            if (data.board_img && data.board_img.length > 0) {
                data.board_img.forEach((file) => {
                    formData.append('board_img[]', file);
                });
            }

            axios.post(url, formData, config)
            .then(response => {
                // console.log(response.data);                
                context.commit('setBoardList', response.data.board);
                context.commit('setTesterList', response.data.tester);
                
                router.replace('/admin/tester');
            })
            .catch(error => {
                console.error(error.response.data);
            });
        },

        // 게시글 수정
        updateTester(context, data) {
            const url = `/api/admin/tester/${data.testerDetail.board_id}`;
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                },
            }
            console.log('updateTester data : ',data);

            const formData = new FormData();
            formData.append('board_title', data.testerDetail.board_title);
            formData.append('board_content', data.testerDetail.board_content);     
            formData.append('tester_place', data.testerDetail.tester_management.tester_place);     
            formData.append('tester_area', data.testerDetail.tester_management.tester_area);
            formData.append('tester_code', data.testerDetail.tester_management.tester_code);
            formData.append('tester_name', data.testerDetail.tester_management.tester_name);
            formData.append('due_date', data.testerDetail.tester_management.dd);
            formData.append('user_id', data.user_id);
            formData.append('board_id', data.board_id);

            // 이미지 배열 넘기기
            if (data.testerDetail.board_images && data.testerDetail.board_images.length > 0) {
                data.testerDetail.board_images.forEach((image) => {
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
                context.commit('setBoardList', response.data.board);
                // console.log(response);
                // console.log(response.data);

                alert('수정 성공');
                router.replace(`/admin/tester/${data.testerDetail.board_id}`);
                }
            )
            .catch(error => {
                alert('수정 실패');
                console.error(error.response.data);
            });
        },

        // 게시글 삭제
        destroyTester(context, id) {
            const url = `/api/admin/tester/${id}`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.delete(url, config)
            .then(response => {
                alert('삭제 성공');
                router.push('/admin/tester');
            })
            .catch(error => {
                console.error(error.response);
                alert('삭제 실패');
            });
        },   
    },
    getters: {

    },
}