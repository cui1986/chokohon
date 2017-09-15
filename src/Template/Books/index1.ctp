<!DOCTYPE html>
<html>
<head>
	<title>chokohon</title>
	<meta charset="utf-8">
    <style type="text/css">
        .page{text-align: center;
               margin-top: 50px;
        }
        .page a,.page span{
            text-decoration: none;
            border:1px solid #70ad47;
            padding: 5px 7px;
            color: #767675;
            cursor: pointer;
        }
        .page a:hover,.page span:hover{
            color: red;
        }
        .divcss5{
            margin: 0 auto;width: 100%;height: 100%
        }
        .border{
            margin: 0 auto;margin-top: 30px;width: 100%;height: 100%;text-align: center;
        }
    </style>
</head>
<body>

     <div class="divcss5">
         <img src="1504663679_547816.png" style="height: 280px;width: 300;float: left;margin-top:10px;margin-left: 100px">
     </div>


     <div class="divcss5" style="background-color:#bcf06a;height:50px;">
        <div style="float: right;margin-top:8px;margin-right: -170px;">
            <h4 align="right" style="margin-top: 0px;">
                <font color="#FFFFFF"><button type="button" style="background: #96c83d">図書新規</button></font>
            </h4>
        </div>
     </div>
     <div class="divcss5" style="background-color:#fbf7b5;height:150px;">
         <div style="background-color:#79976d;display: inline-block；height:100px;width:300px;float: right;margin-top:15px;margin-right: 50px;">
             <h1 align="center" style="margin-top:20px;color: #FFFFFF;font-size: 50px" >図書一覧</h1>
         </div>
     </div>
     <div class="divcss5" style="background-color:#156f1d;height:20px;"></div>

     <!--border部分-->
     <div class="border">
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

             <tbody align="center" font-size="12px" >
　　　　<?php foreach ($books as $book): ?>
        <tr bgcolor="e2efda">
            <td><?= h($book->book_isbn) ?></td>
            <td><?= h($book->book_asin) ?></td>
            <td><?= h($book->book_name) ?></td>
            <td><?= h($book->book_comment) ?></td>
            <td><input type="button" value="详细" style="background: #96c83d" onclick="location.href='<?php echo $this->Url->build([
                          "controller" => "books",
                          "action" => "view",
                        ]);
                        ?>'"
            </td>

            <td><input type="button" value="編集" style="background: #96c83d" onclick="location.href='<?php echo $this->Url->build([
                          "controller" => "books",
                          "action" => "edit",
													 $book->id
                        ]);
                        ?>'"
						</td>
            <td><input type="button" value="削除" style="background: #96c83d" onclick="location.href='localhost/chukohon/books/delete' "</td>
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
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</body>
</html>
