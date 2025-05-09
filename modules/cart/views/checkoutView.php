<?php
get_header();
?>
<?php
$list_buy = get_list_by_cart();
$list_info = get_info_cart();
// Address
$list_province = db_fetch_array('SELECT* FROM `tbl_province`');
$list_district = db_fetch_array('SELECT* FROM `tbl_district`');
$list_commune = db_fetch_array('SELECT* FROM `tbl_commune`');
?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form method="POST" action="dat-hang.html" name="form-checkout">
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <?php echo form_error('success')?>
                <?php echo form_error('info')?>
                <div class="section-detail">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname" value="<?php echo info_user('fullname') ?>">
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="<?php echo info_user('email') ?>">
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone" value="<?php echo info_user('tel') ?>">
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ:</label>
                            <label for="province">Tỉnh/Thành Phố</label>
                            <select name="province" class="province">
                                <option value="">-- Chọn Tỉnh/Thành Phố--</option>
                                <?php if(!empty($list_province)) foreach($list_province as $province){
                                    ?>
                                    <option value="<?php echo $province['name']?>"><?php echo $province['name']?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <label for="district">Quận/Huyện</label>
                            <select name="district" class="district">
                                <option value="">-- Chọn Quận/Huyện --</option>
                            </select>
                            <label for="commune">Xã/Phường</label>
                            <select name="commune" class="commune">
                                <option value="">-- Chọn Xã/Phường --</option>                           
                            </select>
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note" rows="10" cols="75" placeholder="Ghi rõ địa chỉ đến số Nhà/Thôn, Xã/Phường, Quận/Huyện, Tỉnh/Thành phố! "><?php  echo set_value('note') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <?php if(!empty($list_buy)){
                            ?>
                        <tbody>
                            <?php foreach($list_buy as $product){
                                ?>
                            <tr class="cart-item">
                                <td class="product-name"><a href="<?php echo $product['slug'] ?>-<?php echo $product['product_id'] ?>-i.html"><?php echo $product['product_title']?></a><strong class="product-quantity">x <?php echo $product['qty']?></strong></td>
                                <td class="product-total"><?php echo currency_format($product['sub_total'])?></td>
                            </tr>
                            <?php
                                }
                                ?>
                        </tbody>
                        <?php
                        }
                        ?>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price"><?php if (isset($list_info['total'])) echo currency_format($list_info['total'])?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment-method" value="direct-payment">
                                <label for="direct-payment">Thanh toán tại cửa hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment-method" value="payment-home">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-momo" name="payment-method" value="payment-momo">
                                <label for="payment-momo">Thanh toán qua MOMO</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-momoatm" name="payment-method" value="payment-momoatm">
                                <label for="payment-momoatm">Thanh toán qua MOMO ATM</label>
                            </li>
                            <?php echo form_error('payment')?>
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" name="btn-order" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
get_footer();
?>