<?php
/*****************************************************************************
 * /application/vender/autoload.php
 *****************************************************************************/
spl_autoload_register(function ($path) {
    $path = str_replace('\\','/',$path);

		$paths = explode('/', $path);

    if (preg_match('/model/', strtolower($paths[1]))) {
        $className = 'models';
    } else if (preg_match('/controller/',strtolower($paths[1]))) {
        $className = 'controllers';
    } else {
        $className = 'libs';
    }

	if($className=="libs" || $className=="models"){
		$loadpath =  $paths[0].'/'.$paths[1].'/'.$paths[2].'.class.php';
	}else{
		$loadpath =  $paths[0].'/'.$className.'/'.$paths[2].'/'.$paths[3].'.class.php';
	}

    //$loadpath =  $paths[0].'/'.$paths[1].'/'.$className.'/'.$paths[3].'.class.php';
    //echo 'autoload $path : ' . $loadpath . '<br>';

    if (!file_exists($loadpath)) {
        echo " autoload : 해당파일 없음!!. ($loadpath) ";
        exit();
    }
    require_once $loadpath;

});
?>