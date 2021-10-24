<?php
namespace App\Helper;

class ApiHelper{
    public static function createapiresponse($is_error,$code,$message,$content){
        $result=[];

        if($is_error){
            $result['success']=false;
            $result['code']=$code;
            $result['message']=$message;
        }else{
            $result['success']=true;
            $result['code']=$code;
            $result['message']=$message;
            if($content==null){
                $result['message']=$message;
            }else{
                $result['data']=$content;
            }
        }
        return $result;

    }


}
?>