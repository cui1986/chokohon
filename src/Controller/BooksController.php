<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Date;
use App\Form\SearchFuriruForm;
use App\Form\SearchMerukariForm;
use App\Form\SearchRakumaForm;
use App\Model\Table\MerukariTable;
use App\Model\Table\FuriruTable;
use App\Model\Table\RakumaTable;


class BooksController extends AppController
{

  public function index()
  {
    $this->loadModel('Books');
    $searchMerukariForm = new SearchMerukariForm();

    // $furiru_model   = new FuriruTable;
    // //id=2のデータを転送させるため
    $furiru_model = $this->LoadModel("FrilRules");
    $result = $furiru_model->get_books(1);

    // var_dump($result);
    // exit();

    $books = $this->paginate($this->Books);


    $this->set(compact('searchMerukariForm'));
    $this->set(compact('books'));

  }


  public function viewMerukari($id = null)
  {

    $searchMerukariForm = new SearchMerukariForm();

    // $furiru_model   = new FuriruTable;
    // //id=2のデータを転送させるため
    // // $furiru_model = $this->LoadModel("FrilRules");
    // $result = $furiru_model->get_books(1);

    //テストの内容！
    $merukari = new MerukariTable();
    $merukari = $merukari->get_books(1);

    // var_dump($merukari);
    // exit();
    $this->set(compact('searchMerukariForm'));
    $this->set(compact('books'));
  }

  public function viewFuriru($id = null)
  {

    $searchFuriruForm = new SearchFuriruForm();




    //テストの内容！

    $furiru = new FuriruTable();
    $furiru = $furiru->get_books(1);

    // var_dump($merukari);
    // exit();

    $this->set(compact('searchFuriruForm'));
    $this->set(compact('books'));
  }

  public function viewRakuma($id = null)
  {

    $searchRakumaForm = new SearchRakumaForm();

    // $furiru_model   = new FuriruTable;
    // //id=2のデータを転送させるため
    // // $furiru_model = $this->LoadModel("FrilRules");
    // $result = $furiru_model->get_books(1);

    //テストの内容！

    $merukari = new FuriruTable();
    $merukari = $merukari->get_books(1);

    // var_dump($merukari);
    // exit();
    $this->set(compact('books'));
    $this->set(compact('searchMerukariForm'));

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

    $book = $this->Books->get($id, [
        'contain' => [ ]
    ]);

    if ($this->request->is(['post','put','patch'])) {
        $book = $this->Books->patchEntity($book, $this->request->getData());
        if($this->request->getData("book_name") && $this->request->getData("book_name") != $book->book_name ){

            $furiru = $this->Furiru->newEntity();
            $merukari = $this->Merukari->newEntity();
            $rakuma = $this->Rakuma->newEntity();

            $furiru->key_words = $this->request->getData("book_name");
            $merukari->key_words = $this->request->getData("book_name");
            $rakuma->key_words = $this->request->getData("book_name");


            $book->furiru = $furiru;
            $book->merukari = $merukari;
            $book->rakuma = $rakuma;

        if ($this->Books->save($book)) {
            $this->Flash->success(__('編集は成功しました.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('編集は失敗しました、もう一度試してください.'));
    }
    $this->set(compact('book'));
    $this->set('_serialize', ['book']);

  }

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
