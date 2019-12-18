<?php

foreach ($_POST as $key => $value) {
  if(empty($_POST[$key]))
  {
    $error[$key]="This field cannot be empty";
  }else{
    // $_POST[$key]=preg_replace('/\s+/', ' ',   $_POST[$key]);
    if(!is_array($_POST[$key]))
    {
        // $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
        $_POST[$key]=strip_tags($_POST[$key]);
        $_POST[$key] =trim($_POST[$key]);
        $_POST[$key]=str_replace('|'," ",$_POST[$key]);
        $_POST[$key]=preg_replace('/[\n\r]+/',"\n",$_POST[$key]);

        $_POST[$key] =trim( preg_replace('/[\s]+/', ' ', $_POST[$key]));
        $_POST[$key] =trim($_POST[$key]);
    }

  }
}

print_r($_POST["data"]);
$myFile = "../../config.json";
$fh = fopen($myFile, 'w') or die("can't open file");
$stringData = $_POST["data"];
fwrite($fh, $stringData);
fclose($fh);
echo true;


 ?>
