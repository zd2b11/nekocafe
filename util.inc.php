<?php

function h($string)
{
//$string = 'htmlspecialchars(' . $string . ',ENT_QUOTES)';←コレだとダメ
	return htmlspecialchars($string, ENT_QUOTES);
}

// セッションIDを使いsha256でハッシュ化
function getToken() {
	return hash('sha256', session_id());
}
