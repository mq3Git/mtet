<?php
// 送信ボタンが押されたかどうか

session_cache_limiter('public');
session_start();  

if(isset($_POST['submit'])){

// POSTされたデータをエスケープ処理して変数に格納
$company = htmlspecialchars($_POST['company'],ENT_QUOTES | ENT_HTML5);
$name  = htmlspecialchars($_POST['name'],ENT_QUOTES | ENT_HTML5);
$email = htmlspecialchars($_POST['email'],ENT_QUOTES | ENT_HTML5);
$number = htmlspecialchars($_POST['number'],ENT_QUOTES | ENT_HTML5);
$body = htmlspecialchars($_POST['body'],ENT_QUOTES | ENT_HTML5);

$errors = []; //エラー格納用配列
//trim(文字列)→文字列内の空白を除去 →値がなくなればエラーにする
if(trim($name) === '' || trim($name) === "　"){
  $errors['name'] = "お名前を入力してください";
}
if(trim($body) === '' || trim($body) === "　"){
  $errors['body'] = "内容を入力してください";
}  
// エラー配列がなければ完了
if(count($errors) === 0){
  // echo "完了";
  $_SESSION['company']= $company; 
  $_SESSION['name'] = $name;
  $_SESSION['email']= $email;
  $_SESSION['number']= $number;
  $_SESSION['body'] = $body;

  header('Location: confirm.php');
  
}else{

  echo $errors['name'];
  echo $errors['body'];
}
// confirm.phpから戻ってきたときに値を保持
if(isset($_GET) && $_GET['action'] === 'edit'){
  $company = $_SESSION['company'];
  $name  = $_SESSION['name'];
  $email = $_SESSION['email'];
  $number = $_SESSION['number'];
  $body  = $_SESSION['body'];
}
}
$token = sha1(uniqid(mt_rand(),true));
$_SESSION['token'] = $token;
?>
<!DOCTYPE html>
<html lang=”ja”>
<head>
    
<meta charset="utf-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/anime.css">

<title>CONTACT | drone</title>
</head>
<body>
  
<header>
    <a href="#"><img src="" class="logo"></a>
    <div id="hamburger">
      <div class="icon">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    
    <nav id="gnav"> 
      <ul id="large-menu">
        <li><a href="../index.html">HOME</a></li>
        <!-- <li><a href="/news/index.html">NEWS</a></li> -->
        <li><a href="#">COMPANY</a></li>
        <li class="menu"><a href="#">SERVICE</a>
          <ul class="menu_inner">
            <li><a href="../measurement/index.html">測量</a></li>
            <li><a href="../dot/index.html">点検</a></li>
          </ul>
        </li>
        <li><a href="#">CONTACT</a></li>
      </ul>
    </nav>

    <nav class="sm"> 
      <div class="fl">
        <ul id="large-menu">
          <li><a href="../index.html">HOME</a></li>
          <!-- <li><a href="/news/index.html">NEWS</a></li> -->
          <li><a href="#">COMPANY</a></li>
          <li class="menu"><a href="#">SERVICE</a>
            <ul>
            <li><a href="../measurement/index.html">測量</a></li>
            <li><a href="../dot/index.html">点検</a></li>
            </ul>
          </li>
          <li><a href="#">CONTACT</a></li>
        </ul>
      </div>
    </nav>
  </header>

<!-- ここから本文 -->

<main>
  <article>
        
    <section class="contents lowertop">
      <span class="fadeup topanim">
        <h2>CONTACT</h2>
        <h3>お問い合わせ</h3>
      </span>
      <form action="send.php" method="post">
        <div class="form">
          <lavel for="company">会社・団体名<br></lavel>
          <input type="text" class="input" name="company" value="<?php if(isset($company)){echo $company;} ?>" placeholder="株式会社 本所建設">
        </div>
        <div class="form">
          <lavel for="name">お名前<span id="red">*</span></lavel>
          <input type="text" class="input" name="name" value="<?php if(isset($name)){echo $name;} ?>" placeholder="氏名" required>
        </div>
        <div class="form">
          <lavel for="mail">メールアドレス<span id="red">*</span></lavel>
          <input type="email" class="input" name="email" value="<?php if(isset($email)){echo $email;} ?>" placeholder="info@hon-jo.co.jp" required>
        </div>
        <div class="form">
          <lavel for="num">電話番号</lavel>
          <input type="tel" class="input" name="number" value="<?php if(isset($number)){echo $number;} ?>" placeholder="09012345678">
        </div>
        <div class="form">
          <lavel for="body" class="bodylabel">お問い合わせ内容<span id="red">*</span></lavel>
          <textarea type="text" class="input" name="body"  rows="7"  required><?php  if(isset($body)){echo $body;}?></textarea>
        </div>
        <div class="form">
       
      </form>
          
    <form method="post" action="send.php" class="btnItem">
      <input type="hidden" name="token" value="<?php echo $token ?>">
      <button type="submit" class="sendBtn send" value="送信">送信</button>
    </form>
  </section>

  <footer>
    <div>
      <img src="../img/logo.png">
      <p>本社<br>〒584-0005 大阪府富田林市喜志町3丁目1268-4<br>TEL 0721-24-0015　　FAX 0721-24-0315</p>
      <p>大阪支店<br>〒530-0041 大阪府大阪市北区天神橋2丁目3番8号 MF南森町ビル10階<br>TEL 06-6135-0015　　FAX 06-6135-0016</p>
      <hr>
      <nav>
        <ul>
          <li><a href="../index.html">HOME</a></li>
          <!-- <li><a href="news/index.html">NEWS</a></li> -->
          <li><a href="../company/index.html">COMPANY</a></li>
          <li><a href="#">CONTACT</a></li>
        </ul>
        <p>Copyright(C) HONJO CORPORATION All Rights Reserved.</p>
      </nav>
    </div>
  </footer>

</article>
</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../js/js.js"></script>
</body>
</html>