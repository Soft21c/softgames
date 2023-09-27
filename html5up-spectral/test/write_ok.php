<?php
 
  include ('db_connect.php');
 
 
  $username = $_SESSION['userid'];
  $usernic = $_SESSION['user_nic'];
  $board_id = $_GET['board_id'];
  $title = $_POST['title'];
  $content = $_POST['content'];
  $date = date('Y-m-d');
 
  $upload_dir = 'uploads/';
  $upload_file = $upload_dir . $_FILES['SelectFile']['name'];
 
  $file_name = iconv("utf-8","CP949",$upload_file);
  echo "<script>
  alert('$tmpfile');
  </script>";
  print "<pre>";
  if (move_uploaded_file($_FILES['SelectFile']['tmp_name'], $file_name)) {
    print "[수신한 내용]<br><br>";
    print "PATH: " .$upload_file."<br>";
    print "제목 : ".$_POST['title']."<br>";
    print "내용 : ".$_POST['content']."<br>";
    print "파일 :".$_FILES['SelectFile']['type']."<br>";
    if($_FILES['SelectFile']['type']=="image/jpeg"||$_FILES['SelectFile']['type']=="image/gif"){
      print "<img src=$upload_file width='300'>";
    }
  }
  print "</pre>";
 
  if($username && $title && $content){
      $db = query("insert into ".$board_id."(id,name,title,content,date,file) values('".$username."','".$usernic."','".$title."','".$content."','".$date."','".$_FILES['SelectFile']['name']."');");
      echo "<script>
      alert('글쓰기 완료되었습니다.');
      location.href='board.php?board_id=$board_id';</script>";
    }
    else{
      echo "<script>
      alert('글쓰기에 실패했습니다.');
      history.back();</script>";
    }
?>