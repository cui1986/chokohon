<?php

namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Date;
use App\Form\SearchFuriruForm;
use App\Form\SearchMerukariForm;
use App\Form\SearchRakumaForm;
use App\Model\Table\MerukariTable;
use Cake\ORM\TableRegistry;
use App\Model\Table\RakumaTable;
use App\Model\Table\FuriruTable;

class BooksController extends AppController
{

    public function index() {
        $this->loadModel('Books');

        $books = $this->paginate($this->Books);

        $this->set(compact('books'));
        $this->set('_serialize', ['books']);
    }

    public function view($id = null)
    {
      $this->loadModel("Books");
      $book = $this->Books->get($id);
      /* amazon start */
      $amazon_model =$this->LoadModel("Amazon");
      $result = $amazon_model->get_books($id);
      $this->set(compact('result'));
      /* amazon end */

      /* merukari start*/
      $searchmerukariform = new SearchMerukariForm();

      $merukari_rules = TableRegistry::get('merukari_rules');

      $merukari_rule = $merukari_rules->find('all', [
        'conditions' => ['book_id' => $id , ["del_flg" => 0]]
      ])->first();

      if($this->request->is('get') && (($this->request->getQuery('form_name')) == 'searchform_name')){

          $merukari_rule['key_words'] = $this->request->getQuery('merukari_key_words');
          $merukari_rule['category_id'] = $this->request->getQuery('merukari_category_id');
          $merukari_rule['book_status'] = $this->request->getQuery('merukari_book_status');
          $merukari_rule['delivery_id'] = $this->request->getQuery('merukari_delivery_id');


          if ($this->request->getQuery('sale_status') == '販売中') {
              $merukari_rule['on_sale'] = 1;
              $merukari_rule['sold_out'] = '';
          }elseif ($this->request->getQuery('sale_status') == '売り切れ'){
              $merukari_rule['on_sale'] = '';
              $merukari_rule['sold_out'] = 1;
          }else {
              $merukari_rule['on_sale'] = 1;
              $merukari_rule['sold_out'] = 1;
          }
          $merukari_rule['sale_status'] = $this->request->getQuery('sale_status');
          $merukari_rules->save($merukari_rule);
    }

      $this->request->data('merukari_key_words',$merukari_rule["key_words"]);
      $this->request->data('merukari_category_id',$merukari_rule["category_id"]);
      $this->request->data('merukari_book_status',$merukari_rule["book_status"]);
      $this->request->data('merukari_delivery_id',$merukari_rule["delivery_id"]);
      $this->request->data('sale_status',$merukari_rule["sale_status"]);

      $this->loadModel('Merukari');
      $merukari = new MerukariTable();
      $merukari = $merukari->get_books($id);

      $this->set(compact('merukari'));
      $this->set(compact('searchmerukariform'));

      /* merukari end */

      /* rakuma start */
        $rakuma = new RakumaTable;
        $rakuma_rules = TableRegistry::get('RakumaRules');
        $rakuma_queryData = $this->request->getQuery();
        $id = isset($id) ? $id : $id = $rakuma_queryData["book_id"];     //防止ID丢失，获取BOOK_ID值；
        if (!isset($rakuma_queryData["key_words"]) || $rakuma_queryData["key_words"] == null || $rakuma_queryData["key_words"] == "") {
            $this->Flash->error(__('検索キーワードを入力してください'));
        } else {
            $rakuma_queryData["key_words"] = $rakuma->queryFilter($rakuma_queryData["key_words"]); //过滤关键词
        }
        $rakuma_rule = $rakuma_rules->find('all', [
                    'conditions' => ['book_id' => $id, ["del_flg" => 0]],
                ])->first();
        if (isset($rakuma_queryData["form_name"]) && $rakuma_queryData["form_name"] == "update_rakuma_rules_form") {    //存入数据库
            $rakuma_rule = $rakuma_rules->patchEntity($rakuma_rule, $rakuma_queryData);
            if ($rakuma_rules->save($rakuma_rule)) {
                $this->Flash->success(__('検索条件が更新されました'));
            } else {
                $this->Flash->error(__('システムエラー、保存できません'));
            }
        }

        if (isset($id)) {
            $rakuma = $rakuma->get_books($id);
        }
        $this->request->data('key_words', $rakuma_rule["key_words"]);
        $this->request->data('category_id', $rakuma_rule["category_id"]);
        $this->request->data('condition_type', $rakuma_rule["condition_type"]);
        $this->request->data('postage_type', $rakuma_rule["postage_type"]);
        $this->request->data('selling_status', $rakuma_rule["selling_status"]);
        $this->set(compact('rakuma_rule'));
        $this->set(compact('rakuma'));
      /* rakuma end */

      /* furiru start */

      $searchFuriruForm = new SearchFuriruForm();
      $furiru_rules = TableRegistry::get('fril_rules');
      $furiru_rule = $furiru_rules->find('all', [
        'conditions' => ['book_id' => $id,["del_flg" => 0]],
      ])->first();
      // $furiru_queryData = $this->request->getQuery();
      // $id = isset($id) ? $id : $id = $furiru_queryData["id"];
      if($this->request->getQuery('form_name') && $this->request->getQuery('form_name') == "search_furiru_form") {
        $searchFuriruForm->execute($this->request->getQueryParams());
        //入力した内容の値を設定する
        $conditions = array();

        $furiru_rule['key_words'] = $this->request->getQuery('fril_key_words');
        $furiru_rule['category_id'] = $this->request->getQuery('fril_category_id');
        $furiru_rule['book_status'] = $this->request->getQuery('fril_book_status');
        $furiru_rule['delivery_id'] = $this->request->getQuery('carriage');
        $furiru_rule['transaction'] = $this->request->getQuery('transaction');



        if ($furiru_rules->save($furiru_rule)) {
          $this->Flash->success(__('検索条件が更新されました'));
        } else {
          $this->Flash->error(__('検索条件を保存できませんでした。'));
        }
      }

      $this->request->data('fril_key_words',$furiru_rule["key_words"]);
      $this->request->data('fril_category_id',$furiru_rule["category_id"]);
      $this->request->data('fril_book_status',$furiru_rule["book_status"]);
      $this->request->data('carriage',$furiru_rule["delivery_id"]);
      $this->request->data('transaction',$furiru_rule["transaction"]);

      if (isset($id)) {
          //フリルテーブルのインスタンスを生成する
          $furiru = new FuriruTable;
          //FuriruTableの中のget_booksのファンクションを使用し、id=1のデータを転送させる
          $furiru = $furiru->get_books($id);
      }
      $this->set(compact('searchFuriruForm'));
      $this->set(compact('furiru'));
      /* furiru end */

      $this->set(compact('id'));
      $this->set(compact('book'));
    }

