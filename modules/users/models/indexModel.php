<?php
function get_user_by_id($id){
    $item = db_fetch_row("SELECT* FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}
function update_info_account($data, $user){
	db_update('tbl_users', $data, "`username` = '{$user}'");
}
function update_pass_new($data){
    db_update('tbl_users', $data, "`username` = '{$_SESSION['user_login']}'");
}
function get_info_admin($field, $admin_id){
    $info_admin_id = db_fetch_row("SELECT `$field` FROM `tbl_users` WHERE `user_id` = '{$admin_id}'");
    return  $info_admin_id[$field];
}
// Cập nhật user
function update_user($data, $admin_id){ 
    db_update('tbl_users', $data, "`user_id`='{$admin_id}'");
}
// Xóa user
function delete_user($admin_id){
    db_delete('tbl_users', "`user_id` = '{$admin_id}'");
}
// Thêm mới
function insert_user($data){
    db_insert('tbl_users', $data);
}
// active_users
// function update_active_user(){
//     db_update('tbl_pages', array('active'=>'Hoạt động'), "`created_person` = '{$_SESSION['user_login']}'");
// }
// function update_not_active_user(){
//     db_update('tbl_pages', array('active'=>'Không hoạt động'), "`created_person` = '{$_SESSION['user_login']}'");
// }
# active_admins
function update_active_user(){
    db_update('tbl_users', array('active'=>'Hoạt động'), "`username` = '{$_SESSION['user_login']}'");
}
function update_not_active_user(){
    db_update('tbl_users', array('active'=>'Không hoạt động'), "`username` = '{$_SESSION['user_login']}'");
}
// danh sách admins

function get_user($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $list_users = db_fetch_array("SELECT* FROM `tbl_users` {$where} LIMIT {$start}, {$num_per_page}");
    return $list_users;
}

?>
