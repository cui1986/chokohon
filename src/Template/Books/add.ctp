
<div class="book_book_form_box">
   <span class="book_sub_title_text">配本 </span>
   <div class="book_book_add_form">
      <div class="book_form_login">
            <?= $this->Form->create($book, [
              'type'=>'post',
              'url'=> [
                "controller" => "Books",
                "action" => "add"
              ]
            ]);?>
            <fieldset>
              <label class="book_input_style">
                  <span class="book_hint"><?= $this->Paginator->sort('ASINコード') ?>:</span>
                  <?php
                      echo $this->Form->control(
                           'book_asin',
                         [
                            'templates' => [
                            'inputContainer' => '{{content}}'
                            ],
                            'label'=>false,
                            'class'=>'book_input_box'
                         ]
                      );
                  ?>
              </label>
              <label class="book_input_style">
                  <span class="book_hint"><?= $this->Paginator->sort('ISBNコード') ?>:</span>
                    <?php
                        echo $this->Form->control(
                             'book_isbn',
                      [
                              'templates' => [
                              'inputContainer' => '{{content}}'
                              ],
                              'label'=>false,
                              'class'=>'book_input_box'
                      ]
                        );
                    ?>
              </label>
              <label class="book_input_style">
                  <span class="book_hint"><?= $this->Paginator->sort('書名') ?>:</span>
                    <?php
                        echo $this->Form->control(
                             'book_name',
                      [
                             'templates' => [
                             'inputContainer' => '{{content}}'
                             ],
                             'label'=>false,
                             'class'=>'book_input_box'
                      ]
                        );
                    ?>
                </label>
                <label class="book_input_style">
                    <span class="book_hint"><?= $this->Paginator->sort('コメント') ?>:</span>
                       <?php
                          echo $this->Form->control(
                               'book_comment',
                         [
                                'templates' => [
                                'inputContainer' => '{{content}}'
                                ],
                                'label'=>false,
                                'class'=>'book_input_box'
                          ]
                          );
                       ?>
                </label>
              </fieldset>
                <label class="book_submit">
                        <?php
                           echo $this->Form->control(
                                '新規する',
                        [
                                'templates' => [
                                'submitContainer' => '{{content}}'
                                ],
                                'type'=>'submit'
                        ]
                           );
                        ?>
                </label>
                <?= $this->Form->end() ?>
           </form>

        </div>
      </div>

</div>
