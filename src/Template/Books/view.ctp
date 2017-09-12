<?php
use App\Model\Table\MerukariTable;
?>

<html>
<head>
 <meta charset="utf-8html tab">
 <title>图书数据</title>
</head>
<body>
 <div class="books view large-9 medium-8 columns content">
    <h1>Merukari</h1>
    <table>
      <?php
      $merukari = new MerukariTable;
      $merukari = $merukari->get_books(1);
      foreach ($merukari as $value) {
      ?>
        <tr>
            <td><?php echo $value["price"] ?></td>
            <td><?php echo $value["book_img"] ?></td>
            <td><?php echo $value["sale_status"] ?></td>
            <td><?php echo $value["book_name"] ?></td>
            <td><?php echo $value["buy_link"] ?></td>
        </tr>
      <?php } ?>

    </table>
 </div>
</body>
</html>
