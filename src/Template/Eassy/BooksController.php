<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\SearchBookForm;
use Cake\I18n\Date;
use Cake\ORM\TableRegistry;


/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 *
 * @method \App\Model\Entity\Book[] paginate($object = null, array $settings = [])
 */
class BooksController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
     public function index()
     {
       $searchBookForm = new SearchBookForm();

       if($this->request->getQuery('form_name') && $this->request->getQuery('form_name') == "search_book_form") {

         $result = $searchBookForm->execute($this->request->getQueryParams());

         $conditions = array();

          if($this->request->getQuery('book_name')   ) {
             $find = $this->request->getQuery('book_name');
            $conditions["Books.book_name like"] = '%'.$find.'%';

          }

           $date = $this->request->getQuery('book_date_start');
           $year = $this->request->getQuery('book_date_start')["year"];
           $month = $this->request->getQuery('book_date_start')["month"];
           $day = $this->request->getQuery('book_date_start')["day"];

           if($year==0){$year = 1000;}
           if($month==0){$month = 1;}
           if($day==0){$day = 1;}

          if(is_array($date) &&  count($month) > 0 && count($day) > 0) {


           $conditions["Books.book_date >="] = new Date($year."-".$month."-".$day);
         }

         $date_end = $this->request->getQuery('book_date_end');
         $year_end = $this->request->getQuery('book_date_end')["year"];
         $month_end = $this->request->getQuery('book_date_end')["month"];
         $day_end = $this->request->getQuery('book_date_end')["day"];

         if($year_end==0){$year_end = 3000;}
         if($month_end==0){$month_end = 12;}
         if($day_end==0){$day_end = 31;}

         if(is_array($date_end) && count($month_end) > 0 && count($day_end) > 0) {

          $conditions["Books.book_date <="] = new Date($year_end."-".$month_end."-".$day_end);
         }

         $books = $this->paginate($this->Books,array(
             'conditions' => $conditions
           )
         );

         $this->request->data('form_name', $this->request->getQuery('form_name'));
         $this->request->data('book_name',$this->request->getQuery('book_name'));
         $this->request->data('book_date_start',$this->request->getQuery('book_date_start'));
         $this->request->data('book_date_end',$this->request->getQuery('book_date_end'));

       } else {
         $books = $this->paginate($this->Books);
       }


       $this->LoadModel("BooksManagers");
       foreach ($books as $book) {
         $book_id = $book["id"];

         $rental_books = $this->BooksManagers->find("all",
          [
            "conditions" => ["book_id" => $book_id]
          ]
        );

        if($rental_books->count() > 0) {
          $book["rental_flag"] = true;
        }else {
          $book["rental_flag"] = false;
        }

       }

       $this->set(compact('books'));
       $this->set(compact('searchBookForm'));

     }

    /**
     * View method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => []
        ]);

        $this->set('book', $book);
        $this->set('_serialize', ['book']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $book = $this->Books->newEntity();
        if ($this->request->is('post')) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $this->set(compact('book'));
        $this->set('_serialize', ['book']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $this->set(compact('book'));
        $this->set('_serialize', ['book']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->LoadModel("BooksManagers");
        $rental_books = $this->BooksManagers->find("all",
           [
             "conditions" => ["book_id" => $id]
           ]
        );

        $this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($id);
        if($rental_books->count() == 0) {
          if ($this->Books->delete($book)) {
            $this->Flash->success(__('The book has been deleted.'));
          }
        } else {
            $this->Flash->error(__('書籍が借りられていましたので、データは削除できません！'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function logout()
    {
      return $this->redirect($this->Auth->logout());
    }
}
