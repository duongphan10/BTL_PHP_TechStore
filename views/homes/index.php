<?php
require_once 'helpers/Helper.php';
?>

<div class="wapper">

    <div class="wap1">
        <div class="container">
            <div class="row">

                <?php
                foreach ($compo_imgs as $compo_img) :
                ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 page-item wow fadeInUp item_1" style="visibility: visible; animation-name: fadeInUp;">
                        <div class="banner_home">
                            <div class="banner-img-home">
                                <a href="#">
                                    <div class="img_banner_home" style="background-image: url(./backend/assets/uploads/<?php echo $compo_img['component_img'] ?>)">
                                    </div>
                                </a>
                            </div>
                            <div class="content_banner_home">
                                <div class="title_banner_home">
                                    <a href="#">
                                        <h2>
                                            <span><?php echo $compo_img['title_component'] ?></span>
                                        </h2>
                                    </a>
                                </div>
                                <div class="detail_banner_home text-center">
                                    <p> <?php echo $compo_img['title_detail'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="wap-list-product">
        <div class="container">
            <div class="top-line"></div>
            <div class="heading-title">
                <h3>
                    Sản phẩm nổi bật
                </h3>
                <p class="text-center">
                    Sản phẩm công nghệ chính hãng
                </p>
            </div>
            <div class="row content-product-list products-resize">
                <!--                START ITEM-->
                <?php if (!empty($products)) : ?>
                    <?php
                    foreach ($products as $product) :
                        $product_title = $product['title'];
                        $product_slug = Helper::getSlug($product_title);
                        $product_id = $product['id'];
                        $product_weight = $product['weight'];
                        $product_supplier = $product['supplier'];
                        $product_link = "chi-tiet-san-pham/$product_slug/$product_id";

                    ?>
                        <div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp animation rainbow_0" style="visibility: visible; animation-name: fadeInUp;">
                            <div class="product-item product-resize">
                                <div class="product-img image-resize">
                                    <a href="<?php echo $product_link; ?>" title="<?php echo $product_title; ?>">
                                        <img alt=" <?php echo $product_title; ?> " src="./backend/assets/uploads/<?php echo $product['avatar']; ?>" />
                                    </a>
                                    <a href="<?php echo $product_link; ?>" class="mask-brg"></a>
                                    <div class="hover-mask">
                                        <div class="inner-mask">
                                            <a class="add-view-cart btn-cart add-cart " data-variant="1007783439" href="them-vao-gio-hang/<?php echo $product['id']; ?>" title="Thêm vào giỏ">
                                                <i class="fa fa-bars"></i>
                                                Thêm vào giỏ
                                            </a>
                                            <ul class="add-to-links">
                                                <li><a href="<?php echo $product_link; ?>" class="mask-view" data-handle="/products/phuc-bon-tu" title="Xem chi tiết"><i class="fa fa-eye"></i></a></li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-detail">
                                    <h3 class="pro-name"><a href="<?php echo $product_link; ?>" title="<?php echo $product_title; ?>"><?php echo $product_title; ?><?php ?> </a></h3>
                                    <p class="pro-vendor">
                                        Hãng sản xuất: <span><?php echo $product_supplier; ?></span>
                                    </p>
                                    <div class="box-price">
                                        <p class="pro-price"><?php echo number_format($product['price']); ?></p>
                                    </div>
                                    <p class="pro-price-del">

                                    </p>
                                </div>
                            </div>
                        </div>
                        <!--END ITEM             -->

                    <?php endforeach; ?>
                <?php else : ?>
                    <h2>Không có sản phẩm nào</h2>
                <?php endif; ?>


            </div>
        </div>
    </div>


    <div class="wap2">

        <div class="heading-title">
            <h3>HÌNH ẢNH CÁC SẢN PHẨM CÔNG NGHỆ</h3>
        </div>
        <div class="gallery-image">
            <ul class="list-gallery  ">



                <?php
                foreach ($compo_imgs as $compo_img) :
                ?>
                    <li class="col-lg-3 col-md-3 col-sm-6 col-xs-6 img_1 wow slideInLeft">
                        <a class="fancybox" rel="group" href="./backend/assets/uploads/<?php echo $compo_img['store_img'] ?>">
                            <div class="bkg-fancybox" style="background-image:url(./backend/assets/uploads/<?php echo $compo_img['store_img'] ?>);background-size:cover;cursor: pointer;">
                            </div>
                        </a>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".fancybox").fancybox();
            });
        </script>

    </div> 

    <div class="wap4">
        <div class="container">


            <div class="newsletter">
                <div class="home-title">
                    <h2>Tin tức</h2>
                </div>
                <div class="row">
                    <?php
                    foreach ($news as $new) :
                        $new_id = $new['id'];
                        $new_link = "chi-tiet-news/$new_id";
                    ?>
                        <div class="col-md-4 wow fadeInUp">
                            <div class="news-item  text-center">
                                <div class="img-news">
                                    <a href="<?php echo $new_link; ?>">

                                        <img src="./backend/assets/uploads/<?php echo $new['avatar'] ?>" alt="<?php echo $new['title'] ?>">

                                    </a>
                                </div>
                                <div class="content-news">
                                    <h3 class="title-news"><a href="<?php echo $new_link;?>"><?php echo $new['title']?></a></h3>
                                    <div class="detail-news">
                                        <?php echo $new['summary'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


        </div>
    </div>



</div>