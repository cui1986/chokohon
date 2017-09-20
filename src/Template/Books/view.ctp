<?php  ?>

<div class="book_info">
<div class="book_info_basic">
    <div class="divcss6">
      <?php echo $this->Html->image("detailed_page_2.gif");?>
    </div>
    <div class="syomei">書名:<?php echo $book['book_name'];?></div>
    <div class="ISBN">ISBN:<?php echo $book['book_isbn'];?></div>
    <div class="ASIN">ASIN:<?php echo $book['book_asin'];?></div>
    <div class="komento">コメント:<?php echo $book['book_comment'];?></div>
</div>
<div class="amazon">
    <?php echo $this->Html->image("detailed_page_amaazon.gif");?>
</div>


<div class="border books-index">

<a href='<?php echo $result['url'] ?>'　target="_blank">購入ページへ</a>

    <table border="1" align="center" cellspacing="0" cellpadding="10" width="800" style="border-color: #70ad47">
        <thead>
            <tr>
                <th>配送料/価格</th>
                <th>コンディション</th>
                <th>販売/出品</th>
                <th>配送</th>
            </tr>
    	</thead>

    	<tbody>
    	<?php
			for($i=0;$i<sizeof($result);$i++){
				if($i%2==0){  ?>
					<tr class="tr-odd">
				<?php
				}else{
				?>
					<tr>
				<?php
				}
        if(isset($result['data'][$i])){
				  foreach($result['data'][$i] as $moo){
  					echo "<td>";
  					echo $moo;
  					echo "</td>";
  				}
  				echo "</tr>";
        }
			}?>
    	</tbody>
    </table>

</div>

<div class="amazon">
     <?php echo $this->Html->image("detailed_page_mercari.gif");?>
</div>





<div class="mercari_area">
	<div class="mercari_rules">
      <?= $this->Form->create($searchmerukariform,['type' => 'get']);?>
      		<!-- <span>キーワードを追加する</span>
      		<input type="input" name="key_words"><input type="submit" value="検索">
      		<div>
        		<select name="category_id">
        			<option value="">すべて</option>
              <option value=668>文学/小説</option>
              <option value=669>人文/社会</option>
              <option value=670>ノンフィクション/教養</option>
              <option value=671>地図/旅行ガイド</option>
              <option value=672>ビジネス/経済</option>
              <option value=673>健康/医学</option>
              <option value=674>コンピュータ/IT</option>
              <option value=675>趣味/スポーツ/実用</option>
              <option value=676>住まい/暮らし/子育て</option>
              <option value=677>アート/エンタメ</option>
              <option value=678>洋書</option>
              <option value=1124>参考書</option>
              <option value=679>その他</option>
        		</select>
      			<select id="jyotai" name="book_status">
      			  <option value="">すべて</option>
              <option value=1>新品、未使用</option>
              <option value=2>未使用に近い</option>
              <option value=3>目立った傷や汚れなし</option>
              <option value=4>やや傷や汚れあり</option>
              <option value=5>傷や汚れあり</option>
              <option value=6>全体的に状態が悪い</option>
      		  </select>

        	  <select id="haisosya" name="delivery_id">
        			<option value="">すべて</option>
              <option value=1>着払い(購入者負担)</option>
              <option value=2>送料込み(出品者負担)</option>
        		</select>

      	    <select id="qqq" name="sale_status">
      			  <option value="">すべて</option>
              <option value=1>販売中</option>
              <option value=2>売り切れ</option>
      		  </select>
          </div> -->
      <?php
          echo $this->Form->hidden('form_name',['value' => 'searchform_name']);
          echo $this->Form->control('merukari_key_words',['label' => 'キーワードを追加する']);
          echo $this->Form->select('merukari_category_id',[
                            '種類' => ['' => 'すべて' ,668 => '文学/小説',669 => '人文/社会',670 => 'ノンフィクション/教養',671 => '地図/旅行ガイド',
                            672 => 'ビジネス/経済',673 => '健康/医学',674 => 'コンピュータ/IT',675 => '趣味/スポーツ/実用',
                            676 => '住まい/暮らし/子育て',677 => 'アート/エンタメ',678 => '洋書',1124 => '参考書',679 => 'その他']
                          ]);
          echo $this->Form->select('merukari_book_status',[
                            '商品の状態' => ['' => 'すべて',1 => '新品、未使用',2 => '未使用に近い',3 => '目立った傷や汚れなし',
                            4 => 'やや傷や汚れあり',5 => '傷や汚れあり',6 => '全体的に状態が悪い']
                          ]);
          echo $this->Form->select('merukari_delivery_id',[
                            '配送料の負担' => ['' => 'すべて',1 => '着払い(購入者負担)',2 =>'送料込み(出品者負担)']
                          ]);
          echo $this->Form->select('sale_status',[
                            '販売状況' => ['' => 'すべて','販売中' => '販売中','売り切れ' => '売り切れ']
                          ]);
      ?>
      <?= $this->Form->submit('検索') ?>
      <?= $this->Form->end() ?>
	</div>
