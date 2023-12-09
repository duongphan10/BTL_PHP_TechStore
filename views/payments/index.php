<?php
require_once 'helpers/Helper.php';
?>
<div class="container" style="
    margin-bottom: 30px;
">
    <h2 style="text-align: center; color: blue; font-weight: bold">Thanh toán</h2>
    <form action="" method="POST">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <h3 class="center-align">Thông tin khách hàng</h3>
                <div class="form-group">
                    <label>Họ tên khách hàng</label>
                    <input type="text" name="fullname" value="<?php echo $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name']; ?>" class="form-control" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Địa chỉ nhận hàng</label>
                    <input type="text" name="address" value="<?php echo $_SESSION['user']['address']; ?>" class="form-control" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="number" min="0" name="mobile" value="<?php echo $_SESSION['user']['phone']; ?>" class="form-control" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" min="0" name="email" value="<?php echo $_SESSION['user']['email']; ?>" class="form-control" placeholder="" readonly>
                </div>
                <div class="form-group">
                    <label>Ghi chú</label>
                    <textarea name="note" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label>Chọn phương thức thanh toán</label> <br />
                    <input type="radio" name="method" value="0" disabled/> Thanh toán trực tuyến <br />
                    <input type="radio" name="method" checked value="1" /> Thanh toán khi nhận hàng<br />
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <h3 class="center-align">Thông tin đơn hàng</h3>
                <?php
                //biến lưu tổng giá trị đơn hàng
                $total = 0;
                if (isset($_SESSION['cart'])) :
                ?>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th width="40%" style="padding-left: 10px;">Tên sản phẩm</th>
                                <th width="12%">Số lượng</th>
                                <th>Giá</th>
                                <th>Thành tiền</th>
                            </tr>
                            <?php foreach ($_SESSION['cart'] as $product_id => $cart) :
                                $product_link = 'san-pham/' . Helper::getSlug($cart['name']) . "/$product_id";
                            ?>
                                <tr>
                                    <td style="padding-left: 10px;">
                                        <?php if (!empty($cart['avatar'])) : ?>
                                            <img class="product-avatar img-responsive" src="./backend/assets/uploads/<?php echo $cart['avatar']; ?>" width="60" />
                                        <?php endif; ?>
                                        <div class="content-product">
                                            <a href="<?php echo $product_link; ?>" class="content-product-a">
                                                <?php echo $cart['name']; ?>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="product-amount">
                                            <?php echo $cart['quality']; ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="product-price-payment">
                                            <?php echo number_format($cart['price'], 0, '.', '.') ?> đ
                                        </span>
                                    </td>
                                    <td>
                                        <span class="product-price-payment">
                                            <?php
                                            $price_total = $cart['price'] * $cart['quality'];
                                            $total += $price_total;
                                            ?>
                                            <?php echo number_format($price_total, 0, '.', '.') ?> đ
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="5" class="product-total" style="padding-left: 10px;">
                                    Tổng giá trị đơn hàng:
                                    <span class="product-price">
                                        <?php echo number_format($total, 0, '.', '.') ?> đ
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>

            </div>
        </div>
        <input type="submit" name="submit" value="Thanh toán" class="btn btn-primary">
        <a href="gio-hang-cua-ban" class="btn btn-secondary">Về trang giỏ hàng</a>
    </form>
</div>