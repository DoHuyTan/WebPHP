<?php
function construct(){
    load_model('index');
}
function indexAction(){
    if(isset($_GET['value'])){
                            load_view('search_admins');
                        } else{
                            load_view('teamIndex');
                        }
}
//Thêm tài khoản Admin
function addAction(){
    load('helper', 'image');
    load('helper', 'slug');
    global $username, $error, $email, $fullname, $tel, $address, $admin_status, $avatar, $creator, $role;
    if (isset($_POST['btn-add-admin'])) {
        $error = array();
        if (empty($_POST['fullname'])) {
            $error['fullname'] = 'Không được để trống Họ và tên';
        } else {
            if (!(strlen($_POST['fullname']) >= 2 && strlen($_POST['fullname']) <= 32)) {
                $error['fullname'] = 'Họ và tên từ 2 đến 32 ký tự';
            } else {
                $fullname = $_POST['fullname'];
            }
        }
        // Tên đăng nhập
        $username = trim($_POST['username']);
        if (empty($username)) {
            $error['username'] = 'Không được để trống tên đăng nhập';
        } elseif (strlen($username) < 6 || strlen($username) > 32) {
            $error['username'] = 'Tên đăng nhập phải từ 6 đến 32 ký tự';
        } elseif (!preg_match('/^[A-Za-z0-9_\.]{6,32}$/', $username)) {
            $error['username'] = 'Tên đăng nhập không đúng định dạng';
        } elseif (db_num_rows("SELECT * FROM `tbl_admins` WHERE `username` = '{$username}'") >= 1) {
            $error['username'] = 'Tên đăng nhập đã tồn tại';
        }

        // Mật khẩu
        $password_input = trim($_POST['password']);
        if (empty($password_input)) {
            $error['password'] = 'Không được để trống mật khẩu';
        } elseif (strlen($password_input) < 6 || strlen($password_input) > 32) {
            $error['password'] = 'Mật khẩu phải từ 6 đến 32 ký tự';
        } elseif (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*\W).{6,32}$/', $password_input)) {
            $error['password'] = 'Mật khẩu phải bắt đầu bằng chữ in hoa, chứa chữ cái, số và ký tự đặc biệt';
        } else {
            $password = md5($password_input); // Có thể thay bằng password_hash()
        }
        
        if (empty($_POST['email'])) {
            $error['email'] = 'Không được để trống email';
        } else {
            if(db_num_rows("SELECT*FROM `tbl_admins` WHERE `email` = '{$_POST['email']}'") >=1){
                $error['email'] = 'Email đã tồn tại';
            } else{
                $email = $_POST['email'];
            }
        }

       // check upload file
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            }
        } else {
            $error['upload_image'] = "(*) Bạn chưa upload tệp";
        }

        // check role
        if (empty($_POST['role'])) {
            $error['role'] = 'Bạn chưa chọn danh mục';
        } else {
            $role = $_POST['role'];
        }
        // check not error
        if (empty($error)) {
            if (is_login() && check_role($_SESSION['user_login']) == 1) {
                $admin_status = 'Approved';
            } else{
                $admin_status = 'Waitting...';
            }
            $avatar = upload_image('public/images/upload/admins/', $type);
            $creator =  get_admin_info($_SESSION['user_login']);
            $data = array(
            'avatar' => $avatar,
            'fullname' => $fullname,
            'username' => $username,
            'active' => 'Không hoạt động',
            'password' => md5($password),
            'admin_status' => $admin_status,
            'email' => $email,
            'tel' => $tel,
            'address' => $address,
            'reg_date' => date("d/m/Y"),
            'creator' => $creator,
            'role' => $role,
            );
            insert_admin($data);
            $error['admin'] = "Thêm ADMIN mới thành công"."<br>"."<a href='?mod=users&controller=team&action=index'>Trở về danh sách ADMIN</a>";
        }
    }
    if (isset($_POST['btn-upload-thumb'])) {
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            } else {
                $avatar = upload_image('public/images/upload/admins/', $type);
            }
        } else {
            $error['upload_image'] = "Bạn chưa chọn tệp ảnh";
        }
    }
    load_view('add_admins');
}
//Tác vụ Admin

