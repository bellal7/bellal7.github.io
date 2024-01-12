<?php
/*****************************************************************************
 * /application/controllers/front/MainController.class  메인
 *****************************************************************************/

namespace application\controllers\front;

	//메인인덱스 페이지
class MainController extends Controller
{
	//인덱스 페이지
  public function Index($menu, $category, $idx, $npage)
  {
    $this->css_page = "p_main";
    require_once 'application/views/front/main/index.php';
  }//End function. index

}//End class. MainController

?>