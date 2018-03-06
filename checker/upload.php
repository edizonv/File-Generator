<style>
  .green {
    background-color: green;
    padding: 3px;
    color: #fff !important;
  }
  .red {
    background-color: red;
    padding: 3px; 
    color: #fff !important;
  }
</style>
<?php

function getDirContents($dir, &$results = array()){
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
$end = explode('\\', $path);
$ends = end($end);

$array  =   getDirContents($path);

foreach($array as $file) {
  if(is_file($file) ) {
    $array1[] = trim(str_replace($ends, '', strstr(str_replace('\\', '/', $file), $ends) ) );
  }
}

$list   =   $_POST['list'];
$fh = fopen($list,'r');
while ($line = fgets($fh)) {
  $array2[] = trim($line);
}
fclose($fh);

$complete = array_merge($array1, $array2);

// echo "<pre>";
$var = array_filter(array_map('trim', $complete));
// print_r($var);
// echo "</pre>";


$count = array_count_values($complete);



foreach($complete as $val)
{
    if($count[$val]==1) {
        echo "<br>";
        echo "<div class='red'>".$val."</div>";
        $miss[] = $val;
    }
}


echo "<br>";

echo "DELIVERY FILES : ". count($array1);
echo "<br>";
echo "TEXT FILE : " . count($array2);

echo "<br>";

if (isset($miss) ) {
  echo "MISTAKE(S) : " . count($miss);
} else {
  echo "MISTAKE(S) : 0";
}