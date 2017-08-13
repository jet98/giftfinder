<?php
  function getItems($response){
    $query = array();
    foreach ($response->Items->Item as $item) {
      if(!empty($item->ItemAttributes->Title)){
        $title = $item->ItemAttributes->Title;
      }
      if($title == null){
        $title = [""];
      }
      if(!empty($item->ItemAttributes->ListPrice->FormattedPrice)){
        $price = $item->ItemAttributes->ListPrice->FormattedPrice;
      }
      else{
        $price = ["Price not listed"];
      }
      if(!empty($item->ImageSets->ImageSet->MediumImage->URL)){
        $image = $item->ImageSets->ImageSet->MediumImage->URL;
      }
      if($image == null){
        $image = [""];
      }
      if(!empty($item->DetailPageURL)){
        $link = $item->DetailPageURL;
      }
      if($link == null){
        $link = [""];
      }
      array_push($query, [$title, $price, $image, $link]);
    }
    return $query;
  }
?>
