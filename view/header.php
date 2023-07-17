<!DOCTYPE html>
<html lang="zxx">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="./resources/js/jquery.js"></script>
  <script src="./resources/js/script.js"></script>
  <link rel="stylesheet" href="./resources/fonts/fontawesome/css/all.css">
  <link rel="stylesheet" href="./resources/css/style.css">
  <title>Document</title>
</head>
<body>

  <header>
    <div class="wrap flex jcsb aic">
      <div class="logo_box">
        <a href="/"><img src="./resources/img/logo.png" alt="#" title="#" class="logo"></a>
      </div>

      <div class="menu_nav flex">
        <div class="animation flex jcsb">
          <i class="fa fa-plane"></i>
          <i class="fa fa-plane fa-rotate-180"></i>
        </div>
        <div class="depth_box">
          <a href="#" class="depth1">투어 소개</a>
          <div class="sub_menu">
            <a href="#" class="depth2">독립기념관</a>            
            <a href="#" class="depth2">유관순 기념관</a>            
            <a href="#" class="depth2">홍대용 과학관</a>            
          </div>
        </div>
        <div class="depth_box">
          <a href="#" class="depth1">투어 정보</a>
          <div class="sub_menu">
            <a href="/preview_info" class="depth2">관람 정보</a>            
            <a href="/calendar" class="depth2">관람 일정</a>            
          </div>
        </div>
        <div class="depth_box">
          <a href="#" class="depth1">투어 추천</a>
          <div class="sub_menu">
            <a href="/reservation" class="depth2">투어 예약</a>            
            <a href="#" class="depth2">투어 추천</a>            
            <a href="/video" class="depth2">추천 영상 등록</a>            
          </div>
        </div>
        <div class="depth_box">
          <a href="#" class="depth1">투어 후기</a>
          <div class="sub_menu">
            <a href="#" class="depth2">후기 게시판</a>            
          </div>
        </div>
      </div>

      <label for="mobile" class="mobile"><i class="fa fa-bars"></i></label>

      <div class="utility flex jcfe">
        
        <div class="btn_box">
          <?php if(@USER): ?>
            <a href="/logout" class="btn"><i class="fa fa-user-minus"></i>로그아웃</a>
          <?php else:?>
            <a href="/login" class="btn"><i class="fa fa-user"></i>로그인</a>
            <a href="/join" class="btn"><i class="fa fa-user-plus"></i>회원가입</a>
          <?php endif ?>
        </div>
      </div>
    </div>
  </header>