<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Interfaces\BookInfo;
use Cake\ORM\TableRegistry;
use Cake\Http\Client;



class FuriruTable extends Table implements BookInfo
{
    public function initialize(array $config)
    {

      parent::initialize($config);
      $this->setTable('fril_rules');

      $this->hasOne('Books', [
          'foreignKey' => 'id',
          'joinType' => 'INNER'
      ]);
    }



    function get_books(int $book_id){

      $book_model = TableRegistry::get('fril_rules');
      $books = $book_model->find("all",
      [
        "conditions" => [
          "book_id" => $book_id
        ]
      ])->first();

      $key_words = $books["key_words"];
      $category_id = $books["category_id"];
      $book_status = $books["book_status"];
      $delivery_id = $books["delivery_id"];
      $transaction = $books["transaction"];

      $url = "https://fril.jp/s?query=".$key_words."&"."category_id=".$category_id.'&'."status=".$book_status."&transaction=".$transaction.'&'."carriage=".$delivery_id;
      var_dump($url);
      $data_array = array();
      if($this->chkurl($url)==false){
        return $data_array;
      }
      $html = file_get_html($url);

      $result_null = $html->find(".nohit");

      if(count($result_null) > 0){
       return $data_array;
      }else {
       $results = $html->find('.item');

        foreach ($results as $result) {
          $temp_array = array();
          $img_src_name = "data-original";
          $temp_array['book_link'] = $result->children[0]->children[0]->children[0]->href;
          $temp_array['book_image'] =  $result->children[0]->children[0]->children[0]->children[1]->$img_src_name;
          $temp_array['book_name'] =  $result->children[0]->children[1]->children[1]->children[0]->children[0]->plaintext;
          // var_dump($result->children[0]->children[0]->children[0]->children[1]);exit();
          if(isset($result->children[0]->children[0]->children[0]->children[1])){
            $temp_array['book_status'] = $result->children[0]->children[0]->children[0]->children[1]->plaintext;
          } else {
            $temp_array['book_status'] = "";
          }
          $temp_array['book_price'] = $result->children[0]->children[1]->children[2]->children[0]->children[1]->plaintext;
          if(isset($result->children[0]->children[0]->children[0]->children[2])){
          $temp_array['transaction'] =  $result->children[0]->children[0]->children[0]->children[2]->plaintext;
          } else  {
            $temp_array['transaction'] =  $result->children[0]->children[0]->children[0]->children[1]->plaintext;
          }
          $data_array[] = $temp_array;
        }

        $html->clear();
        return $data_array;
      }
  }
    function chkurl($url){
    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 10);
    curl_exec($handle);

    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    if($httpCode == 404) {
      return false;
    }else{
      return true;
    }
      curl_close($handle);
    }
}
?>
