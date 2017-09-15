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
    <img src="detailed_page_amaazon.gif">
</div>


<div class="border books-index">
    <table border="1" align="center" cellspacing="0" cellpadding="10" width="800" height="500"  style="border-color: #70ad47">
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
     <img src="detailed_page_mercari.gif">
</div>





<div class="mercari_area">
	<div class="mercari_rules">
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





<div class="border books-index">
	     <table border="1" align="center" cellspacing="0" cellpadding="10" width="800" height="500"  style="border-color: #70ad47">
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
         <img src="detailed_page_fril.gif">
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
	     <table border="1" align="center" cellspacing="0" cellpadding="10" width="800" height="500"  style="border-color: #70ad47">
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
         <img src="detailed_page_rakua.gif">
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
	     <table border="1" align="center" cellspacing="0" cellpadding="10" width="800" height="500"  style="border-color: #70ad47">
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
