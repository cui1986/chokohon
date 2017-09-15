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
             <h1 align="center" style="margin-top:20px;color: #FFFFFF;font-size: 50px" >図書新規</h1>
         </div>
     </div>
     <div class="divcss5" style="background-color:#156f1d;height:20px;"></div>

                 <div class="book_book_form_box">
                     <span class="book_sub_title_text">配本 </span>
                     <div class="book_book_add_form">
                         <div class="book_form_add">
                             <form action="#" method="get">
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
                             </form>

                         </div>
                     </div>

                 </div>
