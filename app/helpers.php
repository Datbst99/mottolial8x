<?php

function rewardPoint($total){
    $point = $total / 1000;
    return floor($point);
}
