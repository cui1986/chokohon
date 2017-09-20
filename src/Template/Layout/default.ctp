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
  <script>
      $(document).ready(function () {
          $("#key_words").val("<?php echo $rakuma_rule["key_words"] ?>");
          function select_form(formId, optionValue) {
              $("#" + formId).find("option[value='" + optionValue + "']").attr("selected", true);
          }
          select_form("category_id",<?php echo $rakuma_rule["category_id"] ?>);
          select_form("condition_type",<?php echo $rakuma_rule["condition_type"] ?>);
          select_form("postage_type",<?php echo $rakuma_rule["postage_type"] ?>);
          select_form("selling_status",<?php echo $rakuma_rule["selling_status"] ?>);

          $("#book_list").find("tr:even").addClass("tr-odd");
      });
  </script>
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
									<button type="button" onclick="location.href='<?php echo $this->Url->build([
                                "controller" => "books",
                                "action" => "add"
                              ]);?>'">図書新規</button>
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