</div>





<div class="border books-index">
	     <table border="1" align="center" cellspacing="0" cellpadding="10" width="800" style="border-color: #70ad47">
	             <thead>
	                 <tr>
	                     <th>商品画像</th>
	                     <th>商品名</th>
	                     <th>販売状況</th>
	                     <th>価格</th>
	                     <th>購入</th>

	                </tr>
	             </thead>

	             <tbody>
                <?php $i=0; ?>
                <?php foreach ($merukari as $value): ?>
                  <tr <?= ($i%2 != 1)?'class="tr-odd"':'' ?>>
                <?php $i++; ?>
					          <td><img src="<?php echo $value["book_img"] ?>"></td>
					          <td><?php echo $value["book_name"] ?></td>
				            <td><?php echo $value["sale_status"] ?></td>
				            <td><?php echo $value["price"] ?></td>
				            <td><button onClick="location.href='<?php echo $value["buy_link"] ?>'">購入</button></td>
				        </tr>
              <?php endforeach ?>
	         </tbody>
	     </table>

</div>



<div class="book_info">
<div class="amazon">

    <?php echo $this->Html->image("detailed_page_fril.gif");?>
</div>
<div class="fril_area">
	<div class="fril_rules">
    <?= $this->Form->create($searchFuriruForm,['type' => 'get'])?>
      <?php
          echo $this->Form->hidden('form_name',['value' => 'search_furiru_form']);

          //キーワード
          echo $this->Form->control('fril_key_words',['label' => "キーワードを追加する"]);
          //カテゴリ
          echo $this->Form->select('fril_category_id',[
                            '種類' => [733 => 'すべて' ,734 => '文学/小説',735 => '人文/社会',736 => 'ノンフィクション/教養',737 => '地図/旅行ガイド',
                            738 => 'ビジネス/経済',739 => '健康/医学',740 => 'コンピュータ/IT',741 => '趣味/スポーツ/実用',742 => '住まい/暮らし/子育て',
                            743 => 'アート/エンタメ',744 => '洋書',745=>'その他',1663 =>'絵本/児童書',1664=> '参考書',1665 => '資格/検定']
                          ]);
          //商品状態
          echo $this->Form->select('fril_book_status',[
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
      <?= $this->Form->submit('検索') ?>
      <?= $this->Form->end() ?>
		</div>
	</div>
	</div>



<div class="border books-index">
	     <table border="1" align="center" cellspacing="0" cellpadding="10" width="800" style="border-color: #70ad47">
	             <thead>
	                 <tr>
	                     <th>商品画像</th>
	                     <th>商品名</th>
	                     <th>販売状況</th>
	                     <th>価格</th>
	                     <th>購入</th>

	                </tr>
	             </thead>

	             <tbody>
					        <!-- <tr class="tr-odd">
					            <td></td>
					            <td></td>
				            	<td></td>
				            	<td></td>



				            <td><button type="button">購入</button></td>
				        </tr> -->
                <?php
                // $furiru = new FuriruTable();
                // $furiru = $furiru->get_books($id);
                foreach ($furiru as $value) {
                ?>
                  <tr class="tr-odd">
                    <td><img src="<?php echo $value["book_image"] ?>"></td>
                    <td><?php echo $value["book_name"] ?></td>
                    <td><?php echo $value["transaction"] ?></td>
                    <td><?php echo $value["book_price"] ?></td>
                    <td><input type="button" value="購入" onClick="location.href='<?php echo $value["book_link"] ?>'"></button></td>
                  </tr>
                <?php } ?>
	         </tbody>
	     </table>

</div>

  <!-- <script>
      $(document).ready(function () {
          $("#key_words").val("<?php echo $rakuma_rule["key_words"] ?>");
          function select_form(formId, optionValue) {
              $("#" + formId).find("option[value='" + optionValue + "']").attr("selected", true);
          }
          select_form("category_id",<?php echo $rakuma_rule["category_id"] ?>);
          select_form("condition_type",<?php echo $rakuma_rule["condition_type"] ?>);
          select_form("postage_type",<?php echo $rakuma_rule["postage_type"] ?>);
          select_form("selling_status",<?php echo $rakuma_rule["selling_status"] ?>);

          $("#book_list").find("tr:even").addClass("tr-odd");
      });
  </script> -->
  <div class="book_info">
    <div class="amazon">
       <?= $this->Html->image('detailed_page_rakua.gif', ['alt' => 'らくま']);  ?>
    </div>
    <div class="rakuma_area">
      <div class="rakuma_rules" id="rakuma_rules">

          <?= $this->Form->create(null, ['type' => 'get']); ?>
          <div class="rakuma_rules">
                <?= $this->Form->text('key_words', ['label' => 'キーウード', 'id' => 'key_words']); ?>
                <?= $this->Form->button(__('検索')) ?>
              <div>
                <?= $this->Form->hidden('form_name', ['value' => 'update_rakuma_rules_form']); ?>
                <?= $this->Form->hidden('book_id', ['value' => $id]); ?>
                <?= $this->Form->select('category_id', ["39" => "カテゴリ", "337" => "本・雑誌/コミック", "338" => "本・雑誌/雑", "339" => "本・雑誌/文芸・小説", "340" => "本・雑誌/同人誌", "341" => "本・雑誌/ライトノベル", "342" => "本・雑誌/絵本・児童書", "343" => "本・雑誌/ライフスタイル", "344" => "本・雑誌/ビジネス", "345" => "本・雑誌/学術書", "346" => "本・雑誌/学習参考書", "347" => "本・雑誌/資格・検定", "348" => "本・雑誌/写真集", "349" => "本・雑誌/洋書", "350" => "本・雑誌/その他"], ['id' => 'category_id']); ?>
                <?= $this->Form->select('condition_type', ["null" => "商品状態", "1" => "新品、未使用", "2" => "未使用に近い", "3" => "目立った傷や汚れなし", "4" => "傷や汚れあり", "5" => "傷や汚れあり", "6" => "全体的に状態が悪い"], ['id' => 'condition_type']); ?>
                <?= $this->Form->select('postage_type', ["null" => "配送の負担", "1" => "着払い(購入者負担)", "2" => "送料込み(出品者負担)", "99" => "手渡し(送料負担なし) "], ['id' => 'postage_type']); ?>
                <?= $this->Form->select('selling_status', ["null" => "販売状況", "0" => "販売中", "1" => "売り切れ"], ['id' => 'selling_status']); ?>
                <?= $this->Form->end(); ?>
              </div>
          </div>
      </div>
    </div>
  </div>


  <div class="border books-index">
      <table id="book_list" border="1" align="center" cellspacing="0" cellpadding="10" width="800" style="border-color: #70ad47">
          <thead>
              <tr>
                  <th>商品画像</th>
                  <th>商品名</th>
                  <th>販売状況</th>
                  <th>価格</th>
                  <th>購入</th>

              </tr>
          </thead>

          <tbody>

              <?php
              if (isset($rakuma)) {
                  foreach ($rakuma as $value) {
                      ?>
                      <tr>
                          <td><img width="100px" src=<?php echo $value["book_img"] ?>></td>
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
                      <td colspan="5">何もありません；</td>
                    </tr>
              <?php }
              ?>
          </tbody>
      </table>

  </div>
</div>
