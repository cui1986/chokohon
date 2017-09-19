<!--border部分-->
<div class="border books-index">
  <table border="1" align="center" cellspacing="0" cellpadding="10" width="800" height="500"  style="border-color: #70ad47">
	     <thead>
	        <tr>
             <th><?= $this->Paginator->sort('ISBNコード') ?></th>
             <th><?= $this->Paginator->sort('ASINコード') ?></th>
             <th><?= $this->Paginator->sort('書名') ?></th>
             <th><?= $this->Paginator->sort('コメント') ?></th>
             <th><?= $this->Paginator->sort('详细') ?></th>
             <th><?= $this->Paginator->sort('編集') ?></th>
             <th><?= $this->Paginator->sort('削除') ?></th>

	        </tr>
	     </thead>
       <tbody>
       <?php $i=0; ?>
       <?php foreach ($books as $book): ?>
         <tr <?= ($i%2 != 1)?'class="tr-odd"':'' ?>>
           <?php $i++; ?>
             <td><?= h($book->book_isbn) ?></td>
             <td><?= h($book->book_asin) ?></td>
             <td><?= h($book->book_name) ?></td>
             <td><?= h($book->book_comment) ?></td>
             <td><input type="button" value="详细" style="background: #96c83d" onclick="location.href='<?php echo $this->Url->build([
                           "controller" => "books",
                           "action" => "view",
                           $book->id

                         ]);
                         ?>'">
             </td>

             <td><input type="button" value="編集" style="background: #96c83d" onclick="location.href='<?php echo $this->Url->build([
                           "controller" => "books",
                           "action" => "edit",
 													  $book->id
                         ]);
                         ?>'">
 						</td>
              <td>
                <input type="button" value="削除" onclick="location.href='localhost/chukohon/books/delete'">
              </td>
          </tr>

        <?php endforeach; ?>
	      </tbody>
	     </table>
       <div class="paginator">
          <ul class="pagination">
              <?= $this->Paginator->first('<< ' . __('first')) ?>
              <?= $this->Paginator->prev('< ' . __('previous')) ?>
              <?= $this->Paginator->numbers() ?>
              <?= $this->Paginator->next(__('next') . ' >') ?>
              <?= $this->Paginator->last(__('last') . ' >>') ?>
          </ul>
      </div>
</div>
