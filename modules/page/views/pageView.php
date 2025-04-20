<?php
get_header();

// Lấy page_id từ URL, nếu không có thì mặc định là 1
$page_id = isset($_GET['page_id']) ? intval($_GET['page_id']) : 82;

// Lấy thông tin trang từ database
$page = db_fetch_assoc("SELECT * FROM `tbl_pages` WHERE `page_id` = $page_id");

if (!$page) {
    echo "<h2>Trang không tồn tại!</h2>";
    get_footer();
    exit();
}
?>
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="/" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="?page_id=<?php echo $page_id; ?>" title=""><?php echo htmlspecialchars($page['title']); ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo $page['title']; ?></h3>
                </div>
                <div class="section-detail">
                    <span class="create-date"><?php echo $page['created_date']; ?></span>
                    <div class="detail">
                        <?php echo $page['page_content']; ?>
                    </div>
                </div>
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                </div>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>
<?php
get_footer();
?>
