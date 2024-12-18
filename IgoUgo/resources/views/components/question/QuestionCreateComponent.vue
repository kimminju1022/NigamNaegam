<template>
    <!-- 작동btn  [목록과 취소가 같은것 아닐까?] -->
    <div class="board-create-head">
        <h2 style="margin: 30px 0; font-size: 3rem;">FAQ</h2>
        <div class="form-box">
            <button class="btn bg-clear board-create-btn" @click="cancelConfirm">취소</button>
            <button class="btn bg-navy board-create-btn" @click="doneConfirm">완료</button>
        </div>
        <!-- 선택박스 -->
    </div>
    <hr style="border: solid #01083a 2px;">
    <div class="board-create-container">
        <div class="board-create-title">
            <h3>제목</h3>
            <input type="text" name="title" placeholder="제목을 적어주세요" maxlength="100">
        </div>
        <hr>
        <textarea name="content" placeholder="어떤점이 궁금하신가요? 문의사항을 적어주세요" maxlength="2000"></textarea>
        <hr>
        <div class="board-create-file">
            <h3 class="board-create-fileChoice">파일첨부</h3>
            <input type="file" name="file" accept="imge/*">
        </div>            
        <!--미리보기 삭제기능추가 -->
        <div>
            사진미리보기
        </div>
        <hr>
    </div>
    <!-- 내용 -->

</template>

<script setup>
import router from '../../../js/router';


const cancelConfirm = () =>{
    const userResponse = confirm('작성 페이지에서 벗어납니다. 작성을 취소하시겠습니까?');
    if (userResponse) {
        router.push('/boards/question');
    }
}
const doneConfirm = () =>{
    const userResponse = confirm('작성을 완료하시겠습니까?');
    if (userResponse) {
        router.push('/boards/question/detail');
        // 이때, post로 정보 전달해줘야함...어떻게?
    }
}

// 모달 시러시러 예쁜모달 만들고 싶다...별점똥 좋아요똥똥
// export default {
//     name:'modal',
//     data(){
//         return{
//             modalopen : false,

            
//         }
//     }
// }

// 별점
// export default {
//     data() {
//         return {
//         rating: 0, // 실제 별점 값
//         hoverRating: 0, // 마우스 오버 시 임시 별점 값
//         stars: [1, 2, 3, 4, 5], // 별의 개수
//         };
//     },
//     computed: {
//   reversedStars() {
//           return [...this.stars].reverse(); // 배열 원본을 유지하면서 뒤집음
//         },
//     },
//     methods: {
//         setRating(star) {
//         this.rating = star; // 클릭한 별점 설정
//         this.submitRating(); // 서버에 전달
//         },
//         hoverRating(star) {
//         this.hoverRating = star; // 마우스 오버 시 임시 별점 표시
//         },
//         resetHover() {
//         this.hoverRating = 0; // 마우스가 떠나면 초기화
//         },
//         submitRating() {
//         // Laravel로 점수 전송
//         fetch("/api/rating", {
//             method: "POST",
//             headers: {
//             "Content-Type": "application/json",
//             },
//             body: JSON.stringify({ rating: this.rating }),
//         })
//         .then((response) => response.json())
//         .then((data) => {
//           console.log("별점 저장 성공:", data);
//         })
//         .catch((error) => {
//           console.error("별점 저장 실패:", error);
//         });
//     },
//   },
// };
// export default {
//   name: "Star-3",
//   data() {
//     return {
//       score: 0,
//     };
//   },
//   methods: {
//     check(index) {
//       this.score = index + 1;
//     },
//   },
// };
</script>

<style scoped>

.board-create-head{
    display: grid;
    grid-template-columns: 1fr 1fr;
    justify-content: center;
    column-gap: 10px;
    margin-bottom: 20px;
}
.board-create-head>h2{
    font-size: 2rem;
}

.form-box, .board-create-file{
    /* display: grid;
    grid-template-columns: repeat(3,1fr);
    margin-top: 20px;
    margin-bottom: 30px;
    text-align: center;
    align-items: flex-end;
    justify-content: left; */
    display: inline-flex;
    gap: 20px;
    justify-content:flex-end;
    align-items: flex-end;
    margin: 10px auto 30px auto;
}
/* .form-box>button{
    border-radius: 20px;
    width: 60px;
    height: 30px;
    font-size: large;
} */
.board-search-tb{
    display: inline-flex;
    justify-content:end;
    margin: 10px 20px;
    align-items: flex-end;
}
.board-search {
    margin-left: 20px; 
    background-color: #e9e8e8;
    border-radius: 20px;
    width: 250px;
    height: 31px;
    text-indent: 20px; 
}

.board-search-btn{
    font-size: large;
    border-radius: 20px;
    width: 70px;
    height: 30px;
    margin-left: -60px;
}
.board-create-btn{
    font-size: large;
    border: #01083a solid 1px;
    border-radius: 20px;
    width: 70px;
    height: 30px;
    gap: 50px;
    text-align: center;
}
.select-boardType, .select-categories, .board-create-title{
    display: inline-flex;
    justify-content:flex-end;
    margin: 10px 20px;
}
.board-create-title>input{
    font-size: 1.2rem;
    margin-left: 85px;
}
.board-create-container>textarea{
    width: 1200px;
    height: 400px;
    font-size: 1.2rem;
    border-radius: 20px;
    margin: 10px;
    padding: 20px;
    resize: none;
    align-items: center;
}
.select-boardType>#board-categories, .select-categories>#board-categories{
    width: 200px;
    border: none;
    border-bottom: solid 1px #01083a;
    text-align: center;
}
.select-boardType{
    gap: 60px;
}
.select-categories{
    gap: 40px;
}

.board-create-evaluation{
    display: flex;
}

/* 모달 */
/* 모달 시 메인 배경 */
.board-create-modal{
    width: 100%;
    height: 100%;
    background-color: rgba(197, 198, 198, 0.374);
    position: fixed;
    padding: 20px;
}
/* 모달 디자인 */
.board-create-modal-content{
    width: 50%;
    background-color: azure;
    border-radius: 10px;
    padding: 20px;
}
.modal-content {


background: white;
padding: 20px;
border-radius: 10px;


box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);


text-align: center;
width: 300px;
}


/* 별점 */
/* .star {
    appearance: none;
    padding: 1px;
}

.star::after {
    content: '☆';
    color: hsl(229, 100%, 48%);
    font-size: 20px;
}

.star:hover::after,
.star:has(~ .star:hover)::after,
.star:checked::after,
.star:has(~ .star:checked)::after {
    content: '★';
}

/* .star:hover ~ .star::after {
    content: '☆';
} */
/*.star-rating span {
  font-size: 30px;
  cursor: pointer;
  color: lightgray;
  transition: color 0.2s;
}

.star-rating span.filled {
color: gold;  채워진 별 
}

.star-rating span:hover,
.star-rating span:hover ~ span {
color: gold;  마우스 오버 시 별 
}
.star-3{
color: gold;
}
*/
@media screen and (max-width: 800px) {
    .board-detail-head {
        grid-template-columns: none; /*기존 가로 정렬 해제 */
        grid-template-rows: auto;  /*세로로 요소 쌓기 */
        align-items: center;  /*중앙 정렬 */
        text-align: center;  /*텍스트 중앙정렬 */
    }
}
</style>