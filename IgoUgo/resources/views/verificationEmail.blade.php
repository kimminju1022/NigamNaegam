<!DOCTYPE html>
<html>
<head>
    <title>이메일 인증</title>
    <style>
        /* 스타일 추가 (필요 시) */
    </style>
</head>
<body>
    <h1>안녕하세요, {{ $name }}!</h1>
    <p>이메일 인증을 완료하려면 아래 버튼을 클릭하세요:</p>
    <a href="{{ $url }}" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none;">이메일 인증하기</a>
    <p>인증 후 서비스를 정상적으로 이용하실 수 있습니다.</p>
</body>
</html>
