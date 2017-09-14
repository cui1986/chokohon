<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;

class SearchMerukariForm extends Form
{

    protected function _buildSchema(Schema $schema)
    {
      return $schema->addField('form_name', ['type' => 'string'])
            ->addField('key_words', 'string')
            ->addField('category_id', ['type' => 'integer'])
            ->addField('book_status', ['type' => 'integer'])
            ->addField('delivery_id', ['type' => 'integer'])
            ->addField('sale_status', ['type' => 'integer']);
    }

}
?>
