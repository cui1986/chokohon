<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Model\Interfaces\BookInfo;


class BooksTable extends Table implements BookInfo
{


      public function initialize(array $config)
      {
          parent::initialize($config);

          $this->setTable('books');
          $this->setDisplayField('id');
          $this->setPrimaryKey('id');

          $this->addBehavior('Timestamp');

          $this->hasOne('Furiru');
          $this->hasOne('Merukari');
          $this->hasOne('Rakuma');
      }

      /**
       * Default validation rules.
       *
       * @param \Cake\Validation\Validator $validator Validator instance.
       * @return \Cake\Validation\Validator
       */
      public function validationDefault(Validator $validator)
      {
          $validator
              ->integer('id')
              ->allowEmpty('id', 'create');

          $validator
              ->allowEmpty('book_isbn')
              ->add('book_isbn', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

          $validator
              ->requirePresence('book_asin', 'create')
              ->notEmpty('book_asin')
              ->add('book_asin', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

          $validator
              ->notEmpty('book_name');

          $validator
              ->allowEmpty('book_comment');

          $validator
              ->integer('del_flg')
              ->requirePresence('del_flg', 'create')
              ->notEmpty('del_flg');
              

          return $validator;
      }

      /**
       * Returns a rules checker object that will be used for validating
       * application integrity.
       *
       * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
       * @return \Cake\ORM\RulesChecker
       */
      public function buildRules(RulesChecker $rules)
      {
          $rules->add($rules->isUnique(['book_asin']));
          $rules->add($rules->isUnique(['book_isbn']));

          return $rules;
      }
      public function get_books(int $book_id){

      }
  }

?>
