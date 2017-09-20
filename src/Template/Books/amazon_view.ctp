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

	<!-- <div class="amazon">
    	<img src="detailed_page_amaazon.gif">
	</div> -->


	<div class="border books-index">
		<?php if(!isset($result['error'])){ ?>
			<a href=<?php echo $result['url'] ?> target="_blank">購入ページへ</a>  
	
    	<table border="1" align="center" cellspacing="0" cellpadding="10" width="800" height="500"  style="border-color: #70ad47">
        
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
				for($i=0;$i<sizeof($result['data']);$i++){
					if($i%2==0){  ?>
						<tr class="tr-odd">
					<?php }else{ ?>
						<tr>	
					<?php
					}		
				
					foreach($result['data'][$i] as $moo){
					echo "<td>";
					echo $moo;
					echo "</td>";
		
					}
				
				echo "</tr>";
				} ?>
    		</tbody>
    	</table>

	</div>
</div>
<!-- <div class="amazon">
        <img src="detailed_page_mercari.gif"> 
</div> -->

<?php }else{
?>
<table border="2" align="center" cellspacing="0" cellpadding="10" width="500" height="200"  style="border-color: red">
	<tr>
		<td>
			<h1><?php echo($result['error']); }?></h1>
		</td>
	</tr>
</table>
