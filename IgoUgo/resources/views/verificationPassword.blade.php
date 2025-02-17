<!DOCTYPE html>
<html>
<head>
    <title>이메일 인증</title>
    <style>
    *{ 
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'MinSans-Regular';
    }

    @font-face {
        font-family: 'MinSans-Regular';
        src: url('https://fastly.jsdelivr.net/gh/projectnoonnu/noonfonts_2201-2@1.0/MinSans-Regular.woff') format('woff');
        font-weight: normal;
        font-style: normal;
    }
    .verify {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: 1fr 1.5fr;
        width: 450px;
        border: 1px solid #ebebeb;
        height: 350px;
        margin: 100px auto 0;
        padding: 10px 30px;
    }
    .a h1 {
        margin: 20px 0 10px;
    }
    .b {
        display: grid;
        grid-template-rows: 1fr 1fr;
    }
    .p {
        line-height: 30px;
        height: 70px;
    }
    .c {
        display: grid;
        grid-template-columns: 1fr;
        place-items: center;
    }
    .c a {
        padding: 10px;
        background-color: #4C83EE;
        color: white;
        text-decoration: none;
        width: 130px;
        text-align: center;
    }
    </style>
</head>
<body>
    <div class="verify">
        <div class="a">
            <h1>안녕하세요.</h1>
            <h3>내감니감입니다.</h3>
            <!-- <img src="../../public/logo_IgoUgo.png" alt=""> -->
        </div>
        <div class="b">
            <div class="p">
                <p>이메일 인증을 완료하려면 아래 버튼을 클릭하세요.</p>
                <p>인증 후 비밀번호를 변경하실 수 있습니다.</p>
            </div>
            <div class="c">
                <a href="{{ $url }}">이메일 인증하기</a>
                {{-- <a href="{{ $url }}">비밀번호 변경 페이지로 이동하기</a> --}}
            </div>
        </div>
    </div>
</body>
</html>
