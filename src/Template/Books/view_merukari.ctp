<html>
<head>
 <meta charset="utf-8html tab">
 <title>图书数据</title>
</head>
<body>
 <div class="books view large-9 medium-8 columns content">
    <h1>Merukari</h1>
    <?= $this->Form->create($searchmerukariform,['type' => 'get']);?>

      <?php
          echo $this->Form->hidden('form_name',['value' => 'searchform_name']);
          echo $this->Form->control('key_words');
          echo $this->Form->select('category_id',[
                            '種類' => ['' => 'すべて' ,668 => '文学/小説',669 => '人文/社会',670 => 'ノンフィクション/教養',671 => '地図/旅行ガイド',
                            672 => 'ビジネス/経済',673 => '健康/医学',674 => 'コンピュータ/IT',675 => '趣味/スポーツ/実用',
                            676 => '住まい/暮らし/子育て',677 => 'アート/エンタメ',678 => '洋書',1124 => '参考書',679 => 'その他']
                          ]);
          echo $this->Form->select('book_status',[
                            '商品の状態' => ['' => 'すべて',1 => '新品、未使用',2 => '未使用に近い',3 => '目立った傷や汚れなし',
                            4 => 'やや傷や汚れあり',5 => '傷や汚れあり',6 => '全体的に状態が悪い']
                          ]);
          echo $this->Form->select('delivery_id',[
                            '配送料の負担' => ['' => 'すべて',1 => '着払い(購入者負担)',2 =>'送料込み(出品者負担)']
                          ]);
          echo $this->Form->select('sale_status',[
                            '販売状況' => ['' => 'すべて',1 => '販売中',2 => '売り切れ']
                          ]);
      ?>
    <?= $this->Form->submit('検索') ?>
    <?= $this->Form->end() ?>
    <table>
      <?php
      foreach ($merukari as $value) {
      ?>
        <tr>
            <td><?php echo $value["price"] ?></td>
            <td><img src="<?php echo $value["book_img"] ?>"></td>
            <td><?php echo $value["sale_status"] ?></td>
            <td><?php echo $value["book_name"] ?></td>
            <td><button onClick="location.href='<?php echo $value["buy_link"] ?>'">購入</button></td>
        </tr>
      <?php } ?>

    </table>
 </div>
</body>
</html>
