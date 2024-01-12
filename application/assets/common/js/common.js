$(function () {  
  //페이지에 팝업이 하나일때 팝업 열기 공통
  $(".BtnPop").click(function(){
    $(".Pop").addClass("active");
    $("body").addClass("scroll_lock")
  })
  //팝업닫기 공통
  $(".BtnPopClose").click(function(ev) {
		$(this).parents(".com_popup").removeClass("active");
		$("body").removeClass("scroll_lock");
	});
  //게시글 여닫기 공통
  $(".com_btn_toggle").click(function(){
    $(this).toggleClass('active');
    $(this).parent(".com_toggle_wrap").toggleClass("active");
    $(this).parent(".toggle_box").parent(".com_toggle_wrap").toggleClass("active");
  })
  //탭 클릭시 action
  $('.comTab .tab').click(function(ev) {
    var idx = $(this).index();
    $('.comTab .tab').removeClass('active');
    $(this).addClass('active');
    $(this).parent().next().find('.TabContents').removeClass('active').eq(idx).addClass('active');
    // $('.TabContents').eq(idx).addClass('active');
  })
  $('.comTabSub .tab').click(function(ev) {
    var idx = $(this).index();
    $('.comTabSub .tab').removeClass('active');
    $(this).addClass('active');
    $('.TabContents').removeClass('active');
    $('.TabContents').eq(idx).addClass('active');
  })
});