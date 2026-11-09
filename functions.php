<?php
function computeAverage($quiz, $activity, $exam)
{
    return ($quiz + $activity + $exam) / 3;
}

function getRemark($average){
    return $average >= 75 ? "PASSED" : "FAILED";
}
