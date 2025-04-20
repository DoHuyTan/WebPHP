<?php
function get_list_users(){
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}
function check_login_user($username,$password){
    $list_users = db_fetch_array("SELECT * FROM `tbl_users`");
    foreach($list_users as $user){
        if($username == $user['username'] && md5($password) == $user['password']){
            return True;  
        } 
    } 
    return FALSE;   
}
function get_info_account($data){
    $info = db_fetch_row("SELECT `$data` FROM `tbl_users` WHERE `username` = '{$_SESSION['user_login']}'");
    if(!empty($info)) return $info[$data];
    return false;
}
// Trả về true nếu đã login
function is_login(){
    if(isset($_SESSION['is_login']))
        return  true;
    return false;
}
function user_login(){
    if(!empty($_SESSION['user_login']))
        return  $_SESSION['user_login'];
    return false;
}

function info_user($field){
    $list_users = get_list_users();
    if(isset($_SESSION['is_login'])){
        foreach ($list_users as $user){
            if($_SESSION['user_login']== $user['username']){
                if(array_key_exists($field, $user))
                        return $user[$field];
            }
        }
    }
}
