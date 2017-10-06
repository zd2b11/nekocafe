<?php
session_start();

require_once "util.inc.php";
require_once "libs/qd/qdsmtp.php";
require_once "libs/qd/qdmail.php";

if (isset($_SESSION["contact"])) {
  $contact = $_SESSION["contact"];

  $namae   = $contact["namae"];
  $kana    = $contact["kana"];
  $email   = $contact["email"];
  $tel     = $contact["tel"];
  $message = $contact["message"];
  $token   = $contact["token"];

  if ($token !== getToken()) {
    header("Location: contact.php");
    exit;
  }
}
else {
  header("Location: contact.php");
  exit;
}

// 送信ボタンが押されたとき
if (isset($_POST["send"])) {

$body = <<<EOT
■お名前
{$namae}

■フリガナ
{$kana}

■メールアドレス
{$email}

■電話番号
{$tel}

■問い合わせ内容
{$message}

EOT;

  $mail = new Qdmail();

  //エラーを非表示
  $mail->errorDisplay(false);
  $mail->smtpObject()->error_display = false;
// ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆てすと★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
  // //送信内容
  // $mail->from("zd2b11@sim.zdrv.com", "猫カフェ Web");
  // $mail->to("zd2b11@sim.zdrv.com","猫カフェ 管理者（受信者名）");
  // $mail->subject("猫カフェ お問い合わせフォームから");
  // $mail->text($body);

  // //SMTP用設定(xamppのためメールサーバ設定が必要)
  // $param = array(
  //     "host" => "w1.sim.zdrv.com",
  //     "port" => 25,
  //     "from" => "zd2b11@sim.zdrv.com",
  //     "protocol" => "SMTP"
  // );
// ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆てすと★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆

  //送信内容
  $mail->from("zd2b11222@gmail.com", "猫カフェ Web");
  $mail->to("tomo-9@mail.goo.ne.jp","猫カフェ 管理者");
  $mail->subject("猫カフェ お問い合わせフォームから");
  $mail->text($body);

  //SMTP用設定(xamppのためメールサーバ設定が必要)
  $param = array(
      "host" => "ssl://smtp.gmail.com",
      "port" => '465',
      "from" => "zd2b11222@gmail.com",
      'protocol'=>'SMTP_AUTH',
      'user'=>'zd2b11222@gmail.com',
      'pass'=> '',
  );
  $mail->smtp(TRUE);
  $mail->smtpServer($param);
// ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆てすと★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆
  //送信
  $flag = $mail->send();
  //$flag = true;
// ★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆てすと★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆★☆

  if ($flag == TRUE) {
    unset($_SESSION["contact"]);
    $location = home_url('/contact_done');
    header("Location: {$location}");
    exit;
  }
  else {
    $location = home_url('/contact_error');
    header("Location: {$location}");
    exit;
  }

}
// 修正ボタンが押されたとき
if (isset($_POST["back"])) {


	$location = home_url('/contact');
	header("Location: {$location}");
  exit;
}

?>

<?php get_header(); ?>

        <main>
          <div class="main-contents">
            <div class="contact-conf-area">
              <h2 class="caption-box">送信内容確認</h2>
              <div class="conf-table">
                <p>内容を修正される場合は「修正」ボタンを、送信される場合は「送信」ボタンを押してください。</p>
                <table>
                  <tr>
                    <th>お名前</th>
                    <td><?php echo h($namae); ?></td>
                  </tr>
                  <tr>
                    <th>フリガナ</th>
                    <td><?php echo h($kana); ?></td>
                  </tr>
                  <tr>
                    <th>電話番号</th>
                    <td><?php echo h($tel); ?></td>
                  </tr>
                  <tr>
                    <th>メールアドレス</th>
                    <td><?php echo h($email); ?></td>
                  </tr>
                  <tr>
                    <th>お問い合わせ内容</th>
                    <td><?php echo nl2br(h($message)); ?></td>
                  </tr>
                </table>
              </div>
              <div class="form-area">
                <form action="" method="post">
                  <div class="back-btn">
                    <input type="submit" name="back" value="修正">
                  </div>
                  <div class="send-btn">
                    <input type="submit" name="send" value="送信">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </main>

<?php get_footer(); ?>