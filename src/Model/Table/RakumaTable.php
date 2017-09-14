<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Interfaces\BookInfo;

<<<<<<< HEAD

class RakumaTable extends Table implements BookInfo
{


  //输出数据
  function get_books(int $book_id){
  }

  public function initialize(array $config)
  {

    parent::initialize($config);
    $this->setTable('rakuma_rules');

    $this->hasOne('Books', [
        'foreignKey' => 'id',
        'joinType' => 'INNER'
    ]);
  }
=======
class RakumaTable extends Table implements BookInfo {


    function get_books(int $book_id) {
        //最后修改时间2017年9月11日17
        //BY 周

        function getRakumaUrl($keyWord = NULL, $categoryId = NULL, $conditionType = NULL, $postageType = NULL, $sellingStatus = NULL) {
            if ($keyWord == NULL) {
                return NULL;
            } else {
                $query = "keyword=" . $keyWord;
            }
            $query = ($categoryId == NULL) ? $query : $query . "&category_id=" . $categoryId;
            $query = ($conditionType == NULL) ? $query : $query . "&condition_type=" . $conditionType;
            $query = ($postageType == NULL) ? $query : $query . "&postage_type=" . $conditionType;
            $query = ($sellingStatus == NULL) ? $query : $query . "&selling_status=" . $sellingStatus;
            $resultQuery = "https://api.rakuma.rakuten.co.jp/search-api/rest/product/search?" . $query;
            return $resultQuery;
        }

        //构建网址
        //https://api.rakuma.rakuten.co.jp/search-api/rest/product/search?keyword=aaa&category_id=39&condition_type=2&postage_type=2&selling_status=0
        //https://api.rakuma.rakuten.co.jp/search-api/rest/product/search?keyword=aaa&category_id=39&condition_type=2&postage_type=2&selling_status=0
        //$url = "https://api.rakuma.rakuten.co.jp/search-api/rest/product/search?keyword=JAVA&category_id=39";
        //$url = "https://api.rakuma.rakuten.co.jp/search-api/rest/product/search?keyword=bbbbbbbbbbbbbbb";
        //$url = "https://www.yahoo.co.jp";
        //上面是几个典型例子。
        //$url = getRakumaUrl("my%20love", "", "", "", "");
        //$url = getRakumaUrl("aaa", "39", "2", "2", "0");
        $url = getRakumaUrl("JAVA", "39", "", "", "");

        //调用方法


        function bookCurl($targetURI) {
            if ($targetURI == NULL) {
                return NULL;
            }
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $targetURI); //搜索的地址
            $user_agent = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36";
            curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $str = curl_exec($curl);
            curl_close($curl);
            return $str;
        }

        $books = bookCurl($url);



        $booksArray = json_decode($books, true);
        var_dump($booksArray);
        $bookslist["count"] = $booksArray["count"];

        //获取数据

        function rakumaBooksList($booksArray) {
            if ($booksArray == NULL) {
                return NULL;
            }
            if (($booksArray["count"]) !== 0) {
                foreach ($booksArray["productList"] as $key => $value) {

                    $fristArray = $key;
                    foreach ($booksArray["productList"][$fristArray] as $key => $value) {
                        $bookslist[$fristArray]["book_name"] = $booksArray["productList"][$fristArray]["name"];
                        $bookslist[$fristArray]["price"] = $booksArray["productList"][$fristArray]["price"];
                        $bookslist[$fristArray]["sale_status"] = ($booksArray["productList"][$fristArray]["status"] === 1) ? "SOLD OUT" : "ON SOLD";
                        $bookslist[$fristArray]["buy_link"] = "https://rakuma.rakuten.co.jp/item/" . $booksArray["productList"][$fristArray]["id"];
                        $bookslist[$fristArray]["book_img"] = "https://rakuma.r10s.jp/d/strg/ctrl/25/" . $booksArray["productList"][$fristArray]["image"];
                    }
                }
            } else {
                $bookslist[0]["book_name"] = NULL;
                $bookslist[0]["price"] = NULL;
                $bookslist[0]["sale_status"] = NULL;
                $bookslist[0]["buy_link"] = NULL;
                $bookslist[0]["book_img"] = NULL;
                return $bookslist;
            }
            return $bookslist;
        }

        return rakumaBooksList($booksArray);

    }

    //输出数据
    function get_books(int $book_id) {

        return $booksArray;
    }

    public function initialize(array $config) {

        parent::initialize($config);
        $this->setTable('rakuma_rules');

        $this->hasOne('Books', [
            'foreignKey' => 'id',
            'joinType' => 'INNER'
        ]);
    }
>>>>>>> 0017979e2cad01987fbcea0ecb96e1ffb6010073

}

?>
