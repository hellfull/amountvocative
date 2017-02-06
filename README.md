# amountvocative
amount in vocative for greek currency ( currently euro )

The implementation is made up to 99999,99 Euro.

Currency is hardcoded.

Language is hardcoded.

Amount should be in european format with 2 decimals as the example 1098,23 or 23987,02

#just call the `$voc->getTheWholeAmount($amount)` with your variable as in the index.php file.

the class will call every function in order to return the whole number in vocative like "ΧΙΛΙΑ ΤΡΙΑΚΟΣΙΑ ΔΩΔΕΚΑ ΕΥΡΩ ΚΑΙ ΤΡΙΑΝΤΑ ΕΝΑ ΛΕΠΤΑ" for 1312,31 Euro .
