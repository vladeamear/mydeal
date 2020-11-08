<?php
session_start();

define('CACHE_DIR', basename(__DIR__ . DIRECTORY_SEPARATOR . 'cache'));
define('UPLOAD_PATH', basename(__DIR__ . DIRECTORY_SEPARATOR . 'uploads'));

$con = mysqli_connect('localhost','root','root','mydeal');
if ($con==false){
    print("ошибка подключения: ".mysqli_connect_error());
}

mysqli_set_charset($con, "utf8");

function include_template($name, array $data = []) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

function howmuch($innertasks,$projectname){
    $j = 0;
    for ($i = 0; $i < count($innertasks); $i++){
        if($innertasks[$i]["project_name"] == $projectname)
            $j++;
    }
    return $j;
}

function addGet($k,$n){
    if(empty($_REQUEST)) echo '/?' . $k . '=' . $n; 
    else{ 
        if (!array_key_exists($k,$_REQUEST))
            echo '/?' . $_SERVER['QUERY_STRING'] . '&' . $k . '=' . $n;
        else{
            $s = $_SERVER['QUERY_STRING'];
            $j = $k . '=' . $_REQUEST[$k];
            $i = $k . '=' . $n;
            $s = '/?' . str_replace($j,$i,$s);
            echo $s;
        }
    }
};
?>