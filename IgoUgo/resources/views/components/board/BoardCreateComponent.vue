<template>
    <!-- 작동btn  [목록과 취소가 같은것 아닐까?] -->
    <div class="board-create-head">
        <h2>board title</h2>
        <div class="form-box">
            <router-link to="/boards"><button class="btn bg-navy board-create-btn">목록</button></router-link>
            <router-link to="/boards"><button class="btn bg-navy board-create-btn">취소</button></router-link>
            <router-link to="/boards"><button class="btn bg-navy board-create-btn">완료</button></router-link>
        </div>
        <!-- 선택박스 -->
    </div>
    <hr>
    <div class="select-boardType">
        <h3>게시판</h3>
        <select name="board-categories" id="board-categories">
            <!-- v-model="SelectedBoardCategory"  -->
            <option value="1">리뷰게시판</option>
            <option value="2">자유게시판</option>
        </select>
    </div>
    <hr>
    <div class="select-categories">
        <h3 for="board-category">방문정보</h3>
        <div id="board-search-tb">
            <input class="board-search" type="text" placeholder="검색어를 입력해 주세요">
            <!-- v-model="search" -->
            <button class="btn bg-navy board-search-btn">검색</button>
        </div>  
        <!-- 모달 -->
        <div class="board-create-modal">
            <div class="board-create-modal-content">
                <h2>shopName</h2>
                <h4>adress</h4>
                <p>content</p>
                <!-- 지도 넣어? 말어? -->
            </div>
        </div>
        <div class="board-create-evaluation">
            <h3 style="margin-right: 20px;">별점</h3>
            <input type="radio" class="star" value="1">
            <input type="radio" class="star" value="2">
            <input type="radio" class="star" value="3">
            <input type="radio" class="star" value="4">
            <input type="radio" class="star" value="5">
        </div>
        <!-- <div class="star-rating">
            <span
            v-for="star in reversedStars"
            :key="star"
            :class="{ filled: star <= rating }"
            @click="setRating(star)"
            @mouseover="hoverRating(star)"
            @mouseleave="resetHover"
            >
            ★
            </span>
            <p>현재 별점: {{ rating }}</p>
        </div>
        <hr>
        <div class="star-3rd">
            <div class="star-3rating">
            <div
                class="star-3"
                v-for="index in 5"
                :key="index"
                @click="check(index)"
            >
                <span v-if="index < score">★</span>
                <span v-if="index >= score">☆</span>
            </div>
            </div>
        </div>
        <hr> -->
    </div>
    <hr>
    <div class="board-create-container">
        <div class="board-create-title">
            <h3>제목</h3>
            <input type="text" name="title" placeholder="제목을 적어주세요" maxlength="100">
        </div>
        <hr>
        <textarea name="content" placeholder="당신의 이야기를 여기에 적어주세요" maxlength="2000"></textarea>
        <div class="board-create-file">
            <h3>파일첨부</h3>
            <input type="file" name="file" accept="imge/*">
        </div>            
    </div>
    <!-- 내용 -->

</template>

<script setup>
// 모달
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
div{
    box-sizing: border-box;
}
h3{
    font-size: 1.5rem;
}
.board-create-head{
    display: grid;
    grid-template-columns: 1fr 1fr;
    justify-content: center;
    column-gap: 10px;
    margin: 50px auto 20px auto;

}
.board-create-head>h2{
    font-size: 2rem;
}

.form-box{
    /* display: grid;
    grid-template-columns: 1fr;
    margin-top: 20px;
    margin-bottom: 30px;
    align-items: flex-end;
    justify-content: left; */
    display: inline-flex;
    gap: 20px;
    justify-content:end;

}
.form-box>button{
    border-radius: 20px;
    width: 60px;
    height: 30px;
    font-size: large;
}
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
    border-radius: 20px;
    width: 70px;
    height: 30px;
    gap: 50px;
}
.select-boardType, .select-categories, .board-create-title{
    display: inline-flex;
    justify-content:end;
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
    background-color: rgba(255, 254, 248, 0.836);
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
@media screen and (max-width: 800px) {
    .board-detail-head {
        grid-template-columns: none; 기존 가로 정렬 해제 
        grid-template-rows: auto;  세로로 요소 쌓기 
        align-items: center;  중앙 정렬 
        text-align: center;  텍스트 중앙정렬 
    }
} */
</style>