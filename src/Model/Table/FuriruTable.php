<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Interfaces\BookInfo;


class FuriruTable extends Table implements BookInfo
{
      function get_books(int $book_id){
          $html = file_get_html( 'https://fril.jp/s?category_id=733&status=new' );
          // $html = file_get_html($book_id);

          //aタグ
          $a = $html->find('.link_search_image');
          //書名
          $book_name = $html->find( '.item-box__item-name' );
          //値段
          // $price = $html->find(span['itemprop=price']);
          $price = $html->find('span[itemprop=price]');
          //販売状況
          $sale_status = $html->find('.item-box__soldout_ribbon');

          //画像の保存場所
          $img_src_name = "data-original";

          $arr = array();

          $a1 = 0;
          foreach ($a as  $value){
          if(!empty($sale_status)){
            echo $value->children[1]->$img_src_name."は売り切れました";
          }
             $arr[$a1++]['book_image']=$value->children[1]->$img_src_name;
          }

          $a1 = 0;
          foreach ($book_name as $book_name_value){
            $arr[$a1++]['book_name'] = trim($book_name_value->plaintext);
          //array_push($arr,$book_name_value);
          }

          $a1 = 0;
          foreach($price as $price_value){
            $arr[$a1++]['book_price'] = $price_value->plaintext;
          }

          $a1 = 0;
          foreach ($sale_status as  $sale_status_value){
            $arr[$a1++]['book_status'] = $sale_status_value->plaintext;
          }

          $a1 = 0;
          foreach ($a as  $value){
            $arr[$a1++]['book_link'] = $value->href;
          }

            $html->clear();
            return $arr;

    }




}
?>
