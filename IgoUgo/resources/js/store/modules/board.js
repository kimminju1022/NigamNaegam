import axios from "../../axios";
import router from '../../router';

export default {
    namespaced: true,
    state: () => ({
        boardDetail: {},
        boardComments: [],
        commentsTotal:'',
        // commentsTotal: 0,
        bcName:'',
        rcName:'',
        productTitle:'',
        areaName:'',
        mapNames: {},
        boardList: [],
        bcCode: localStorage.getItem('boardBcType') ? localStorage.getItem('boardBcType') : '0',
        boardReview: [],
        boardFree: [],
        userReviewList: [],
        userFreeList: [],
        likesCount:'',
    }),
    mutations: {
        // 스테이트의 변수를 변경하기 위한 함수를 정의하는 영역
        setBoardDetail(state, data){
            // console.log('Board Detail State:', data); // 데이터 확인
            state.boardDetail = data;
        },
        setBoardDelete(state, id) {
            state.boardDetail = state.boardDetail.filter(item => item.board_id !== id);
        },
        setBoardComments(state, data) {
            state.boardComments = data;
        },
        setCommentsTotal(state, data) {
            state.commentsTotal = data;
        },
        setBcCode(state, bcCode) {
            state.bcCode = bcCode;
            localStorage.setItem('boardBcType', bcCode);
        },
        setBoardList(state, boardList) {
            state.boardList = boardList;
        },
        setBoardReview(state, boardReview) {
            state.boardReview = boardReview;
        },
        setBoardFree(state, boardFree) {
            state.boardFree = boardFree;
        },
        setBcName(state, bcName) {
            state.bcName = bcName;
        },
        setProductTitle(state, title){
            state.productTitle = title;
        },
        setRcName(state, rcName) {
            state.rcName = rcName;
        },
        setAreaName(state, areaName) {
            state.areaName = areaName;
        },
        setUserReviewList(state, userReviewList) {
            state.userReviewList = userReviewList;
        },
        setUserFreeList(state, userFreeList) {
            state.userFreeList = userFreeList;
        },
        setRemoveBoardComment(state, id) {
            state.boardComments = state.boardComments.filter(item => item.comment_id !== id);
        },
        setPushBoardComment(state, data) {
            state.boardComments.push(data);
        },
        // setLikesCount(state,likeFlg){
        //     state.likeFlg = state.boardDetail.
        // },

    },
    actions: {
        /** 게시글획득
         *  @param{*} context
         * @param{int} id
        */
        getBoardListPagination(context, searchData) {
            return new Promise((resolve, reject) => {
                const url = '/api/boards';
                const config = {
                    params: searchData
                };
                
                axios.get(url, config)
                .then(response =>{
                    // console.log(response);
                    context.commit('setBcName', response.data.bcName);
                    context.commit('setBoardList', response.data.boardList.data);
                    context.commit('pagination/setPagination', response.data.boardList, {root: true});
                    // context.commit('setProductTitle',response.data.productTitle);
                    // context.commit('setboardCategories', response.data.boardCategoryBctype.data);
                    // context.commit('setboardCategoryArea', response.data.boardCategoryArea.data);

                    return resolve();
                })
                .catch(error => {
                    console.error(error);
                    return reject();
                });
            });
        },
        showBoardDetail(context, id) {
            const url = '/api/boards/'+ id;
            
            axios.get(url)
            .then(response => {
                console.log(response.data); 
                context.commit('setBoardDetail', response.data.board);
                context.commit('setBcName', response.data.bcName);
                context.commit('setRcName', response.data.rcName);
                context.commit('setAreaName', response.data.areaName);
                context.commit('setProductTitle',response.data.productTitle);
                console.log(response.data.board);
            })
            .catch(error => {
                // console.error(error.response.data);
            });
        },
        
        /** 게시글 작성
         * 
         */
        storeBoard(context, data){
            const url = '/api/boards';
            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }
            
            const formData = new FormData();
            formData.append('bc_code', data.bc_code);
            formData.append('board_title', data.board_title);
            formData.append('board_content', data.board_content);
            if(data.board_img) {
                data.board_img.forEach(file => formData.append('board_img[]', file));
            }
            if(data.bc_code) {
                formData.append('bc_code', data.bc_code);
            } 
            if(data.area_code) {
                formData.append('area_code', data.area_code);
            }
            if(data.rate) {
                formData.append('rate', data.rate);
            }
            // console.log(data);

            axios.post(url,formData, config)
            .then(response => {
                // console.log(response);
                // console.log(response.data.review);
                
                // context.commit('setBoardList', response.data.data);
                
                router.replace('/boards');
            })
            .catch(error => {
                console.error(error.response.data);
            });
        },
        postBoardCreate(context){
            const url = '/api/boards/create';
            const config = {
                header: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.get(url, config)
            .then()
            .catch();
        },
        /** 게시글 수정
         * 
         */
        boardUpdate(context, boardInfo){
            // console.log(boardInfo.boardDetail);
            const url = `/api/boards/${boardInfo.boardDetail.board_id}`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                    'Content-Type': 'multipart/form-data',
                }
            }
            const formData = new FormData();
            formData.append('bc_code', boardInfo.boardDetail.bc_code);
            formData.append('board_title', boardInfo.boardDetail.board_title);
            formData.append('board_content', boardInfo.boardDetail.board_content);
            
            boardInfo.boardDetail.board_img.forEach((file) => {
                formData.append('board_img[]', file);
            });  //3rd
            
            // if(boardInfo.boardDetail.board_img) {
            //     formData.append('board_img', boardInfo.boardDetail.board_img);
            // }2nd

            if(boardInfo.boardDetail.bc_code) {
                formData.append('bc_code', boardInfo.boardDetail.bc_code);
            } 
            if(boardInfo.boardDetail.area_code) {
                formData.append('area_code', boardInfo.boardDetail.area_code);
            }
            if(boardInfo.boardDetail.rate) {
                formData.append('rate', boardInfo.boardDetail.rate);
            }

            // console.log('formData는', formData);

            axios.post(url, formData, config)
            .then(response => {
                // context.commit('setBcCode', response.data.bcCode);
                context.commit('setBoardDetail', response.data.board);
                context.commit('setBcName', response.data.bcName);
                context.commit('setRcName', response.data.rcName);
                context.commit('setAreaName', response.data.areaName);

                alert('수정 성공');
                router.replace(`/boards/${boardInfo.boardDetail.board_id}`);
            })
            .catch(error => {
                alert('수정 실패');
                console.error(error.response.data);
            });
        },
        
        /** 게시글 삭제
         * 
         */
        boardDelete(context, id) {
            const url = `/api/boards/${id}`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.delete(url, config)
            .then(response => {
                commit('setBoardDelete',data.board_id)
                alert('삭제 성공');
            })
            .catch(error => {
                console.error(error);
                alert('삭제 실패');
            });
        },

        /**게시글 신고 */
        boardReport(context) {
            const url = `/api/board/${id}/report`;
            const config = {
                header:{
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }
            axios.get(url)
            .then()
            alert('신고가 접수되었습니다\n관리자 검증 후 조치하도록 하겠습니다')

            .catch(error => {
                alert('신고가 불가합니다\n관리자에게 직접 문의 바랍니다')
            });
        },

        boardReview(context) {
            const url = '/api/boards/review';

            axios.get(url)
            .then(response => {
                // console.log('boardReview',response.data);
                // console.log('boardReview', response.data.boardReview);
                context.commit('setBoardReview', response.data.boardReview);
            })
            .catch(error => {
                console.log(error.response);
            });
        },

        boardFree(context) {
            const url = '/api/boards/free';

            axios.get(url)
            .then(response => {
                // console.log('boardFree',response.data);
                context.commit('setBoardFree', response.data.boardFree);
            })
            .catch(error => {
                console.log(error.response.data);
            });
        },

        // --------------------------- meerkat Start ---------------------------
        // 댓글 ------------------------------------start
        // 댓글 작성
        storeComment({state, rootGetters, commit}, data){
            return new Promise(resolve => {
                const url = '/api/comments';
                const config = {
                    headers: {
                        'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                    }
                }
    
                // console.log(data);
    
                axios.post(url, JSON.stringify(data), config)
                .then(response => {
                    // commit('setCommentsTotal', state.commentsTotal + 1);
                    // console.log(response.data);
                    // console.log(response.data.board);
                    // console.log(response.data.review);
                    
                    if(state.boardComments.length < 10) {
                        commit('setPushBoardComment', response.data.comment);
                    } else {
                        commit('pagination/setPaginationRegulation', rootGetters['pagination/getPlusOneLastPage'], {root: true});
                    }
                })
                .catch(error => {
                    console.error(error);
                })
                .finally(() => resolve());
            });
        },
        /**
         *  댓글 획득
         */
        boardCommentPagination(context, searchData) {
            return new Promise(resolve => {
                const url = '/api/comments';
                const config = {
                    params: searchData
                };

                axios.get(url, config)
                .then(response =>{
                    context.commit('setBoardComments', response.data.comments.data);
                    // context.commit('', response.data.comments.total);
                    context.commit('pagination/setPagination', response.data.comments, {root: true});
                })
                .catch(error => {
                    console.error(error);
                })
                .finally(() => resolve());
            });
        },
        /**
         * 댓글 삭제
         */
        commentsDelete({state, commit, dispatch}, data) {
            const url = `/api/comments/${data.comment_id}`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }

            axios.delete(url, config)
            .then(response => {                
                let prevCurrentPage = state.boardComments.length <= 1 ? data.page - 1 : data.page;

                // 댓글 리스트 다시 불러오기
                dispatch('boardCommentPagination', {board_id: data.board_id, page: prevCurrentPage})
                .then(() => {
                    alert('삭제 성공');
                });
            })
            .catch(error => {
                console.error(error);
                alert('삭제 실패');
            });
        },
        commentReport(context, comment_id) {
            const url = `/api/comments/${comment_id}/report`; //해당 댓글id
            const config = {
                headers:{
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                }
            }
            axios.post(url, null, config)
            .then(response => {
                alert('신고가 접수되었습니다\n관리자 검증 후 조치하도록 하겠습니다');
            })
            .catch(error => {
                alert('신고가 불가합니다\n관리자에게 직접 문의 바랍니다')
            });
        },

        // --------------------------- meerkat End ---------------------------


        /** 게시글획득
         *  @param{*} context
         * @param{int} id
        */
        // getBoardListPagination(context, searchData) {
        //     return new Promise((resolve, reject) => {
        //         const url = '/api/boards';
        //         const config = {
        //             params: searchData
        //         };
                
        //         axios.get(url, config)
        //         .then(response =>{
        //             console.log(response);
        //             context.commit('setBcName', response.data.bcName);
        //             context.commit('setBoardList', response.data.boardList.data);
        //             context.commit('pagination/setPagination', response.data.boardList, {root: true});
        //             // context.commit('setboardCategories', response.data.boardCategoryBctype.data);
        //             // context.commit('setboardCategoryArea', response.data.boardCategoryArea.data);
        //             // return resolve();
        //         })
        //         .catch(error => {
        //             console.error(error);
        //             // return reject();
        //         });
        //     });
        // },

        // 유저별 리뷰게시글 내역
        userReviewList(context, searchData) {
            const url = `/api/user/review/${searchData.user_id}`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                },
                params: searchData,
            }
            
            axios.get(url, config)
            .then(response => {
                // console.log('userReviewList',response.data);
                context.commit('setUserReviewList', response.data.board.data);
                context.commit('pagination/setMyPageBoardPagination', response.data.board, {root: true});
            }) 
            .catch(error => {
                console.error(error);
            });

        },
        
        // 유저별 자유게시글 내역
        userFreeList(context, searchData) {
            const url = `/api/user/free/${searchData.user_id}`;
            const config = {
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('accessToken'),
                },
                params: searchData,
            }
            
            axios.get(url, config)
            .then(response => {
                // console.log('userFreeList',response.data);
                context.commit('setUserFreeList', response.data.board.data);
                context.commit('pagination/setMyPageBoardPagination', response.data.board, {root: true});
            }) 
            .catch(error => {
                console.error(error);
            });
        },
    },
        
    getters: {
    }
}
