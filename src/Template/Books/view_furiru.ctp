<?php
use App\Model\Table\FuriruTable;
?>

<html>
<head>
<meta charset="utf-8html tab">
<title>图书搜索</title>
</head>
<body>
  <div class="books view large-9 medium-8 columns content">
    <?= $this->Form->create($searchFuriruForm, array('type' => 'get')) ?>
    <fieldset>
    <?php
      echo $this->Form->hidden('form_name',['value' => "search_merukari_form"]);
      echo $this->Form->control('key_words',['label' => "キーワードを追加する"]);
      echo $this->Form->control('category_id',['label'=>"カテゴリ",'type'=>'select']);
      echo $this->Form->control('book_status',['label'=>"商品状態",'type'=>'select']);
      echo $this->Form->control('carriage',['label'=>"配送料の負担",'type'=>'select']);
      echo $this->Form->control('sale_status',['label'=>"販売状況",'type'=>'select']);
    ?>
    </fieldset>
    <?= $this->Form->end() ?>
  </div>
  <div class="books view large-9 medium-8 columns content">
      <table class="vertical-table">
          <tr>
              <th scope="row"><?= __('商品画像') ?></th>
              <th scope="row"><?= __('商品名') ?></th>
              <th scope="row"><?= __('販売状況') ?></th>
              <th scope="row"><?= __('価格') ?></th>
              <th scope="row"><?= __('購入') ?></th>
          </tr>
      </table>
      <table>
        <?php
        $furiru = new FuriruTable();
        $furiru = $furiru->get_books(1);
        foreach ($furiru as $value) {
        ?>
          <tr>
              <td><img src=<?php echo $value["book_image"] ?>></td>
              <td><?php echo $value["book_name"] ?></td>
              <td><?php echo $value["book_status"] ?></td>
              <td><?php echo $value["book_price"] ?></td>
              <td><button onClick="location.href='<?php echo $value["book_link"] ?>'">購入</button> </td>
          </tr>
        <?php } ?>
      </table>
  </div>

</body>
</html>