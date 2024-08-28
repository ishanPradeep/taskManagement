<?php
function check_prime($num)
{
   if ($num == 1)
   return 0;
   for ($i = 2; $i <= $num/2; $i++)
   {
      if ($num % $i == 0)
      return 0;
   }
   return 1;
}

for ($i = 1; $i <= 50; $i++) {
    $mod3 = $i % 3;
    $mod5 = $i % 5;
    
    $str = '';

    if ($mod3 == 0 && $mod5 == 0) {
        $str .= 'FIZZBuzz';
    } else if ($mod3 == 0) {
        $str .= 'FIZZ';
    } else if ($mod5 == 0) {
        $str .= 'Buzz';
    } else if (check_prime($i) == 1) {
        $str .= 'Prime';
    } else {
        $str .= $i;
    }

    echo $str, "\n";
}
?>
