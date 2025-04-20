<?php
get_header();
?>

<?php
    if (isset($_GET['partnerCode']) && isset($_GET['resultCode']) && $_GET['resultCode'] == 0) {
        $order_code = $_GET['orderId'];
        $partner_code = $_GET['partnerCode'];
        $trans_id = $_GET['transId'];
        $pay_type = $_GET['payType'];

        if (isset($_SESSION['order'])) {
            $order = $_SESSION['order'];

            // Lưu đơn hàng vào database
            $data_order = array(
                'order_code' => $order_code,
                'num_total' => $_SESSION['cart']['info']['num_order'],
                'total_price' => $_SESSION['cart']['info']['total'],
                'order_status' => 'Chờ duyệt',
                'customer_name' => $order['fullname'],
                'email' => $order['email'],
                'phone' => $order['phone'],
                'address' => $order['address'],
                'payment' => $order['payment'],
                'note' => $order['note'],
                'created_date' => date('d/m/Y H:i:s'),
                'partner_code' => $partner_code,
                'pay_type' => $pay_type,
                'trans_id' => $trans_id
            );

            insert_order($data_order);

            // Xóa giỏ hàng
            unset($_SESSION['cart']);
            unset($_SESSION['order']);

            echo "Cảm ơn bạn đã thanh toán! Đơn hàng của bạn đang được xử lý.";
        } else {
            echo "Không tìm thấy đơn hàng!";
        }
    } else {
        echo "Thanh toán thất bại hoặc bị hủy.";
    }
?>

<?php
get_footer();
?>
