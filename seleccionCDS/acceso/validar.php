<?php
    function getValue($strvar) {
        $banned = array("select","SELECT","<","=",">","drop","DROP","--","|","insert","INSERT","delete","DELETE","'","xp_");
        $vowels =$banned;
        $no =str_replace($vowels,"",$strvar);
        $final=str_replace("'","",$no);
        return $final;  
    }

?>