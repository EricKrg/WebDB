<?php
//stat functions----------------------------------------------------------------
    function variance($array,$mean){
        foreach($array as $item){
            $tmp[] = pow(($item - $mean),2);
        }
        $s = array_sum($tmp)/count($array);
        return $s;
    }
    function quan($array, $x){
        sort($array);
        $length= count($array); 
        $q1 = $length * $x;  
        return $array[round($q1)-1];      
  }
    function Stand_Deviation($arr)
    {
        $num_of_elements = count($arr);
         
        $variance = 0.0;
         
                // calculating mean using array_sum() method
        $average = array_sum($arr)/$num_of_elements;
         
        foreach($arr as $i)
        {
            // sum of squares of differences between 
                        // all numbers and means.
            $variance += pow(($i - $average), 2);
        }
         
        return (float)sqrt($variance/$num_of_elements);
    }
?>
