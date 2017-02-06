<?php
include("voc.php");

    $origAm = "1345,99";
    $voc = new Voc();
    $val = "";
    $vocLength = $voc->getLength($origAm);
    
    $splitDecsAr = $voc->splitDecimals($origAm);

    $number = $splitDecsAr[0];
    $decimals = $splitDecsAr[1];
    $decValue = "";
    $decEnding = "ΛΕΠΤΑ";

    $numberLength = strlen($number);


    if($numberLength == 1)
    {
      $val = $voc->getMonad($number,$numberLength);
    } else if ($numberLength == 2)
    {
      $val = $voc->getDecades($number,$numberLength);
    } else if ($numberLength == 3)
    {
      $val = $voc->getHundreds($number,$numberLength);
    } else if ($numberLength == 4)
    {
      $val = $voc->getThousands($number,$numberLength);
    } else if ($numberLength == 5)
    {
      $val = $voc->getDecadeThousands($number,$numberLength);
    }

    if(substr($decimals, 0, 1) == 0 )
    {
      $decValue = " ΚΑΙ ". $voc->getMonad(substr($decimals,1,1), $numberLength) ." " . $decEnding;
    } else if ( substr($decimals, 0, 1) != 0 )
    {
      $decValue = " ΚΑΙ ". $voc->getDecades($decimals,2) ." " . $decEnding;
    }

    if ( substr($decimals, 0, 1) == 0 && substr($decimals, 1, 1) == 0 )
    {
      $decValue = "";
    }
    $value = $voc->makeFinalAmount($val) . $decValue;
    echo $value;
