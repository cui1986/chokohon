<?php
use App\Model\Table\AmazonTable;
?>

<html>
<head>
 <meta charset="utf-8html tab">
 <title>图书数据</title>
</head>
<body>
 <div class="books view large-9 medium-8 columns content">
    <h1>furiru</h1>
    <table class="vertical-table">
      <?php
      $AmazonTable = new AmazonTable();
      $furiru=$AmazonTable->get_books(4306085473);
      var_dump($aa);

      foreach ($AmazonTable as $value) {

      ?>
        <tr>
            <td></td>
        </tr>
      <?php } ?>

    </table>
 </div>
</body>
</html>
