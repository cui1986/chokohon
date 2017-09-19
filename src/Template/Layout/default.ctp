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
         <?php echo $this->Html->image("logo.png");?>
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
									<button type="button">図書新規</button>
								</font>
            </h4>
        </div>
     </div>
     <div class="divcss5 title">
         <div>
             <h1>図書一覧</h1>
         </div>
     </div>

     <div class="divcss5 blank"></div>


    <?= $this->fetch('content') ?>

  </body>
  </html>
