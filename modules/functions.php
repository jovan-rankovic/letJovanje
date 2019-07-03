<?php
    function dateFormat($date){
        $sDate = substr($date, 0, 10);
        $sTime = substr($date, 11, 8);
        $eDate = explode("-", $sDate);
        $newFormat = $eDate[2].'.'.$eDate[1].'.'.$eDate[0].'.'.' '.$sTime;
        return $newFormat;
    }