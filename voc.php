<?php

class Voc
{
    function getTheWholeNumber($amount)
    {
      $val = "";
      $vocLength = $this->getLength($amount);

      $splitDecsAr = $this->splitDecimals($amount);

      $number = $splitDecsAr[0];
      $decimals = $splitDecsAr[1];
      $decValue = "";
      $decEnding = "ΛΕΠΤΑ";

      $numberLength = strlen($number);


      if($numberLength == 1)
      {
        $val = $this->getMonad($number,$numberLength);
      } else if ($numberLength == 2)
      {
        $val = $this->getDecades($number,$numberLength);
      } else if ($numberLength == 3)
      {
        $val = $this->getHundreds($number,$numberLength);
      } else if ($numberLength == 4)
      {
        $val = $this->getThousands($number,$numberLength);
      } else if ($numberLength == 5)
      {
        $val = $this->getDecadeThousands($number,$numberLength);
      }

      if(substr($decimals, 0, 1) == 0 )
      {
        $decValue = " ΚΑΙ ". $this->getMonad(substr($decimals,1,1), $numberLength) ." " . $decEnding;
      } else if ( substr($decimals, 0, 1) != 0 )
      {
        $decValue = " ΚΑΙ ". $this->getDecades($decimals,2) ." " . $decEnding;
      }

      if ( substr($decimals, 0, 1) == 0 && substr($decimals, 1, 1) == 0 )
      {
        $decValue = "";
      }
      $value = $this->makeFinalAmount($val) . $decValue;
      return $value;
    }

    function getLength($amount)
    {
      return strlen($amount);
    }

    function splitDecimals($amount)
    {
      $ar = explode(",",$amount);
      return $ar;
    }

    function getDecadeThousands($val, $digits)
    {
      $val0 = substr($val,0,2);
      $val1 = substr($val,2,3);

      $vocVal0 = $this->getDecades($val0, $digits);
      $vocVal1 = $this->getHundreds($val1, 2);

      $vocative = $vocVal0 . " ΧΙΛΙΑΔΕΣ " . $vocVal1 ;
      return $vocative;

    }

    function getThousands($val,$digits)
    {
      $val0 = substr($val,0,1);
      $val1 = substr($val,1,3);

      $vocVal0 = "";
      $vocVal1 = "";

      $ending0 = "ΧΙΛΙΑΔΕΣ";

      if($val0 == 1)
      {
        $vocVal0 = "ΧΙΛΙΑ";
        $ending0 = "";
      } else {
        $vocVal0 = $this->getMonad($val0, $digits);
      }
      $vocVal0 = $vocVal0." ".$ending0;
      $vocVal1 = $this->getHundreds($val1,$digits);

      $vocative = $vocVal0." ".$vocVal1;
      return $vocative;

    }

    function getHundreds($val,$digits)
    {
      $val0 = substr($val,0,1);
      $val1 = substr($val,1,2);

      $vocVal0 = "";
      $vocVal1 = "";

      $ending0 = "";
      switch($val0)
      {
        case(0):
          $vocVal0 = "";
          break;
        case(1):
          $vocVal0 = "ΕΚΑΤΟ";
          break;
        case(2):
          $vocVal0 = "ΔΙΑΚΟΣΙ";
          break;
        case(3):
          $vocVal0 = "ΤΡΙΑΚΟΣΙ";
          break;
        case(4):
          $vocVal0 = "ΤΕΤΡΑΚΟΣΙ";
          break;
        case(5):
          $vocVal0 = "ΠΕΝΤΑΚΟΣΙ";
          break;
        case(6):
          $vocVal0 = "ΕΞΑΚΟΣΙ";
          break;
        case(7):
          $vocVal0 = "ΕΠΤΑΚΟΣΙ";
          break;
        case(8):
          $vocVal0 = "ΟΚΤΑΚΟΣΙ";
          break;
        case(9):
          $vocVal0 = "ΕΝΝΙΑΚΟΣΙ";
          break;
      }
      if($val0 != 1)
      {
        if($digits == 2 || $digits == 5 || $digits == 3 || ($digits == 4 && $val0 != 0 && substr($val1, 0,1) != 0) || ($digits == 4 && $val0 != 0 && substr($val1, 0,1) == 0))
        {
          $ending0 = "Α";
        } else if($digits == 6)
        {
          $ending0 = "ΕΣ";
        }
      }

      $vocVal0 = $vocVal0.$ending0;
      $vocVal1 = $this->getDecades($val1,$digits);

      $vocative = $vocVal0." ".$vocVal1;
      return $vocative;
    }


