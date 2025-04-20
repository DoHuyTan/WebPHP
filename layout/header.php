<?php
$list_buy = get_list_by_cart();
$list_info = get_info_cart();
$list_menus = db_fetch_array("SELECT*FROM `tbl_menus` ORDER BY `menu_order` ASC");


?>
<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo base_url(); ?>" />
    <link href="public/reset.css" rel="stylesheet" type="text/css" />
    <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="public/style.css" rel="stylesheet" type="text/css" />
    <link href="public/main.css" rel="stylesheet" type="text/css" />
    <link href="public/slider.css" rel="stylesheet" type="text/css" />
    <link href="public/responsive.css" rel="stylesheet" type="text/css" />

    <script src="public/js/slider.js" type="text/javascript"></script>
    <script src="public/js/main.js" type="text/javascript"></script>
    <script src="public/js/app.js" type="text/javascript"></script>
    <script src="public/js/zoom.js" type="text/javascript"></script>
</head>

<body>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <?php if (!empty($list_menus)) {
                            ?>
                                <ul id="main-menu" class="clearfix">
                                    <?php foreach ($list_menus as $menu) {
                                    ?>
                                        <li>
                                            <a href="<?php echo $menu['menu_url_static'] ?>-<?php echo $menu['menu_id'] ?>.html" title=""><?php echo $menu['menu_title'] ?></a>
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="logo" class="fl-left"><img src="public/images/logo.png" /></a>
                        <div id="search-wp" class="fl-left">
                            <form method="POST" action="tim-kiem.html">
                                <input type="text" name="value" id="s" placeholder="Nhập từ khóa tìm kiếm tại đây!" value="<?php echo set_value('value') ?>">
                                <button type="submit" id="sm-s" name="sm_s" value="Tìm kiếm">Tìm kiếm</button>
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0865.375.147</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="gio-hang.html" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num"><?php if (!empty($list_buy)) {
                                                    echo count($list_buy);
                                                } else {
                                                    echo '0';
                                                } ?></span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <a href="gio-hang.html" style="color: #fff;"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                    <span id="num"><?php if (!empty($list_buy)) {
                                                        echo count($list_buy);
                                                    } else {
                                                        echo '0';
                                                    } ?></span>
                                </div>
                                <div id="dropdown">
                                    <p class="desc">Có <span><?php if (!empty($list_buy)) {
                                                                    echo count($list_buy);
                                                                } else {
                                                                    echo '0';   
                                                                } ?> sản phẩm</span> trong giỏ hàng</p>
                                    <?php if (!empty($list_buy)) {
                                    ?>
                                        <ul class="list-cart">
                                            <?php foreach ($list_buy as $product) {
                                            ?>
                                                <li class="clearfix">
                                                    <a href="<?php echo $product['slug'] ?>-<?php echo $product['product_id'] ?>-i.html" title="" class="thumb fl-left">
                                                        <img src="admin/<?php echo  $product['product_thumb'] ?>" alt="">
                                                    </a>
                                                    <div class="info fl-right">
                                                        <a href="<?php echo $product['slug'] ?>-<?php echo $product['product_id'] ?>-i.html" title="" class="product-name"><?php echo  $product['product_title'] ?></a>
                                                        <p class="price"><?php echo currency_format($product['product_price_new']) ?></p>
                                                        <p class="qty">Số lượng: <span><?php echo  $product['qty'] ?></span></p>
                                                    </div>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        </ul>
                                    <?php
                                    }
                                    ?>
                                    <div class="total-price clearfix">
                                        <?php
                                        if (empty($list_buy)) {
                                        ?>
                                            <p class="title fl-left">Tổng: 0</p>
                                        <?php
                                        } else {
                                        ?>
                                            <p class="title fl-left">Tổng:</p>
                                            <p class="price fl-right"><?php echo currency_format($list_info['total']) ?></p>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <dic class="action-cart clearfix">
                                        <a href="gio-hang.html" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                        <a href="thanh-toan.html" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                    </dic>
                                </div>
                            </div>
                            <!-- User dropdown -->
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <div class="dropdown dropdown-user fl-right">
                                <?php if (is_login()) { ?>
                                    <a href="#" class="dropdown-toggle clearfix" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div id="thumb-circle" class="fl-left">
                                            <img src="<?php echo get_info_account('avatar') ?>" alt="avatar">
                                        </div>
                                        <h3 id="account" class="fl-right" style="color: #fff"><?php echo get_info_account('display_name') ?></h3>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="?mod=users&action=info_account">Thông tin tài khoản</a></li>
                                        <li><a href="?mod=users&action=logout">Thoát</a></li>
                                    </ul>
                                <?php } else { ?>
                                    <a href="dang-nhap.html" title="Đăng nhập" id="login-wp" class="fl-right" style="color: #fff; font-size: 15px; font-family: 'Roboto', sans-serif;">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        Đăng nhập
                                    </a>

                                <?php } ?>
                            </div>

                        </div>
                        
                    </div>
                </div>
            </div>
            <style>
                /* HEADER */
                #head-top { background: #d9263c; }
                #head-top #main-menu li { float: left; }
                #head-top #payment-link {
                    position: relative;
                    display: block;
                    color: #fff;
                    padding: 10px 0px 10px 20px;
                }
                #head-top #payment-link:before {
                    position: absolute;
                    content: '\f0c1';
                    font-family: 'FontAwesome';
                    top: 10px;
                    left: 0;
                }
                #head-top #main-menu li a {
                    display: block;
                    color: #fff;
                    padding: 10px 15px;
                }
                #head-top #main-menu li:last-child a { padding-right: 0!important; }
                #head-body { background: #f12a43; }
                #head-body #logo {
                    display: block;
                    text-transform: uppercase;
                    font-family: 'Roboto Medium';
                    color: #fff;
                    padding: 13px 0px;
                }
                #head-body #search-wp { padding: 22px 0px 22px 195px; }
                #head-body #search-wp #s {
                    display: inline-block;
                    width: 250px;
                    border: none;
                    outline: none;
                    padding: 8px 20px;
                    line-height: normal;
                }
                #head-body #search-wp #sm-s {
                    position: relative;
                    left: -4px;
                    display: inline-block;
                    border: none;
                    outline: none;
                    background: #111111;
                    color: #fff;
                    padding: 10px 20px;
                    line-height: 13px;
                    font-size: 13px;
                }
                #head-body #search-wp #sm-s:hover { background: #444444; }

                /* Action wrapper */
                #action-wp {
                    display: flex;
                    align-items: center;
                    justify-content: flex-end;
                    gap: 15px;
                    margin-left: auto; /* Đẩy toàn bộ khối sang phải */
                }

                /* Advisory section */
                #advisory-wp {
                    position: relative;
                    padding: 15px 30px 15px 50px;
                    white-space: nowrap;
                }
                #advisory-wp:before {
                    position: absolute;
                    content: '\f2a0';
                    font-family: 'FontAwesome';
                    top: 50%;
                    left: 0px;
                    font-size: 21px;
                    color: #fff;
                    width: 38px;
                    height: 38px;
                    line-height: 35px;
                    border: 2px solid #fff;
                    border-radius: 50%;
                    text-align: center;
                    transform: translateY(-50%);
                }
                #advisory-wp:after {
                    position: absolute;
                    content: '';
                    width: 1px;
                    height: 50%;
                    background: #da263c;
                    top: 50%;
                    right: 0;
                    transform: translateY(-50%);
                }
                #advisory-wp span {
                    position: relative;
                    display: block;
                    color: #fff;
                }
                #advisory-wp .title { font-size: 15px; }
                #advisory-wp .phone { font-family: 'Roboto Bold'; font-size: 16px; }

                /* Cart section */
                #cart-wp, #cart-respon-wp {
                    position: relative;
                    display: block;
                    color: #fff;
                    padding: 20px 0px 20px 30px;
                }
                #cart-wp i, #cart-respon-wp i {
                    font-size: 20px;
                    width: 37px;
                    height: 37px;
                    line-height: 33px;
                    text-align: center;
                    border: 2px solid #fff;
                    border-radius: 50%;
                }
                #cart-wp #num, #cart-respon-wp #num {
                    position: absolute;
                    top: 10px;
                    right: -10px;
                    font-size: 16px;
                    font-family: 'Roboto Medium';
                }
                #cart-respon-wp { display: none; }
                #cart-wp { position: relative; cursor: pointer; }
                #cart-wp #dropdown {
                    visibility: hidden;
                    opacity: 0;
                    position: absolute;
                    top: 90px;
                    right: 0;
                    width: 250px;
                    min-height: 100px;
                    padding: 10px;
                    background: #fff;
                    border: 1px solid #e1e1e1;
                    transition: all .3s ease;
                    -moz-transition: all .3s ease;
                    -webkit-transition: all .3s ease;
                    -o-transition: all .3s ease;
                    z-index: 1000;
                }
                #cart-wp:hover #dropdown {
                    top: 78px;
                    opacity: 1;
                    visibility: visible;
                }
                #cart-wp .list-cart { margin-bottom: 15px; }
                #cart-wp .list-cart li {
                    padding-bottom: 5px;
                    margin-bottom: 5px;
                    border-bottom: 1px solid #ddd;
                }
                #cart-wp .list-cart li:last-child { 
                    margin-bottom: 0!important; 
                    border-bottom: none; 
                    padding-bottom: 0!important;
                }
                #cart-wp .list-cart .thumb { width: 25%; }
                #cart-wp .list-cart .info { width: 75%; padding-left: 15px; }
                #cart-wp #dropdown .desc { margin-bottom: 15px; color: #333; }
                #cart-wp #dropdown .desc span { color: #d9263c; font-family: 'Roboto Medium'; }
                #cart-wp #dropdown .list-cart .info .product-name {
                    display: block;
                    font-size: 13px;
                    color: #333;
                }
                #cart-wp #dropdown .list-cart .info .price {
                    display: block;
                    font-family: 'Roboto Medium';
                    font-size: 15px;
                    color: #333;
                }
                #cart-wp #dropdown .list-cart .info .qty {
                    display: block;
                    font-size: 13px;
                    font-family: 'Roboto Light';
                    color: #999;
                }
                #cart-wp #dropdown .total-price {
                    text-transform: uppercase;
                    font-family: 'Roboto Medium';
                    font-size: 15px;
                    margin-bottom: 15px;
                    color: #000;
                    line-height: normal;
                }
                #cart-wp #dropdown .action-cart a {
                    display: block;
                    padding: 5px 20px;
                    font-family: 'Roboto Bold';
                    text-transform: uppercase;
                    font-size: 12px;
                }
                #cart-wp #dropdown .action-cart a.view-cart { background: #ddd; color: #333; }
                #cart-wp #dropdown .action-cart a.checkout { background: #d9263c; color: #fff; }
                #cart-wp #dropdown .action-cart a.view-cart:hover { background: #ccc; }
                #cart-wp #dropdown .action-cart a.checkout:hover { background: #af1427; }

                /* User dropdown section */
                .dropdown-user {
                    position: relative;
                    padding: 20px 0px 20px 30px;
                    cursor: pointer;
                }
                
                .dropdown-user .dropdown-toggle i {
                    font-size: 20px;
                    width: 37px;
                    height: 37px;
                    line-height: 33px;
                    text-align: center;
                    border: 2px solid #fff;
                    border-radius: 50%;
                }
                
                .dropdown-user .dropdown-menu {
                    visibility: hidden;
                    opacity: 0;
                    position: absolute;
                    top: 90px;
                    right: 0;
                    width: 250px;
                    padding: 10px;
                    background: #fff;
                    border: 1px solid #e1e1e1;
                    transition: all .3s ease;
                    z-index: 1000;
                }
                
                .dropdown-user:hover .dropdown-menu {
                    top: 78px;
                    opacity: 1;
                    visibility: visible;
                }
                
                .dropdown-user .dropdown-menu li {
                    padding: 8px 0;
                    border-bottom: 1px solid #eee;
                }
                
                .dropdown-user .dropdown-menu li:last-child {
                    border-bottom: none;
                }
                
                .dropdown-user .dropdown-menu li a {
                    display: block;
                    color: #333 !important;
                    padding: 5px 10px;
                    font-size: 15px;
                }
                
                .dropdown-user .dropdown-menu li a:hover {
                    color: #d9263c !important;
                    background: #f9f9f9;
                }
                
                /* Responsive */
                @media (max-width: 800px) {
                    .dropdown-user {
                        padding: 15px 0px 15px 15px !important;
                    }
                    
                    .dropdown-user .dropdown-menu {
                        top: 70px !important;
                        right: 10px !important;
                    }
                    
                    .dropdown-user:hover .dropdown-menu {
                        top: 60px !important;
                    }
                }
                #thumb-circle {
                    width: 35px;
                    height: 35px;
                    border-radius: 50%; /* Làm tròn ảnh */
                    overflow: hidden;
                    margin-right: 10px; /* Cách chữ một khoảng */
                }

                #thumb-circle img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover; /* Đảm bảo ảnh không méo */
                    display: block;
                }

            </style>