<?php

//本页全部

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Interfaces\BookInfo;
use Cake\ORM\TableRegistry;

class RakumaTable extends Table implements BookInfo {

    private function makeUrl($URI, array $keyWord, array $queryKey) {
        if ($URI == NULL || $keyWord == NULL) {
            return NULL;
        }
        foreach ($keyWord as $key => $value) {
            $query = "$URI?" . $key . "=" . $value;
            if ($value == "" || $value == NULL) {
                return NULL;
                break;
            }
        }
        foreach ($queryKey as $key => $value) {
            $query = ($value == NULL || $value == "") ? $query : $query . "&$key=" . $value;
        }
//        $test_rul="https://rakuma.rakuten.co.jp/search/?keyword=".$query;
//        var_dump($query);
        return $query;
        
    }

    private function bookCurl($targetURI) {
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

    private function rakumaBooksList($booksArray) {
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
            $bookslist = NULL;
            return $bookslist;
        }
        return $bookslist;
    }

    function get_books(int $book_id) {

        $rules = TableRegistry::get('RakumaRules');
        $bookRule = $rules->find('all')->where(['book_id' => $book_id])->first();


        $url = $this->makeUrl("https://api.rakuma.rakuten.co.jp/search-api/rest/product/search", ["key_words" => $bookRule['key_words']], ["keyword" => $bookRule['key_words']], ["category_id" => $bookRule['category_id'], "condition_type" => $bookRule['condition_type'], "postage_type" => $bookRule['postage_type'], "selling_status" => $bookRule['selling_status']]);
//构建网址
//        var_dump($url);
        
        $books = $this->bookCurl($url);
//        var_dump($books);
//获取数据
        if ($books == NULL) {
            return NULL;
        }
//如果在这里发现为空，立即返回
        $booksArray = json_decode($books, true);

        $bookslist["count"] = $booksArray["count"];

//获取数据
        return $this->rakumaBooksList($booksArray);
//最终输出数据
    }

    public function initialize(array $config) {

        parent::initialize($config);
        $this->setTable('rakuma_rules');

        $this->hasOne('Books', [
            'foreignKey' => 'id',
            'joinType' => 'INNER'
        ]);
    }
    public function queryFilter($str) {
        //尝试过滤关键元素
        $str = strip_tags($str);
        $str = trim($str);
        return $str;
    }
}
