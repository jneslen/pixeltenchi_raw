<?php

function db_connect()
{
   $result = mysql_connect('69.50.234.2', 'xzbtr_root', 'kamisasanuki'); 
   if (!$result)
      return false;
   if (!mysql_select_db('xzbtr_teaching'))
      return false;

   return $result;
}

?>