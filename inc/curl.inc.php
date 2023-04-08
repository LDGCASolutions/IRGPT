<?php

include 'session.inc.php';

$apiKey = "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";
// print_r($_POST);

if (!strlen($_POST['irp'])) {
  // No content to post to API
  header( 'location: /index.php?error=1' );
  exit();
}

$_SESSION["irp"] = $_POST['irp'];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
$post = [
  "model" => "text-davinci-003",
  "prompt" => "summerise the following playbook into a list of platform independent objectives\n\n".$_POST['irp']."\n\nthe objectives are:",
  "temperature" => 0,
  "max_tokens" => 500,
  "top_p" => 1,
  "frequency_penalty" => 0,
  "presence_penalty" => 0
];
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));

$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'Authorization: Bearer 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';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

$result = json_decode($result, true);
// print_r($result);


if (array_key_exists("error", $result)) {
  // OpenAI API returned an error
  echo "API Error<br>";
  print_r($result);

} else {
  echo "GOOD<br>";
  // print_r($result["choices"][0]["text"]);
  $_SESSION["obj"] = $result["choices"][0]["text"];

  // print_r($_SESSION);

  // Reload the home page
  header( 'location: /index.php' );
  exit();
}

?>
