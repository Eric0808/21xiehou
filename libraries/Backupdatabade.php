<?php 
class Backupdatabade
{

	public function __construct($conf="")
	{
		header("Content-Type: text/html;charset=utf-8");
	}
	
	
function populate_db( $DBname, $DBPrefix, $sqlfile ) {  
    global $errors;  
  
    @mysql_select_db($DBname);  
    mysql_query("SET NAMES utf8");	
    $mqr = @get_magic_quotes_runtime();  
    @set_magic_quotes_runtime(0);  
    $query = fread(fopen($sqlfile, "r"), filesize($sqlfile));  
    @set_magic_quotes_runtime($mqr);  
    $pieces  = $this->split_sql($query);  
  
    for ($i=0; $i<count($pieces); $i++) {  
        $pieces[$i] = trim($pieces[$i]);  
        if(!empty($pieces[$i]) && $pieces[$i] != "#") {  
            $pieces[$i] = str_replace( "#__", $DBPrefix, $pieces[$i]);  
            if (!$result = @mysql_query ($pieces[$i])) {  
                $errors[] = array ( mysql_error(), $pieces[$i] );  
            }  
        }  
    }
		
}  
  
function split_sql($sql) {  
    $sql = trim($sql);  
    $sql = preg_replace("/\n#[^\n]*\n/", "\n", $sql);  
  
    $buffer = array();  
    $ret = array();  
    $in_string = false;  
  
    for($i=0; $i<strlen($sql)-1; $i++) {  
        if($sql[$i] == ";" && !$in_string) {  
            $ret[] = substr($sql, 0, $i);  
            $sql = substr($sql, $i + 1);  
            $i = 0;  
        }  
  
        if($in_string && ($sql[$i] == $in_string) && $buffer[1] != "\\") {  
            $in_string = false;  
        }  
        elseif(!$in_string && ($sql[$i] == '"' || $sql[$i] == "'") && (!isset($buffer[0]) || $buffer[0] != "\\")) {  
            $in_string = $sql[$i];  
        }  
        if(isset($buffer[1])) {  
            $buffer[0] = $buffer[1];  
        }  
        $buffer[1] = $sql[$i];  
    }  
  
    if(!empty($sql)) {  
        $ret[] = $sql;  
    }  
    return($ret);  
}  
  
  
}
?>