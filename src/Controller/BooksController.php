<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Date;
use App\Form\SearchFuriruForm;
use App\Form\SearchMerukariForm;
use App\Form\SearchRakumaForm;
use App\Model\Table\MerukariTable;
use Cake\ORM\TableRegistry;

class BooksController extends AppController
{

  public function index()
  {
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
    $amazon_model = $this->LoadModel("Amazon");
    $result = $amazon_model->get_books(1);
    /* amazon end */

    /* merukari start*/
    $searchmerukariform = new SearchMerukariForm();

    $book_rules = TableRegistry::get('merukari_rules');

    $rule = $book_rules->get(['book_id' => $id]);

    if($this->request->is('get') && (($this->request->getQuery('form_name')) == 'searchform_name')){

        $rule['key_words'] = $this->request->getQuery('key_words');
        $rule['category_id'] = $this->request->getQuery('category_id');
        $rule['book_status'] = $this->request->getQuery('book_status');
        $rule['delivery_id'] = $this->request->getQuery('delivery_id');


        if ($this->request->getQuery('sale_status') == 1) {
            $rule['on_sale'] = 1;
            $rule['sold_out'] = '';
        }elseif ($this->request->getQuery('sale_status') == 2){
            $rule['on_sale'] = '';
            $rule['sold_out'] = 1;
        }else {
            $rule['on_sale'] = 1;
            $rule['sold_out'] = 1;
        }
        $rule['sale_status'] = $this->request->getQuery('sale_status');
        $book_rules->save($rule);
    }

    $this->request->data('key_words',$rule["key_words"]);
    $this->request->data('category_id',$rule["category_id"]);
    $this->request->data('book_status',$rule["book_status"]);
    $this->request->data('delivery_id',$rule["delivery_id"]);
    $this->request->data('sale_status',$rule["sale_status"]);

    $this->loadModel('Merukari');
    $merukari = new MerukariTable();
    $merukari = $merukari->get_books($id);
    
    /* merukari end */


    $this->set(compact('book'));
    $this->set(compact('merukari'));
    $this->set(compact('searchmerukariform'));
    $this->set(compact('result'));

  }


  public function add()
  {
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
            $this->Books->save($book);

            $this->Flash->success(__('編集は成功しました.'));
            return $this->redirect(['action' => 'index']);

            //如果请求中的bookname等于存在数据库中的bookname，则直接将数据只存在books一张table里
           } else {
             //如果请求中的bookname跟存在数据中的bookname不相同
             //请求中的bookname的值等于keyword

             $book = $this->Books->patchEntity($book, $this->request->getData());

              // $book->furiru->key_words = $this->request->getData("book_name");
              $book->merukari->key_words = $this->request->getData("book_name");
              // $book->rakuma->key_words = $this->request->getData("book_name");

              $book->book_name = $this->request->getData("book_name");


              $this->Books->save($book);
              $this->Merukari->save($book->merukari);
              // $this->Rakuma->save($book->rakuma);
              // $this->Furiru->save($book->furiru);



              $this->Flash->success(__('編集は成功しました.'));

              return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error(__('編集は失敗しました、もう一度試してください.'));
      }


      $this->set(compact('book'));
      $this->set('_serialize', ['book']);

    }


  public function delete($id = null)
  {
    $this->request->allowMethod(['post', 'delete']);
    $book = $this->Books->get($id);
    if ($this->Books->delete($book)) {
        $this->Flash->success(__('削除しました.'));
    } else {
        $this->Flash->error(__('削除は失敗しました、もう一度試してください.'));
    }

    return $this->redirect(['action' => 'index']);

  }

}
