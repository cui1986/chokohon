
<div class="book_book_form_box">
    <span class="book_sub_title_text">配本 </span>
    <div class="book_book_add_form">
        <div class="book_form_login">

            <?= $this->Form->create(null, [
                'type' => 'post',
                'url' => [
                    'controller'=>'books',
                    'action'=>'edit',
                     $book->id
                ]
            ]);?>


            <label class="book_input_style">
                <?=$this->Form->input('book_isbn', [

                    'id'=>null,
                    'label' => 'ISBN コード:',
                    'class' => 'book_input_box',
                    'templates'=>[
                        'inputContainer' =>'{{content}}'
                    ]
                ]);?>
            </label>
            <label class="book_input_style">
                <?=$this->Form->input('book_name', [

                    'id'=>null,
                    'label' => '書名:',
                    'class' => 'book_input_box',
                    'templates'=>[
                        'inputContainer' =>'{{content}}'
                    ]
                ]);?>
            </label>
            <label class="book_input_style">
                <?=$this->Form->input('book_comment', [

                    'id'=>null,
                    'label' => 'コメント:',
                    'class' => 'book_input_box',
                    'templates'=>[
                        'inputContainer' =>'{{content}}'
                    ]
                ]);?>
            </label>
                <!-- <label class="book_input_style">
                    <span class="book_hint">ASIN コード:</span>
                    <input class="book_input_box" name="email" />
                </label>
                <label class="book_input_style">
                    <span class="book_hint">ISBN コード:</span>
                    <input class="book_input_box" name="email" />
                </label>
                <label class="book_input_style">
                    <span class="book_hint">書名:</span>
                    <input class="book_input_box" name="email" />
                </label>
                <label class="book_input_style">
                    <span class="book_hint">コメント:</span>
                    <input class="book_input_box" name="email" />
                </label> -->
                <label class="book_submit">
                    <input type="submit" value="登録する" />
                </label>
            </form>

        </div>
    </div>
</div>
