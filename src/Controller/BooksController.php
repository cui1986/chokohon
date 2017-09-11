<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Form\SearchBookForm;
use Cake\I18n\Date;
use Cake\ORM\TableRegistry;
use App\Form\SearchFuriruForm;

/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 *
 * @method \App\Model\Entity\Book[] paginate($object = null, array $settings = [])
 */
class BooksController extends AppController
{

     public function index()
     {
       $searchBookForm = new SearchFuriruForm();
        $conditions = array();
         $this->LoadModel("Books");
         $books = $this->paginate($this->Books,array(
             'conditions' => $conditions
           )
         );

       $this->set(compact('books'));
       $this->set(compact('searchBookForm'));

     }

    public function view($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => []
        ]);

        $this->set('book', $book);
        $this->set('_serialize', ['book']);
    }

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

}
