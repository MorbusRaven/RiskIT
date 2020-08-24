<?php 
require_once('config.php');

if(isset($_GET['parent']))
{
  $id = intval($_GET['parent']);
if(isset($_SESSION['username']))
{
  $dn1 =$dn1->fetch_array($mysqli->query('SELECT COUNT(id), riskName FROM risktable  WHERE id="'.$id.'"'));
if($dn1['id']>0)
{
?>
<!DOCTYPE html>
<html>
    <head> 
        <title>Risk Table</title>
        <?php require_once( ROOT_PATH . '/includes/head_section.php') ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php include( ROOT_PATH . '/includes/navbar.php') ?>
        <div class="container-fluid" id="risk_table">
            
               <div class="container-fluid">
    <div class="logged_in_info">
        <span>Welcome <?php echo $_SESSION['user']['username'] ?></span>
        |
        <span><a href="logout.php">logout</a></span>
    </div>
<?php
if(isset($_POST['message'], $_POST['title']) and $_POST['message']!='' and $_POST['title']!='')
{
  include('bbcode_function.php');
  $title = $_POST['title'];
  $message = $_POST['message'];
  if(get_magic_quotes_gpc())
  {
    $title = stripslashes($title);
    $message = stripslashes($message);
  }
  $title = $mysqli->real_escape_string($title);
  $message = $mysqli->real_escape_string(bbcode_to_html($message));
  if($mysqli->query('insert into topics (parent, id, id2, title, message, authorid, timestamp, timestamp2) select "'.$id.'", ifnull(max(id), 0)+1, "1", "'.$title.'", "'.$message.'", "'.$_SESSION['userid'].'", "'.$time().'", "'.$time().'" from topics'))
  {
  ?>
  <div class="message">The topic have successfully been created.<br />
  <a href="list_topics.php?parent=<?php echo $id; ?>">Go to the forum</a></div>
  <?php
  }
  else
  {
    echo 'An error occurred while creating the topic.';
  }
}
else
{
?>
<form action="new_topic.php?parent=<?php echo $id; ?>" method="post">
  <label for="title">Title</label><input type="text" name="title" id="title"  /><br />
    <label for="message">Message</label><br />
    <div class="message_buttons">
        <input type="button" value="Bold" onclick="javascript:insert('[b]', '[/b]', 'message');" /><!--
        --><input type="button" value="Italic" onclick="javascript:insert('[i]', '[/i]', 'message');" /><!--
        --><input type="button" value="Underlined" onclick="javascript:insert('[u]', '[/u]', 'message');" /><!--
        --><input type="button" value="Image" onclick="javascript:insert('[img]', '[/img]', 'message');" /><!--
        --><input type="button" value="Link" onclick="javascript:insert('[url]', '[/url]', 'message');" /><!--
        --><input type="button" value="Left" onclick="javascript:insert('[left]', '[/left]', 'message');" /><!--
        --><input type="button" value="Center" onclick="javascript:insert('[center]', '[/center]', 'message');" /><!--
        --><input type="button" value="Right" onclick="javascript:insert('[right]', '[/right]', 'message');" />
    </div>
    <textarea name="message" id="message" cols="70" rows="6"></textarea><br />
    <input type="submit" value="Send" />
</form>
<?php
}
?>
    </div>
    <div class="foot"><a href="http://www.webestools.com/scripts_tutorials-code-source-26-simple-php-forum-script-php-forum-easy-simple-script-code-download-free-php-forum-mysql.html">Simple PHP Forum Script</a> - <a href="http://www.webestools.com/">Webestools</a></div>
  </body>
</html>
<?php
}
else
{
  echo '<h2>The category you want to add a topic doesn\'t exist.</h2>';
}
}
else
{
?>
<h2>You must be logged to access this page.</h2>
<div class="box_login">
  <form action="login.php" method="post">
    <label for="username">Username</label><input type="text" name="username" id="username" /><br />
    <label for="password">Password</label><input type="password" name="password" id="password" /><br />
        <label for="memorize">Remember</label><input type="checkbox" name="memorize" id="memorize" value="yes" />
        <div class="center">
          <input type="submit" value="Login" /> <input type="button" onclick="javascript:document.location='signup.php';" value="Sign Up" />
        </div>
    </form>
</div>
<?php
}
}
else
{
  echo '<h2>The ID of the category you want to add a topic is not defined.</h2>';
}
?>