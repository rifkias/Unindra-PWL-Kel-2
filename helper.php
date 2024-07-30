<?php
session_start();

function getUri()
{
    $dynamic = false;
    $uri = "http://pwl.test/inventoryV2";
    if($dynamic){
        $uri = dynamicUri();
    }

    return $uri;
}

function dynamicUri(){
    $uri =  (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://".$_SERVER['HTTP_HOST'];
    $basePath = getDirname();
    if ($basePath <> 'index.php') {
        if ($basePath == "/") {
            $uri = $uri;
        } else {
            $uri = $uri . $basePath;
        }
    }
}

function getDirname()
{
    return  dirname($_SERVER['PHP_SELF']);
}


function checkAuth(){
	if($_SESSION['role']!="stock"){
		header("location:".getUri()."/login.php?pesan=belum_login");
	}
}