    public function add() {
        $this->loadModel('Books');
        $this->loadModel('Furiru');
        $this->loadModel('Merukari');
        $this->loadModel('Rakuma');

        $book = $this->Books->newEntity();
        $furiru = $this->Furiru->newEntity();
        $merukari = $this->Merukari->newEntity();
        $rakuma = $this->Rakuma->newEntity();


        if ($this->request->is('post')) {
            $book = $this->Books->patchEntity($book, $this->request->getData());

            $furiru->key_words = $this->request->getData("book_name");
            $merukari->key_words = $this->request->getData("book_name");
            $rakuma->key_words = $this->request->getData("book_name");

        $book->del_flg = 0;
        $book->furiru = $furiru;
        $book->merukari = $merukari;
        $book->rakuma = $rakuma;


            if ($this->Books->save($book)) {

                $this->Flash->success(__('登録は成功しました.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('登録は失敗しました、もう一度試してください.'));
        }
        $this->set(compact('book'));
        $this->set('_serialize', ['book']);
    }


    public function edit($id = null)
    {

      $this->loadModel('Books');
      $this->loadModel('Furiru');
      $this->loadModel('Merukari');
      $this->loadModel('Rakuma');

      //1.先把一本books的所有数据取到
      $book = $this->Books->get($id, [
          'contain' => ['Furiru','Merukari','Rakuma']
      ]);


      //2.如果是post形式
      if ($this->request->is('post')) {
           //如果请求中的bookname等于存在数据库中的bookname，则直接将数据只存在books一张table里
          if(($this->request->getData("book_name")) && ($this->request->getData("book_name") == $book->book_name) ){
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if($this->Books->save($book)){

            $this->Flash->success(__('編集は成功しました.'));
            return $this->redirect(['action' => 'index']);
          }
              $this->Flash->error(__('編集は失敗しました、もう一度試してください.'));
            //如果请求中的bookname等于存在数据库中的bookname，则直接将数据只存在books一张table里
          } else {
             //如果请求中的bookname跟存在数据中的bookname不相同
             //请求中的bookname的值等于keyword
              $book = $this->Books->patchEntity($book, $this->request->getData());
              $book->furiru->key_words = $this->request->getData("book_name");
              $book->merukari->key_words = $this->request->getData("book_name");
              $book->rakuma->key_words = $this->request->getData("book_name");
              $book->book_name = $this->request->getData("book_name");



          if( $this->Books->save($book) &&
              $this->Merukari->save($book->merukari) &&
              $this->Rakuma->save($book->rakuma) &&
              $this->Furiru->save($book->furiru)){

                  $this->Flash->success(__('編集は成功しました.'));

                  return $this->redirect(['action' => 'index']);
          }

                   $this->Flash->error(__('編集は失敗しました、もう一度試してください.'));
                 }
     }

      $this->set(compact('book'));
      $this->set('_serialize', ['book']);

}


    public function delete($id = null) {
        $this->loadModel('Books');
        $this->loadModel('Furiru');
        $this->loadModel('Merukari');
        $this->loadModel('Rakuma');

        // $this->request->allowMethod(['post', 'delete']);

        $book = $this->Books->get($id, [
            'contain' => ['Furiru','Merukari','Rakuma']
        ]);

        $book->furiru->del_flg = 1;
        $book->merukari->del_flg = 1;
        $book->rakuma->del_flg = 1;
        $book->del_flg = 1;

        if( $this->Books->save($book) &&
            $this->Merukari->save($book->merukari) &&
            $this->Rakuma->save($book->rakuma) &&
            $this->Furiru->save($book->furiru)){

                $this->Flash->success(__('削除は成功しました.'));

                return $this->redirect(['action' => 'index']);
        } else {
            $this->Flash->error(__('削除は失敗しました、もう一度試してください.'));
        }
    }
}
