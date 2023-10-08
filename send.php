<?php
session_start(); // セッションを開始

if ($_SESSION['token'] === $_POST['token']) {
    if (isset($_SESSION['name'])) {
        $company = $_SESSION['company'];
        $name = $_SESSION['name'];
        $email = str_replace(array("\r", "\n"), '', $_SESSION['email']);
        $number = $_SESSION['number'];
        $body = $_SESSION['body'];

        $to = "maeminami.n@gmail.com";
        $mailtitle = "{$name}様よりお問い合わせが届きました。";
        $contents = <<<EOD
◆会社・団体名
{$company}

◆お名前
{$name}

◆メールアドレス
{$email}

◆電話番号
{$number}

◆お問い合わせ内容
{$body}
EOD;

        $from = 'From: ' . $email;

        // 相手に送る送信完了メールを構築
        $to2 = $email;
        $mailtitle2 = "&#8203;``oaicite:{"number":1,"invalid_reason":"Malformed citation 【株式会社 本所建設】"}``&#8203;受付を完了いたしました。";
        $contents2 = <<<EOD
------------------------------------------------------------------
本メールはシステムからの自動配信メールです。
------------------------------------------------------------------

この度はお問い合わせいただき、ありがとうございました。
以下の内容で承りました。
─────────────────────────────

{$contents}

─────────────────────────────
なお、このメールは自動返信メールとなっております。
担当者が確認のうえ、後日改めてご連絡差し上げますので今しばらくお待ちください。

☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆
株式会社　Honjo state
Email  info@hon-jo.co.jp 
&#8203;``oaicite:{"number":2,"invalid_reason":"Malformed citation 【本   社】"}``&#8203;〒530-0041
          大阪市北区天神橋2丁目3-8MF南森町ビル10階
■ホームページ
  http://www.hon-jo.co.jp/
☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆☆
EOD;

        $from2 = 'From: ' . $to;

        // メール送信処理
        $message = '';

        if (mail($to2, $mailtitle2, $contents2, $from2)) {
            // 自分に送信
            if (mail($to, $mailtitle, $contents, $from)) {
                // 終了処理開始 セッションの破棄
                $_SESSION = [];
                session_destroy();
                // セッションの破棄
                $message = '<p>『' . $email . '』宛に確認メールを送信しました。<br>お問い合わせありがとうございます。</p>';
            } else {
                $message = '<p>何らかの理由で送信エラーが発生しました。<br>しばらく待ってから再度送信してください。</p>';
            }
        } else {
            $message = '<p>『' . $email . '』宛に確認メールを送信できませんでした。<br>正しいメールアドレスで再度ご連絡をお願いいたします。</p>';
        }
    }
} else {
    // 直接send.phpにアクセスしようとしたら強制的にリダイレクト
    header('Location: index.php');
}
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
        <!-- <li><a href="/honjodrone/news/index.html">NEWS</a></li> -->
        <li><a href="../company/index.html">COMPANY</a></li>
        <li class="menu"><a href="#">SERVICE</a>
          <ul class="menu_inner">
            <li><a href="../measurement/index.html">測量</a></li>
            <li><a href="../dot/index.html">点検</a></li>
          </ul>
        </li>
        <li><a href="../contact/index.php">CONTACT</a></li>
      </ul>
    </nav>

    <nav class="sm"> 
      <div class="fl">
        <ul id="large-menu">
          <li><a href="../index.html">HOME</a></li>
          <!-- <li><a href="/honjodrone/news/index.html">NEWS</a></li> -->
          <li><a href="../company/index.html">COMPANY</a></li>
          <li class="menu"><a href="#">SERVICE</a>
            <ul class="menu_inner">
              <li><a href="../measurement/index.html">測量</a></li>
              <li><a href="../dot/index.html">点検</a></li>
            </ul>
          </li>
          <li><a href="../contact/index.php">CONTACT</a></li>
        </ul>
      </div>
    </nav>
  </header>

<!-- ここから本文 -->

<main>
  <article>
        
    <section class="contents lowertop">
      <span>
        <h2>CONTACT</h2>
        <h3>お問い合わせ</h3>
      </span>
      <h4>お問い合わせありがとうございました。<br>
    
<?php 
        if($message !== ""){
          echo $message;
        }
      ?></h4>  
        
      <a href="../index.html" class="btnItem"><button class="sendBtn send" >TOPに戻る</button></a>
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