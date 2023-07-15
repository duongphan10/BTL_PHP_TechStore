<?php
require_once 'helpers/Helper.php';
?>

<!-- <h1 style="text-align:center;">Cảm ơn bạn đã đặt hàng</h1> -->
<!DOCTYPE html>
<html>
<head>
    <title>Đặt hàng thành công</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .thank-you-container {
            max-width: 100%;
            /* margin: 50px auto; */
            padding: 30px;
            /* background-color: #fff; */
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .thank-you-container h2 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .thank-you-message {
            font-size: 17px;
            color: #555;
            margin-bottom: 30px;
        }

        .thank-you-button {
            display: inline-block;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .thank-you-button:hover {
            background-color: #45a049;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="thank-you-container">
        <h2 class="center-align">Đặt hàng thành công</h2>
        <p class="thank-you-message">Cám ơn bạn đã đặt hàng của chúng tôi. Bạn vui lòng thanh toán khi nhận hàng.</p>
        <a class="thank-you-button" href="#">Quay lại trang chủ</a>
    </div>


    <div class="container" style="margin-bottom: 30px; margin-left: 20%;">
        <form action="" method="POST">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                <h2 class="center-align">Thông tin đơn hàng</h2>
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
                                                <img class="product-avatar img-responsive" src="../backend/assets/uploads/<?php echo $cart['avatar']; ?>" width="60" />
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
            
        </form>
    </div>

</body>
</html>