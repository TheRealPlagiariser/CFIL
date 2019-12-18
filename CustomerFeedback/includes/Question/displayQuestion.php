<?php


    include 'getQuestion.php';


 ?>

 <div class="row">
   <label class="col-md-4 col-xs-4">Question</label>
   <span class="col-md-8 col-xs-8"><?php echo $selectQuestion[0]["question"] ?></span>
 </div>
 <div class="row">
   <label class="col-md-4  col-xs-4">Question Type</label>
   <span class="col-md-8  col-xs-8"><?php echo $selectQuestion[0]["questionType"] ?></span>
 </div>
 <div class="row">
   <label class="col-md-4  col-xs-4">Created By</label>
   <span class="col-md-8  col-xs-8"><?php echo $selectQuestion[0]["createdBy"] ?></span>
 </div>

 <div class="row">
   <label class="col-md-4  col-xs-4">Date Created </label>
   <span class="col-md-8  col-xs-8"><?php echo $selectQuestion[0]["dateCreated"] ?></span>
 </div>
 <hr/>
 <!-- <div class="row" style="padding-left: 18px"> -->
   <!-- <h2 style="font-size:10px">Possible Answer</h2> -->
   <?php
    if($selectQuestion[0]["questionTypeId"] == 2){
        $bounds =explode("|",$selectQuestion[0]['possibleAnswer'] );
        // echo "<pre>";
        // print_r($bounds);
        // echo "</pre>";
        // echo $selectQuestion[0]['possibleAnswer'];
        sort($bounds);
   ?>
   <div class="row">
     <label class="col-md-4  col-xs-4">Lower Bound</label>
     <span class="col-md-8  col-xs-8">
     <?php  echo $bounds[0]?>
     </span>
   </div>
   <div class="row">
     <label class="col-md-4  col-xs-4">Upper Bound</label>
     <span class="col-md-8  col-xs-8">
       <?php  echo $bounds[(COUNT($bounds))-1] ?>
     </span>
   </div>
   <div class="row">
     <label class="col-md-4  col-xs-4">Lower Bound Label</label>
     <span class="col-md-8  col-xs-8">
     <?php

        echo $selectQuestion[0]['leftLabel'];
      ?>
     </span>
   </div>
   <div class="row">
     <label class="col-md-4  col-xs-4">Upper Bound Label</label>
     <span class="col-md-8  col-xs-8">
       <?php  echo  $selectQuestion[0]['rightLabel']; ?>
     </span>
   </div>

  <?php
    }
    else if($selectQuestion[0]["questionTypeId"] == 3){
        $choices =explode("|",$selectQuestion[0]['possibleAnswer'] );?>
        <div class="row">
        <label class="col-md-4  col-xs-4">Choices: </label>
          <?php
          foreach ($choices as $key => $value) { ?>
            <?php if($key > 1){
              echo '<label class="col-md-4  col-xs-4"></label>';
            }
             ?>
            <span class="col-md-8  col-xs-8">
              <!-- <div class="row"> -->
                    <?php  echo $choices[$key]; ?>
              <!-- </div> -->
            </span>
    <?php       }?>
  </div><?php
    }
   ?>
