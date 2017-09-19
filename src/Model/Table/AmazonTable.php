<?php
namespace App\Model\Table;
use Cake\ORM\TableRegistry;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Interfaces\BookInfo;


class AmazonTable extends Table implements BookInfo
{

	public function get_books(int $book_id){

		$book_model = TableRegistry::get('books');

    $books = $book_model->get($book_id);



		$html = new \simple_html_dom();
		if(!isset($book_id)){
			return  "url有误";
		}
		$html->load_file('https://www.amazon.co.jp/gp/offer-listing/'.$books['book_asin']);
		// $commodity = array(
		// 	array(
		// 		'price'        =>  array(),
		//  	'quality'      =>  array(),
		//  	'manufacturer' =>  array(),
		//  	'Distribution' =>  array()
		// 	)
		// );
		$es = $html->find('span[class="aok-offscreen"]');
		$aaa=array();
		foreach ($es as $value) {
			$aaa[]=$value->plaintext;
		}
		//会获得比实际多2个
        $page = array_count_values($aaa);
		//判断是否页面是否大于3张
		if(!isset($page['ページ '])){
			if(($page['ページ ']-2)>=3){
				$print_page=3;
			}else{
				//小于3张网页时候，赋值3张
				$print_page=$page['ページ ']-2;
			}
		}else{
			$print_page=$page['ページ ']=1;
		}

		//初始化变量
		$a1=0;
		$a2=0;
		$a3=0;
		$a4=0;
		$url_a=1;
		$url_b=10;
		for($i=0;$i<$print_page;$i++){
			$es = $html->find('https://www.amazon.co.jp/gp/offer-listing/'.$books['book_asin'].'/ref=olp_page_'.$url_a*$i.'?ie=UTF8&startIndex='.$url_b*$i);
			//定位到表格位子
			// $es = $html->find('div[class="a-row a-spacing-mini olpOffer"]');

			//定位到价格运费数据
			$es = $html->find('div[class="a-column a-span2 olpPriceColumn"]');
			//获取价格和运费
			foreach ($es as $value) {
				$commodity[$a1++]['price']=$value->plaintext;
			}

			//定位到商品介绍
			$es = $html->find('div[class="a-column a-span3 olpConditionColumn"]');
			//获取商品的介绍
			foreach ($es as $value) {
				$temporary=$value->plaintext;
				if(strstr($temporary,"短く表示")){
					//暂时还没有能力删除掉«，原因还不明
					$commodity[$a2++]['quality']=strstr($temporary,"短く表示",true);
				}else{
					//没有找到的时候给赋原来的值
					$commodity[$a2++]['quality']=$value->plaintext;
				}
			}

			//定位到制造商
			$es = $html->find('div[class="a-column a-span2 olpSellerColumn"]');
			foreach ($es as $value) {
				$commodity[$a3++]['manufacturer']=$value->plaintext;
			}

			//获取制造商信息
			$es = $html->find('div[class="a-column a-span3 olpDeliveryColumn"]');

			foreach ($es as $value) {
				$commodity[$a4++]['Distribution']=$value->plaintext;

			}

		}

		return $commodity;
	}

}
