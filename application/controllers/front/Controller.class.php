<?php
/*****************************************************************************
 * /application/controllers/front/controller.class.php
 *****************************************************************************/

namespace application\controllers\front;

class Controller
{
    public $css_page = "";// body addClass
    
    public function __construct($mode, $menu, $action, $category, $idx, $npage)
		{
        if (!file_exists(_ROOT.'/application/controllers/'.$mode."/".$menu.'Controller.class.php')) {
            var_dump('Controller Class not found.(application/controllers/'.$menu.'Model.class.php)');
            exit();
        }

        $this->$action($menu, $action, $category, $idx, $npage);
    }
}//End class. Controller



?>