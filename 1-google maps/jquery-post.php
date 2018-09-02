<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jQuery Post</title>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

<br><br>
<div class="container">

<?php if(!empty($_REQUEST['name'])) { ?>
  <div class="alert alert-info">
    <?=!empty($_REQUEST['name'])?$_REQUEST['name']:''?><br>
    <?=!empty($_REQUEST['age'])?$_REQUEST['age']:''?><br>
    <?=!empty($_REQUEST['message'])?$_REQUEST['message']:''?><br>    
  </div>
<?php } ?>

    <h2>jquery post variables in url</h2>

    <hr>

    <label>Full Name</label>
    <input type="text" name="yourname" class="yourname form-control">
    <br>
    <label>Age</label>
    <input name="yourage" class="yourage form-control">
    <br>
    <label>Message</label>
    <textarea name="yourmessage" class="yourmessage form-control" rows="5"></textarea>
    <br>
    <button type="submit" class="search btn btn-default">GO</button>

</div>

<br><br>





<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery(".search").click(function(){
          // console.log('clicked');
            var nm = jQuery(".yourname").val();
            var ag = jQuery(".yourage").val();
            var msg = jQuery(".yourmessage").val();
            window.open(document.location.protocol +"//"+ document.location.hostname + document.location.pathname + "?name=" + nm + "&age=" + ag + "&message=" + msg,"_self")
        });
    });
</script>

  </body>
</html>

