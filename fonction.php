<?php
function convertirMinutesEnHeures ($duree){
    if ($duree<60) {
        return $duree;
    } else {
        $heures=floor($duree/60);
        $minutes= $duree%60;
        if ($minutes<10) {
            return ("$heures:0$minutes");
        } else {
            return ("$heures:$minutes");
        }

    }

}