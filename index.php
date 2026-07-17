<?php
require "data.php";

// Tạo mảng map id -> tên danh mục
$categoryMap = [];

foreach ($categories as $category) {
    $categoryMap[$category["id"]] = $category["name"];
}

// Biến tính tổng giá trị kho
$totalValue = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MiniShop — Catalog (Buoi 1)</title>
</head>

<body>

<h2>MiniShop — Catalog (Buoi 1)</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>SKU</th>
        <th>Tên</th>
        <th>Danh mục</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Thành tiền</th>
    </tr>

<?php

foreach ($products as $product) {

    // Tính thành tiền
    $thanhTien = $product["price"] * $product["qty"];

    // Cộng dồn tổng giá trị kho
    $totalValue += $thanhTien;

    echo "<tr>";
    echo "<td>" . htmlspecialchars($product["sku"]) . "</td>";
    echo "<td>" . htmlspecialchars($product["name"]) . "</td>";
    echo "<td>" . htmlspecialchars($categoryMap[$product["category_id"]]) . "</td>";
    echo "<td>".$product["price"]."</td>";
    echo "<td>".$product["qty"]."</td>";
    echo "<td>".$thanhTien."</td>";
    echo "</tr>";
}

?>

</table>

<br>

<?php
echo "<b>Tổng giá trị kho = ".$totalValue."</b>";

echo "<br><br>";

echo "<b>Số sản phẩm = ".count($products)."</b>";
?>

<br><br>

<pre>
<?php
var_dump($products);
?>
</pre>

</body>
</html>
<!-- MS_EXPECT product_count=8 inventory_value=41380000 -->