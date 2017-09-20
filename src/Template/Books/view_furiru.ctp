<?php
use App\Model\Table\FuriruTable;
?>

<html>
<head>
 <meta charset="utf-8html tab">
 <title>图书数据</title>
</head>
<body>
 <div class="books view large-9 medium-8 columns content">
    <h1>FRIL</h1>
    <?= $this->Form->create($searchFuriruForm,['type' => 'get'])?>
      <fieldset>
      <?php
          echo $this->Form->hidden('form_name',['value' => 'search_furiru_form']);

          //キーワード
          echo $this->Form->control('key_words',['label' => "キーワードを追加する"]);
          //カテゴリ
          echo $this->Form->select('category_id',[
                            '種類' => [733 => 'すべて' ,734 => '文学/小説',735 => '人文/社会',736 => 'ノンフィクション/教養',737 => '地図/旅行ガイド',
                            738 => 'ビジネス/経済',739 => '健康/医学',740 => 'コンピュータ/IT',741 => '趣味/スポーツ/実用',742 => '住まい/暮らし/子育て',
                            743 => 'アート/エンタメ',744 => '洋書',745=>'その他',1663 =>'絵本/児童書',1664=> '参考書',1665 => '資格/検定']
                          ]);
          //商品状態
          echo $this->Form->select('book_status',[
                            '商品の状態' => ['' => 'すべて','new' => '新品・未使用のみ']
                          ]);
          //配送料の負担
          echo $this->Form->select('carriage',[
                            '配送料の負担' => ['' => 'すべて',1 => '送料込みのみ']
                          ]);
          //販売状況
          echo $this->Form->select('transaction',[
                            '販売状況' => ['' => 'すべて',"selling" => '販売中',"soldout" => '売り切れ']
                          ]);
      ?>
      <fieldset>
      <?= $this->Form->submit('検索') ?>
      <?= $this->Form->end() ?>
    <table>
      <?php
      // $furiru = new FuriruTable();
      // $furiru = $furiru->get_books($id);
      foreach ($furiru as $value) {
      ?>
        <tr>
          <td><img src=<?php echo $value["book_image"] ?>></td>
          <td><?php echo $value["book_name"] ?></td>
          <td><?php echo $value["transaction"] ?></td>
          <td><?php echo $value["book_price"] ?></td>
          <td><input type="button" value="購入" onClick="location.href='<?php echo $value["book_link"] ?>'"></button></td>
        </tr>
      <?php } ?>

    </table>
 </div>
</body>
</html>
