<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="format-detection" content="telephone=no" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<script src="<?=_ASSETS_COM?>js/jquery-1.12.4.min.js"></script>
<script src="<?=_ASSETS_COM?>js/jquery-ui.js"></script>
<script src="<?=_ASSETS_COM?>js/common.js"></script>
<script src="<?=_ASSETS_COM?>js/swiper-bundle.min.js"></script><!--이미지슬라이더-->
<link rel="stylesheet" type="text/css" href="<?=_ASSETS?>css/styles.css">
<link rel="stylesheet" type="text/css" href="<?=_ASSETS?>common/css/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?=_ASSETS?>common/css/swiper-bundle.min.css">
<body>
  <header class="head">
    <a class="logo" href="/front/Main">
      <img src="<?=_ASSETS?>img/logo.png" alt="logo">
    </a>
    <div class="branch">
      <a href="#" class="com_btn green oval m">화곡점</a>
      <a href="#" class="com_btn yellow oval m">마곡점</a>
    </div>
    <div class="gnb_container">
      <section class="gnb_top">
        <div class="branch">
          <a href="#" class="com_btn green oval m">화곡점</a>
          <a href="#" class="com_btn yellow oval m">마곡점</a>
        </div>
        <a href="#" class="icon_blog"><img src="<?=_ASSETS?>img/icon_blog.png" alt="blog"></a>   
        <button class="btn_close BtnGnbClose"><img src="<?=_ASSETS?>img/icon_del.png" alt="close"></button>
      </section>
      <ul class="gnb">
        <li class="depth1">
          <a href="#" class="menu GnbMenu">해빛소개</a>
        </li>
        <li class="depth1">
          <a href="#" class="menu GnbMenu">언어상담</a>
        </li>
        <li class="depth1">
          <a href="#" class="menu GnbMenu">아동청소년심리상담</a>
        </li>
        <li class="depth1">
          <a href="#" class="menu GnbMenu">치료프로그램</a>
        </li>
        <li class="depth1">
          <a href="#" class="menu GnbMenu">검사프로그램</a>
        </li>
        <li class="depth1">
          <a href="#" class="menu GnbMenu">상담절차&예약</a>
        </li>
        <li class="depth1">
          <a href="#" class="menu GnbMenu icon_blog"><img src="<?=_ASSETS?>img/icon_blog.png" alt="blog"></a>
        </li>
      </ul>
    </div>
    <i class="bg_close"></i>
    <a class="link com_mobile btn_bar BtnBar" href="#"></a>
  </header>
<script>
  $(function(){
    $(".BtnBar").click(function() { //gnb 열기
      $(".gnb_container").addClass("active")
      $('html').addClass("scroll_lock")
    })
    $(".BtnGnbClose").click(function() { //gnb 닫기
      $(".gnb_container").removeClass("active")
      $('html').removeClass("scroll_lock")
    })
  })
</script>