<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Interfaces\BookInfo;
use Cake\ORM\TableRegistry;

class MerukariTable extends Table implements BookInfo
{

  public function initialize(array $config)
  {
    parent::initialize($config);
    $this->setTable('merukari_rules');

    $this->hasOne('Books', [
      'foreignKey' => 'book_id',
      'joinType' => 'INNER'
    ]);
  }
  function get_books(int $book_id){

    $book_rules = TableRegistry::get('merukari_rules');

    $rule = $book_rules->get(['book_id' => $book_id]);
    $data_array = array();

    //取检索条件
    $key_words = $rule["key_words"];
    $category_id = $rule["category_id"];
    $book_status = $rule["book_status"];
    $delivery_id = $rule["delivery_id"];
    $on_sale = $rule["on_sale"];
    $sold_out = $rule["sold_out"];

    //解析url
    $url =  "https://www.mercari.com/jp/search/?sort_order=&keyword={$key_words}&category_root=5&category_child=72&category_grand_child[{$category_id}]=1&brand_name=&brand_id=&size_group=&price_min=&price_max=&item_condition_id[{$book_status}]=1&shipping_payer_id[{$delivery_id}]=1&status_on_sale={$on_sale}&status_trading_sold_out={$sold_out}";

    $html = file_get_html($url);

    $result_null = $html->find(".search-result-description");
    if(count($result_null) > 0){
        return $data_array;
    }else {
        $results = $html->find( '.items-box' );

        foreach ($results as $result) {
            $temp_array = array();

            $img_src_name = "data-src";
            //购买网址
            $temp_array['buy_link'] = $result->children[0]->href;
            //图像url
            $temp_array['book_img'] =  $result->children[0]->children[0]->children[0]->$img_src_name;
            //贩卖情况
            if(isset($result->children[0]->children[0]->children[1]->children[0])){
              $temp_array['sale_status'] = "売り切れ";
            }else {
              $temp_array['sale_status'] = "販売中";
            }
            //书名
            $temp_array['book_name'] =  $result->children[0]->children[1]->children[0]->plaintext;
            //价格
            $temp_array['price'] = $result->children[0]->children[1]->children[1]->children[0]->plaintext;

            $data_array[] = $temp_array;
        }

        $html->clear();

        return $data_array;
    }

    $result_null->clear();
  }
}
?>
