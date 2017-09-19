<?php  ?>

<div class="book_info">
<div class="book_info_basic">
    <div class="divcss6">
        <img src="detailed_page_2.gif">
    </div>
    <div class="syomei">書名:</div>
    <div class="ISBN">ISBN:</div>
    <div class="ASIN">ASIN:</div>
    <div class="komento">コメント:</div>
</div>
<div class="amazon">
    <?php echo $this->Html->image("detailed_page_amaazon.gif");?>
</div>


<div class="border books-index">
    <table border="1" align="center" cellspacing="0" cellpadding="10" width="800" height="100"  style="border-color: #70ad47">
        <thead>
            <tr>
                <th>配送料/価格</th>
                <th>コンディション</th>
                <th>販売/出品</th>
                <th>購入</th>
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
				foreach($result[$i] as $moo){
					echo "<td>";
					echo $moo;
					echo "</td>";
				}
				echo "</tr>";
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
          echo $this->Form->control('key_words',['label' => 'キーワードを追加する']);
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
	</div>
</div>





<div class="border books-index">
	     <table border="1" align="center" cellspacing="0" cellpadding="10" width="800" height="100"  style="border-color: #70ad47">
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
		<span>キーワードを追加する</span>
		<input type="input" name="keyword"><button type="button">検索</button>
		<div>
		<select>
			<option value="bbbb">カテゴリ</option>
		</select>
			<select id="jyotai">
			<option value="bbbb">商品状態</option>
		</select>

	<select id="haisosya">
			<option value="bbbb">配送者の負担</option>
		</select>

	<select id="qqq" >
			<option value="bbbb">販売状況</option>
		</select>




		</div>
	</div>
	</div>
</div>



</div>




<div class="border books-index">
	     <table border="1" align="center" cellspacing="0" cellpadding="10" width="800" height="100"  style="border-color: #70ad47">
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
					        <tr class="tr-odd">
					            <td></td>
					            <td></td>
				            	<td></td>
				            	<td></td>



				            <td><button type="button">購入</button></td>
				        </tr>
				         <tr>
				             <td></td>
				             <td></td>
				             <td></td>
				             <td></td>

				             <td><button type="button">購入</button></td>
				         </tr>
				         <tr class="tr-odd">
				             <td></td>
				             <td></td>
				             <td></td>
				             <td></td>

				             <td><button type="button">購入</button></td>
				         </tr>
				         <tr>
				             <td></td>
				             <td></td>
				             <td></td>
				             <td></td>
				             <td><button type="button">購入</button></td>
				         </tr>
				         <tr class="tr-odd">
				             <td></td>
				             <td></td>
				             <td></td>
				             <td></td>
				             <td><button type="button">購入</button></td>
				         </tr>
	         </tbody>
	     </table>

</div>


<div class="book_info">
<div class="amazon">
         <?php echo $this->Html->image("detailed_page_rakua.gif");?>
         </div>
<div class="rakuma_area">
	<div class="rakuma_rules">
		<span>キーワードを追加する</span>
		<input type="input" name="keyword"><button type="button">検索</button>
		<div>
		<select>
			<option value="bbbb">カテゴリ</option>
		</select>
			<select id="jyotai">
			<option value="bbbb">商品状態</option>
		</select>

	<select id="haisosya">
			<option value="bbbb">配送者の負担</option>
		</select>

	<select id="qqq" >
			<option value="bbbb">販売状況</option>
		</select>




		</div>
	</div>
	</div>
</div>



</div>


<div class="border books-index">
	     <table border="1" align="center" cellspacing="0" cellpadding="10" width="800" height="100"  style="border-color: #70ad47">
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
					        <tr class="tr-odd">
					            <td></td>
					            <td></td>
				            	<td></td>
				            	<td></td>



				            <td><button type="button">購入</button></td>
				        </tr>
				         <tr>
				             <td></td>
				             <td></td>
				             <td></td>
				             <td></td>

				             <td><button type="button">購入</button></td>
				         </tr>
				         <tr class="tr-odd">
				             <td></td>
				             <td></td>
				             <td></td>
				             <td></td>

				             <td><button type="button">購入</button></td>
				         </tr>
				         <tr>
				             <td></td>
				             <td></td>
				             <td></td>
				             <td></td>
				             <td><button type="button">購入</button></td>
				         </tr>
				         <tr class="tr-odd">
				             <td></td>
				             <td></td>
				             <td></td>
				             <td></td>
				             <td><button type="button">購入</button></td>
				         </tr>
	         </tbody>
	     </table>

</div>