    function getDecades($val, $digits)
    {
      $val0 = substr($val,0,1);
      $val1 = substr($val,1,1);
      $vocVal0 = "";
      $vocVal1 = "";

      switch($val0)
      {
            case(0):
              $vocVal0 = "";
              break;
            case(1):
              $vocVal0 = "ΔΕΚΑ";
              break;
            case(2):
              $vocVal0 = "ΕΙΚΟΣΙ";
              break;
            case(3):
              $vocVal0 = "ΤΡΙΑΝΤΑ";
              break;
            case(4):
              $vocVal0 = "ΣΑΡΑΝΤΑ";
              break;
            case(5):
              $vocVal0 = "ΠΕΝΗΝΤΑ";
              break;
            case(6):
              $vocVal0 = "ΕΞΗΝΤΑ";
              break;
            case(7):
              $vocVal0 = "ΕΒΔΟΜΗΝΤΑ";
              break;
            case(8):
              $vocVal0 = "ΟΓΔΟΝΤΑ";
              break;
            case(9):
              $vocVal0 = "ΕΝΕΝΗΝΤΑ";
              break;
      }
      if($val0 == 1)
      {
        if($val1 == 1){ $vocative = "ΕΝΤΕΚΑ"; } else if
        ($val1 == 2){ $vocative = "ΔΩΔΕΚΑ"; } else
        //($val1 == 3){ $vocative = "ΔΕΚΑΤΡΙΑ"; } else
        {
          $vocVal1 = $this->getMonad($val1, $digits);
          $vocative = $vocVal0.$vocVal1;
        }
      } else {
        $vocVal1 = $this->getMonad($val1, $digits);
        $vocative = $vocVal0." ".$vocVal1;
      }

      return $vocative;
    }

    function getMonad($val, $digits)
    {
      $vocative = "";
      $ending = "";

      switch($val)
      {
            case(0):
            if($digits == 1){
              $vocative = "ΜΗΔΕΝ";
            } else {
              $vocative = "";
            }
              break;
            case(1):
              $vocative = "ΈΝΑ";
              break;
            case(2):
              $vocative = "ΔΥΟ";
              break;
            case(3):
              $vocative = "ΤΡ";
              break;
            case(4):
              $vocative = "ΤΕΣΣΕΡ";
              break;
            case(5):
              $vocative = "ΠΕΝΤΕ";
              break;
            case(6):
              $vocative = "ΕΞΙ";
              break;
            case(7):
              $vocative = "ΕΠΤΑ";
              break;
            case(8):
              $vocative = "ΟΚΤΩ";
              break;
            case(9):
              $vocative = "ΕΝΝΕΑ";
              break;
      }
      if($digits <= 2)
      {
        if($val == 3)
        {
          $ending = "ΙΑ";
        }
        if($val == 4)
        {
          $ending = "Α";
        }
      } else if($digits > 2)
      {
        if($val == 3)
        {
          $ending = "ΕΙΣ";
        }
        if($val == 4)
        {
          $ending = "ΕΙΣ";
        }
      }
      return $vocative.$ending;

    }

    function makeFinalAmount($voc)
    {
      $cur = "ΕΥΡΩ";
      return $voc." ".$cur;
    }

}

?>
