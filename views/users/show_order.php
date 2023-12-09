<!DOCTYPE html>
<html>

<head>
    <title>Thông tin đơn hàng đã đặt</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        .btn-return {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            margin-top: 20px;
        }

        .btn-return a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #44a2e0;
            color: #000;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-return a:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>   


    <div class="">
        <form>
            <div class="">
                <div class="">
                    <h2 class="">Thông tin đơn hàng đã đặt</h2>
                    <table class="">
                        <tbody>
                            <tr>
                                <th style="text-align: center;">Mã đơn hàng</th>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá (VNĐ)</th>
                                <th>Thành tiền (VNĐ)</th>
                                <th>Địa chỉ nhận</th>
                                <th>Ngày mua</th>

                            </tr>
                            <?php
                            require_once 'helpers/Helper.php';

                            foreach ($orders as $row) :
                            ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <?php echo $row['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['name']; ?>

                                    </td>
                                    <td>
                                        <?php echo $row['soluongmua']; ?>

                                    </td>
                                    <td>
                                        <?php echo number_format($row['price']); ?>
                                    </td>
                                    <td>
                                        <?php echo number_format($row['soluongmua'] * $row['price']); ?>
                                    </td>
                                    <td>
                                        <?php echo $row['address']; ?>
                                    </td>

                                    <td>
                                        <?php echo (new DateTime($row['created_at']))->format("d-m-Y H:i:s"); ?>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </form>
    </div>

    <div class="btn-return">
        <a class="" href="#">Quay lại trang chủ</a>
    </div>

</body>

</html>