<?php 
function ConvertLink($str){
    $str = str_replace(array('!','"','','Â£','$','%','%','^','&','*','(','+','=','\\','/','[',']','{','}',';',':','@','#','~','<',',','?','|',),' ',$str);
            $str = str_replace(' ','-',$str);
            $str = str_replace('_','-',$str);
            $str = str_replace('---','-',$str);
            $str = str_replace('--','-',$str);
            $str = str_replace(')','',$str);
    return strtolower($str);
}
    ?>