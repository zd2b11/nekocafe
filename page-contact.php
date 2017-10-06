<?php
session_start();

require_once "util.inc.php";

$namae   = "";
$kana    = "";
$tel     = "";
$email   = "";
$message = "";

// 確認ページから戻ってきたとき値をセット
if (isset($_SESSION["contact"])) {
  $contact = $_SESSION["contact"];
  $namae   = $contact["namae"];
  $kana    = $contact["kana"];
  $tel     = $contact["tel"];
  $email   = $contact["email"];
  $message = $contact["message"];
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $isValidated = TRUE;

  $namae   = $_POST["namae"];
  $kana    = $_POST["kana"];
  $tel     = $_POST["tel"];
  $email   = $_POST["email"];
  $message = $_POST["message"];
  $token   = $_POST["token"];

  if ($namae === "") {
    $errorNamae = "※お名前を入力してください";
    $isValidated = FALSE;
  }

  if ($kana === "") {
    $errorKana = "※フリガナを入力してください";
    $isValidated = FALSE;
  }
  elseif (!preg_match("/^[ァ-ヶー 　]+$/u", $kana)) {
    $errorKana = "※全角カタカナで入力してください";
    $isValidated = FALSE;
  }

  if ($email === "") {
    $errorEmail = "※メールアドレスを入力してください";
    $isValidated = FALSE;
  }
  elseif (!preg_match("/^[^@]+@[^@]+\.[^@]+$/", $email)) {
    $errorEmail = "※メールアドレスの形式が正しくありません";
    $isValidated = FALSE;
  }

  if ($message === "") {
    $errorMessage = "※お問い合わせ内容を入力してください";
    $isValidated = FALSE;
  }


  if ($isValidated === TRUE) {
    $contact = array(
        "namae"   => $namae,
        "kana"    => $kana,
        "tel"     => $tel,
        "email"   => $email,
        "message" => $message,
        "token"   => $token
    );

    $_SESSION["contact"] = $contact;
    $location = home_url('/contact_conf');
    header("Location: {$location}");
    exit;
  }

}
?>

<?php get_header(); ?>

        <main>
          <div class="main-contents">
            <div id="form-top" class="contact-form">
              <h2 class="caption-box">お問い合わせ</h2>
              <div class="form-area">
                <p>必要事項を記入し、「送信する」をクリックしてください。
                <br>ご記入いただいた個人情報は、お問い合わせの回答以外には使用いたしません。</p>
                <form action="" method="post" novalidate>
                  <input type="hidden" name="token" value="<?php echo getToken(); ?>">
                  <table>
                    <tr>
                      <th><label for="namae">お名前（必須）</label></th>
                      <td>
                        <?php if ($errorNamae) :?>
                          <div class="text-warning"><?php echo h($errorNamae); ?></div>
                        <?php endif; ?>
                        <input type="text" name="namae" id="namae" value="<?php echo h($namae); ?>" required <?php if ($errorNamae) echo "autofocus"; ?>>
                      </td>
                    </tr>
                    <tr>
                      <th><label for="kana">フリガナ（必須）</label></th>
                      <td>
                        <?php if ($errorKana) :?>
                          <div class="text-warning"><?php echo h($errorKana); ?></div>
                        <?php endif; ?>
                        <input type="text" name="kana" id="kana" value="<?php echo h($kana); ?>" placeholder="全角カタカナで入力" required <?php if ($errorKana) echo "autofocus"; ?>>
                      </td>
                    </tr>
                    <tr>
                      <th><label for="tel">電話番号</label></th>
                      <td>
                        <input type="text" name="tel" id="tel" value="<?php echo h($tel); ?>" placeholder="半角数字で入力">
                      </td>
                    </tr>
                    <tr>
                      <th><label for="email">メールアドレス（必須）</label></th>
                      <td>
                        <?php if ($errorEmail) :?>
                          <div class="text-warning"><?php echo h($errorEmail); ?></div>
                        <?php endif; ?>
                        <input type="email" name="email" id="email" value="<?php echo h($email); ?>" placeholder="半角英数字で入力" required <?php if ($errorEmail) echo "autofocus"; ?>>
                      </td>
                    </tr>
                    <tr>
                      <th><label for="message">お問い合わせ内容（必須）</label></th>
                      <td>
                        <?php if ($errorMessage) :?>
                          <div class="text-warning"><?php echo h($errorMessage); ?></div>
                        <?php endif; ?>
                        <textarea name="message" id="message" required <?php if ($errorMessage) echo "autofocus"; ?>><?php echo h($message); ?></textarea>
                      </td>
                    </tr>
                  </table>
                  <div class="submit-area"><input type="submit" value="送信する"></div>
                </form>
              </div>
            </div>
          </div>
        </main>

<?php get_footer(); ?>