function apply_adminsAction(){
    if(isset($_POST['sm_action'])){
        Global $error, $data;
        if(is_login() && check_role($_SESSION['user_login']) == 1){
            $error = array();
            if(!empty($_POST['checkItem'])){
                $list_admin_id = $_POST['checkItem'];
            }
            if(!empty($_POST['actions'])){
                if($_POST['actions'] == 1){
                    if(isset($_POST['checkItem'])){
                        $data = array(
                            'admin_status'=> 'Approved',
                        );
                        foreach($list_admin_id as $admin_id){
                        update_admin($data, $admin_id);  
                        }
                        if(isset($_GET['value'])){
                            load_view('search_admins');
                        } else{
                            if(isset($_GET['value'])){
                            load_view('search_admins');
                        } else{
                            load_view('teamIndex');
                        }
                        }
                    } else{
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if(isset($_GET['value'])){
                            load_view('search_admins');
                        } else{
                            if(isset($_GET['value'])){
                            load_view('search_admins');
                        } else{
                            load_view('teamIndex');
                        }
                        }
                    }
                }
                if($_POST['actions'] == 2){
                    if(isset($_POST['checkItem'])){
                        $data = array(
                            'admin_status'=> 'Waitting...',
                        );
                        foreach($list_admin_id as $admin_id){
                        update_admin($data, $admin_id);  
                        }
                        if(isset($_GET['value'])){
                            load_view('search_admins');
                        } else{
                            if(isset($_GET['value'])){
                            load_view('search_admins');
                        } else{
                            load_view('teamIndex');
                        }
                        }
                    } else{
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần áp dụng";
                        if(isset($_GET['value'])){
                            load_view('search_admins');
                        } else{
                            if(isset($_GET['value'])){
                            load_view('search_admins');
                        } else{
                            load_view('teamIndex');
                        }
                        }
                    }
                }
                if($_POST['actions'] == 3){
                    if(isset($_POST['checkItem'])){
                        $data = array(
                            'admin_status'=> 'Trash',
                        );
                        foreach($list_admin_id as $admin_id){
                        update_admin($data, $admin_id);  
                        }
                        if(isset($_GET['value'])){
                            load_view('search_admins');
                        } else{
                            if(isset($_GET['value'])){
                            load_view('search_admins');
                        } else{
                            load_view('teamIndex');
                        }
                        }
                    } else{
                        $error['select'] = "Bạn chưa lựa chọn ADMIN cần xóa";
                        if(isset($_GET['value'])){
                            load_view('search_admins');
                        } else{
                            if(isset($_GET['value'])){
                            load_view('search_admins');
                        } else{
                            load_view('teamIndex');
                        }
                        }
                    }
                }
            } else{
                $error['select'] = 'Bạn chưa lựa chọn tác vụ';
                if(isset($_GET['value'])){
                    load_view('search_admins');
                } else{
                    load_view('teamIndex');
                }
            }
        } else{
            $error['select'] = "Bạn không có quyền thực hiện thao tác này!";
            if(isset($_GET['value'])){
                load_view('search_admins');
            } else{
                load_view('teamIndex');
            }
        }
    }
}

//Cập nhật tài khoản Admin
function update_adminAction(){
    load('helper', 'image');
    load('helper', 'slug');
    global $error, $email, $fullname, $tel, $address, $avatar, $admin_status, $role;
    if(isset($_GET['admin_id'])){
        $admin_id = $_GET['admin_id'];
    }
    if (isset($_POST['btn-update-admin'])) {
        $error = array();
        // Check fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = 'Không được để trống Họ và tên';
        } else {
            if (!(strlen($_POST['fullname']) >= 2 && strlen($_POST['fullname']) <= 32)) {
                $error['fullname'] = 'Họ và tên từ 2 đến 32 ký tự';
            } else {
                $fullname = $_POST['fullname'];
            }
        }
        // Check email
        if (empty($_POST['email'])) {
            $error['email'] = 'Không được để trống email';
        } else {
            $email = $_POST['email'];
        }
        // Check tell
        if (!empty($_POST['tel'])) {
            $tel = $_POST['tel'];
        }
        // Check address
        if (!empty($_POST['address'])) {
            $address = $_POST['address'];
        }
        // check upload file
        if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "kích thước hoặc kiểu ảnh không đúng";
            } else {
                $old_thumb = get_info_admin('avatar', $admin_id);
                if(!empty($old_thumb)){
                    delete_image($old_thumb);
                    $avatar = upload_image('public/images/upload/admins/', $type); 
                } else {
                    $avatar = upload_image('public/images/upload/admins/', $type);
                }
            }
        } else{
            $avatar = get_info_admin('avatar', $admin_id);
        }
    
        // Check role
        if (empty($_POST['role'])) {
            $error['role'] = 'Bạn chưa chọn danh mục';
        } else {
            $role = $_POST['role'];
        }
        // check not error
        if (empty($error)) {
            $admin_status = 'Waitting...';
            $editor =  get_admin_info($_SESSION['user_login']);
            $data = array(
            'fullname' => $fullname,
            'email' => $email,
            'avatar' => $avatar,
            'tel' => $tel,
            'address' => $address,
            'role' => $role,
            'admin_status' => $admin_status,
            'editor'=> $editor,
            'edit_date'=> date('d/m/y h:m'),
            );
            update_admin($data, $admin_id);
            $error['admin'] = "Cập nhật ADMIN thành công"."<br>"."<a href='?mod=users&controller=team&action=index'>Trở về danh sách ADMIN</a>";
        }
    }
    load_view('update_admin');
}
// Xóa tài khoản Admin
function delete_adminAction(){
    $admin_id = $_GET['admin_id'];
    delete_admin($admin_id);
    if(isset($_GET['value'])){
        load_view('search_admins');
    } else{
        load_view('teamIndex');
    }
}
//================
// SEARCH ADMINS
//================
function search_adminsAction(){
    global $error, $value, $num_page;
    if (isset($_GET['sm_s'])) {
        if(!empty($_GET['value'])){
            $value = $_GET['value'];
            $num_per_page = 3;
            #Tổng số bản ghi
            $list_admins_all = db_search_all_admins($value);
            $total_row = count($list_admins_all);
            #Số trang
            $num_page = ceil($total_row / $num_per_page);
            load_view('search_admins');
        } else{
            $error['error'] = 'Bạn cần nhập thông tin ADMINS cần tìm kiếm!';
            load_view('teamIndex');
        }
    }
}
function result_searchAction(){
    global $value;
    if(!empty($_GET['value'])){
        $value = $_GET['value'];
    }
    load_view('search_admins');
}

