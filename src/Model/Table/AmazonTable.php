<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Interfaces\BookInfo;

include_once 'simple_html_dom.php';

class AmazonTable extends Table implements BookInfo
{
	public function get_books(int $book_id){
		$html = new simple_html_dom();
		if(!isset($book_id)){
			return  "url有误";
		}
		$html->load_file('https://www.amazon.co.jp/gp/offer-listing/'.$book_id);
		// $commodity = array(
		// 	array(
		// 		'price'        =>  array(),
		//  		'quality'      =>  array(),
		//  		'manufacturer' =>  array(),
		//  		'Distribution' =>  array()
		// 	)
		// );

		//定位到表格位子
		$es = $html->find('div[class="a-row a-spacing-mini olpOffer"]');

		//定位到价格运费数据
		$es = $html->find('div[class="a-column a-span2 olpPriceColumn"]');
		$a=0;
			//获取价格和运费
		foreach ($es as $value) {
			$commodity[$a++]['price']=$value->plaintext;
		}

		//定位到商品介绍
		$es = $html->find('div[class="a-column a-span3 olpConditionColumn"]');
		$a=0;
		//获取商品的介绍
		foreach ($es as $value) {
			$commodity[$a++]['quality']=$value->plaintext;
		}

		//定位到制造商
		$es = $html->find('div[class="a-column a-span2 olpSellerColumn"]');
		$a=0;
		//获取制造商信息
		foreach ($es as $value) {
			$commodity[$a++]['manufacturer']=$value->plaintext;
		}

		//定位运输花费时间
		$es = $html->find('div[class="a-column a-span3 olpDeliveryColumn"]');
		$a=0;
		//获取运输花费时间
		foreach ($es as $value) {
			$commodity[$a++]['Distribution']=$value->plaintext;

		}

		return $commodity;
	}
}

?>
