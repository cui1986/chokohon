<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Date;
use App\Form\SearchFuriruForm;
use App\Form\SearchMerukariForm;
use App\Form\SearchRakumaForm;


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
        'contain' => []
    ]);

    //2.如果是post形式
    if ($this->request->is('post')) {

        $book = $this->Books->patchEntity($book, $this->request->getData());
        //且请求中的bookname跟存在数据中的bookname不相同

        if($this->request->getData("book_name") && $this->request->getData("book_name") != $book->book_name ){
         //请求中的bookname的值等于keyword
          $book->furiru->key_words = $this->request->getData("book_name");
          $book->merukari->key_words = $this->request->getData("book_name");
          $book->rakuma->key_words = $this->request->getData("book_name");
           //存进四个table里
          $this->Books->save($book);

          $this->Flash->success(__('編集は成功しました.'));
          return $this->redirect(['action' => 'index']);

          //如果请求中的bookname等于存在数据库中的bookname，则直接将数据只存在books一张table里
         } else {
                $this->Books->save($book);

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
