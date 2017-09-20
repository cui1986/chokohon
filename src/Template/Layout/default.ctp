<!DOCTYPE html>
<html>
<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>chokohon</title>
  <?= $this->Html->meta('icon') ?>
  <?= $this->Html->css('basic.css') ?>
  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
  <?= $this->fetch('script') ?>
</head>
<body>
     <div class="divcss5">
         <a href="<?php echo $this->Url->build([
                        "controller" => "books",
                        "action" => "index"]);
                  ?>"
                  target="_blank">
    <?php echo $this->Html->image("logo.png");?>
        </a>
     </div>
     <div class="divcss5 navi">
        <div>
            <h4>
                <font>お知らせ｜ご利用ガイド</font>
            </h4>
        </div>
     </div>

     <div class="divcss5 link">
        <div>
            <h4>
                <font>
									<input type="button" value="配本" onclick="location.href='<?php echo $this->Url->build([
                                "controller" => "books",
                                "action" => "add",
                              ]);
                              ?>'">
								</font>
            </h4>
        </div>
     </div>
     <div class="divcss5 title">
         <div>
          <?php if ($this->request->action == "index"){  ?> <h1>図書一覧</h1><?php }?>
          <?php if ($this->request->action == "add"){  ?> <h1>図書新規</h1><?php }?>
          <?php if ($this->request->action == "edit"){  ?> <h1>図書編集</h1><?php }?>
         </div>
     </div>

     <div class="divcss5 blank"></div>


    <?= $this->fetch('content') ?>

  </body>
  </html>
