<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- 上面的要移至default文件 -->
<script>
    $(document).ready(function () {
        $("#key_words").val("<?php echo $rules["key_words"] ?>");
        function select_form(formId, optionValue) {
            $("#" + formId).find("option[value='" + optionValue + "']").attr("selected", true);
        }
        select_form("category_id",<?php echo $rules["category_id"] ?>);
        select_form("condition_type",<?php echo $rules["condition_type"] ?>);
        select_form("postage_type",<?php echo $rules["postage_type"] ?>);
        select_form("selling_status",<?php echo $rules["selling_status"] ?>);
    });
</script>

<div class="books view large-9 medium-8 columns content">
    <p>
        <?= $this->Form->create(null, ['type' => 'get']); ?>

        <?= $this->Form->text('key_words', ['label' => 'キーウード', 'id' => 'key_words']); ?>
        <?= $this->Form->hidden('form_name', ['value' => 'update_rules_form']); ?>
        <?= $this->Form->hidden('book_id', ['value' => $id]); ?>

        <?= $this->Form->select('category_id', ["39" => "本・雑誌", "337" => "本・雑誌/コミック", "338" => "本・雑誌/雑", "339" => "本・雑誌/文芸・小説", "340" => "本・雑誌/同人誌", "341" => "本・雑誌/ライトノベル", "342" => "本・雑誌/絵本・児童書", "343" => "本・雑誌/ライフスタイル", "344" => "本・雑誌/ビジネス", "345" => "本・雑誌/学術書", "346" => "本・雑誌/学習参考書", "347" => "本・雑誌/資格・検定", "348" => "本・雑誌/写真集", "349" => "本・雑誌/洋書", "350" => "本・雑誌/その他"], ['id' => 'category_id']); ?>
        <?= $this->Form->select('condition_type', ["null" => "すべて", "1" => "新品、未使用", "2" => "未使用に近い", "3" => "目立った傷や汚れなし", "4" => "傷や汚れあり", "5" => "傷や汚れあり", "6" => "全体的に状態が悪い"], ['id' => 'condition_type']); ?>
        <?= $this->Form->select('postage_type', ["null" => "すべて", "1" => "着払い(購入者負担)", "2" => "送料込み(出品者負担)", "99" => "手渡し(送料負担なし) "], ['id' => 'postage_type']); ?>
        <?= $this->Form->select('selling_status', ["null" => "すべて", "0" => "販売中", "1" => "売り切れ"], ['id' => 'selling_status']); ?>
        <?= $this->Form->button(__('SEARCH!')) ?>
        <?= $this->Form->end(); ?>      
    </p>

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
        if (isset($rakuma)) {
            foreach ($rakuma as $value) {
                ?>
                <tr>
                    <td><img width="200px" src=<?php echo $value["book_img"] ?>></td>
                    <td><?php echo $value["book_name"] ?></td>
                    <td><?php echo $value["sale_status"] ?></td>
                    <td><?php echo $value["price"] ?></td>
                    <td><button onClick="location.href = '<?php echo $value["buy_link"] ?>'">購入</button> </td>
                </tr>
                <?php
            }
        } else {
            ?>

            <tr>
                <td>何もありません；
                </td></tr>
        <?php }
        ?>
    </table>
</div>

