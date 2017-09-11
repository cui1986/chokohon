<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Validation\Validator;


class SearchFuriruForm extends Form
{


    protected function _buildSchema(Schema $schema)
    {
        return $schema->addField('form_name', ['type' => 'string'])
            //キーワード
            ->addField('key_words', ['type' => 'longtext'])

            //カテゴリ
            ->addField('category_id', ['type' => 'int'])

            //商品状態
            ->addField('book_status', ['type' => 'string'])

            //配送料の負担
            ->addField('carriage', ['type' => 'int'])

            //販売状況
            ->addField('sale_status', ['type' => 'string']);
    }
}
?>
