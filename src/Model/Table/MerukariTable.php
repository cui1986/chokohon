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
        'foreignKey' => 'id',
        'joinType' => 'INNER'
    ]);
  }

  function get_books(int $book_id){
    $data_array = array();
    $page_number = 1;
    $keyword = "cakephp";
    $url =  "https://www.mercari.com/jp/search/?sort_order=&keyword=cakephp&category_root=5&category_child=72&category_grand_child%5B668%5D=1&category_grand_child%5B669%5D=1&category_grand_child%5B670%5D=1&category_grand_child%5B671%5D=1&category_grand_child%5B672%5D=1&category_grand_child%5B673%5D=1&category_grand_child%5B674%5D=1&category_grand_child%5B675%5D=1&category_grand_child%5B676%5D=1&category_grand_child%5B677%5D=1&category_grand_child%5B678%5D=1&category_grand_child%5B1124%5D=1&category_grand_child%5B679%5D=1&brand_name=&brand_id=&size_group=&price_min=&price_max=&condition_all=1&item_condition_id%5B1%5D=1&item_condition_id%5B2%5D=1&item_condition_id%5B3%5D=1&item_condition_id%5B4%5D=1&item_condition_id%5B5%5D=1&item_condition_id%5B6%5D=1&shipping_payer_all=1&shipping_payer_id%5B1%5D=1&shipping_payer_id%5B2%5D=1&status_all=1&status_on_sale=1&status_trading_sold_out=1";

    $html = file_get_html( $url );

    $results = $html->find( '.items-box' );


    foreach ($results as $result) {
        $temp_array = array();

        $img_src_name = "data-src";
        $temp_array['buy_link'] = $result->children[0]->href;
        $temp_array['book_img'] =  $result->children[0]->children[0]->children[0]->$img_src_name;
        if(isset($result->children[0]->children[0]->children[1]->children[0])){
            $temp_array['sale_status'] = $result->children[0]->children[0]->children[1]->children[0]->plaintext;
        }else {
          $temp_array['sale_status'] = "";
        }
        $temp_array['book_name'] =  $result->children[0]->children[1]->children[0]->plaintext;
        $temp_array['price'] = $result->children[0]->children[1]->children[1]->children[0]->plaintext;

        $data_array[] = $temp_array;
    }

    $html->clear();



    return $data_array;
  }
}
?>
