<?php 
function makeImageFromName($name){
    $userImage="";
    $shortName="";
    $names=explode(" ", $name);
    // foreach($names as $w){
    //     $shortName.=$w[0];

    // }
  $shortName=$name[0].$name[1];
    $userImage='<div class="chat_img " style="color:white; background-color:blue; border-radius:50%; padding-top: 5px;  height:40px; width:40px;" ><span class="textImage">'.$shortName.'</span></div>';
    return $userImage;
}