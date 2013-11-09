<?php
   // Link to the database server
   $dbLink = mysql_connect('localhost', 'root', 'me32316');
   if (!$dbLink) {
       die('Could not connect to the datal_error());
   }

   // If this is in response to the "Add" button, insert the new record
   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $author  = $_REQUEST['email'];
      $comment = $_REQUEST['commenttext'];
      $insert = sprintf("INSERT INTO comments (user, comment, page) ".
                        "VALUES ('%s', '%s', '%s')",
                        mysql_real_escape_string($aubase server: ' . mysql_error());
   }

   // Let's use our database
   $db = mysql_select_db('mydatabase', $dbLink);
   if (!$db) {
       die('Could not connect to the database: ' . mysqthor),
                        mysql_real_escape_string($comment),
                        mysql_real_escape_string($_SERVER['PHP_SELF']));
      mysql_query($insert) or die('Cannot add comment: '.mysql_error());
   }
?>

<!DOCTYPE HTML>
<html>
<head>
   <title>First page of comments application</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="server/comments.css">
   <script src="server/comments.js"></script>
   <style type="text/css">
<!--
.style1 {color: #000033}
-->
   </style>
</head>
<body class="defaults">
<div id="oldcomments" class="oldcomments">   

<?php
// Format the query
$query = sprintf("SELECT * FROM comments WHERE page='%s' ".
"ORDER BY createdate",
mysql_real_escape_string($_SERVER['PHP_SELF']));
// Select the records
$resource = mysql_query($query);
if ($resource) {
while ($record = mysql_fetch_object($resource)) {
echo '<div class="commenttitle">Comment by '.$record->user.
' on '.$record->createdate.'</div>';
echo '<div class="commenttext">'.$record->comment.'</div>';
}
} else {
// No records found
echo 'No comments';
}
?>



</div>
<div id="newcomments" class="newcomments">
      <form action="<?php echo $_SERVER['server/PHP_SELF']; ?>" method="POST">
         <div class="entry">
            <h4><span class="style1">email address : 
              </span>
              <input type="text" id="email" name="email"
                                                      class="email" />
            </h4>
         </div>
         <div class="entry">
            <h4><span class="style1">Comment :</span> 
              <textarea id="commenttext" name="commenttext"
                                       class="commenttext"></textarea>
            </h4>
         </div>
         <div class="entry">
            <input type="submit" value="Add !" />
         </div>
         <input type="hidden" id="ipaddr" name="ipaddr" 
                    value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
      </form>
   </div>
</body>
</html>

<!-- Close the database -->
<?php mysql_close($dbLink); ?>
