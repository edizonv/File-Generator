<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File Checker</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

error_reporting(0);

date_default_timezone_set('Asia/Manila');

if($_POST['path'] && $_POST['newpath']) {

    function getDirContents($dir, &$results = array() ) {
        $files = scandir($dir);
        foreach($files as $key => $value){
            $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
            if(!is_dir($path)) {
                $results[] = $path;
            } else if($value != "." && $value != "..") {
                getDirContents($path, $results);
                $results[] = $path;
            }
        }
        return $results;
    }

    $path   =   $_POST['path'];
    $array  =   getDirContents($path);

    function changePathToTextFile($param1, $param2) {
        return str_replace(end($param1), '', strchr(str_replace("\\", "/", str_replace("//", "/", $param2) ), end($param1).'/' ) )."\n";
    }

    function newDirectory($param1) {
        return str_replace("//", "/", str_replace("///", "/", str_replace("\\", "/", $param1) ) );
    }

    function getFiles($file, $path) {
        global $copyText;
        $rootPath   =   explode("\\", $path);
        $folder     =   end($rootPath);
        $newDir     =   $_POST['newpath'];
        $slashed    =   explode('\\', $file);
        $moveFiles  =   end($slashed);

  
        $dir        =   str_replace("\\", "/", str_replace($folder, '', strchr( dirname($file), '\\'.$folder ) ) );
        $newPath    =   $newDir.$dir.'/';
        $rootFolder =   explode("\\", $newPath);
        $rootFldr   =   end($rootFolder);
        $p = str_replace($folder, $_POST['root'], dirname($file));
        $moveFilesx =   $newPath.'\\'.$moveFiles;
        if(!is_dir($newPath) ) {
            mkdir($newPath, 0777, true);
        }

        $endPath = explode("\\", $newDir);

        $copyText[] = changePathToTextFile($endPath, $moveFilesx);

        $ex = explode("\\", $moveFiles);

        if(end($ex) != "Thumbs.db" || $moveFiles != "thumbs.db"){
            copy($file, $moveFilesx);
            $copied = 1;
            echo $file . '<br><strong>copied to</strong><br><span class="strong">' . newDirectory($moveFilesx) .'</span><br><br>';
        }
    }

    

    foreach($array as $file) {
        if(is_file($file) ) {

            $fr     = str_replace('-', ' ', $_POST['from-date']) . ' ' . $_POST['hours'] . ':' . $_POST['minutes'];
            $toDate = str_replace('-', ' ', date("Y m d h:i", strtotime($_POST['to-date']) ) );
            $mod_date=date("Y m d h:i", filemtime($file) );

            if($fr == $toDate) {
                if($mod_date == $toDate) {
                    getFiles($file, $path);
                    $copied = 1;
                }
            } else {
               
               
                if($mod_date >= $fr && $mod_date <= $toDate) {
                   getFiles($file, $path);
                   $copied = 1;
                }
            }
        }
    }

    if(isset($copyText) ) {
        echo "<hr>Total files copied : (". count($copyText).")";
        $insertToTextFile = str_replace("//", '/', str_replace(" ", '', (implode(" ", $copyText) ) ) );
        $fp = fopen($_POST['newpath'] . "/fileList.txt","wb");
        fwrite($fp,$insertToTextFile);
        fclose($fp);
    }

}
?>
</body>
</html>