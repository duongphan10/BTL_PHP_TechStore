<?php
require_once 'helpers/Helper.php';
?>

<h2>Danh sách thanh toán</h2>

<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Order_id</th>
        <th>Product_id</th>
        <th>Quantity</th>
        <th></th>
    </tr>
    <?php if (!empty($order_details)): ?>
        <?php foreach ($order_details as $order_detail): ?>
            <tr>
                <td><?php echo $order_detail['id'] ?></td>
                <td><?php echo $order_detail['order_id'] ?></td>
                <td><?php echo $order_detail['product_id'] ?></td>
                <td><?php echo $order_detail['quality'] ?></td>

                <td style="text-align: center">
                    <?php
                    $url_delete = "index.php?controller=orderdetail&action=delete&id=" . $order_detail['order_id'];
                    ?>
                    &nbsp;
                    <a title="Xóa" href="<?php echo $url_delete ?>" onclick="return confirm('Are you sure delete?')"><i
                            class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>

    <?php else: ?>
        <tr>
            <td colspan="9">No data found</td>
        </tr>
    <?php endif; ?>
</table>