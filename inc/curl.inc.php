<?php
// define('TESTING', TRUE);
include 'session.inc.php';

function curl($prompt, $model="text-davinci-003") {
  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  $post = [
    "model" => $model,    // "text-davinci-003",
    "prompt" => $prompt,
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

  return $result;
}

$apiKey = "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";
// Option 1 : Analyse IRP
// Option 2 : Analyse responder conversation

$prompt = "";
$section = "";
$model = "text-davinci-003";
$_SESSION["model"] = "base";

if ($_POST["model"] != "base") {
  $model = "davinci:ft-ldgcasolutions:irp-model-001-2023-04-23-09-33-10";
  $_SESSION["model"] = "model1";
}

if (isset($_GET["opt"]) && $_GET["opt"]==1) {
  echo "Option 1";
  if (!strlen($_POST['irp'])) {
    // No content to post to API
    header( 'location: /index.php?error=1' );
    exit();
  } else {
    $_SESSION["irp"] = $_POST['irp'];
    $prompt = "Summerise the following incident response plan into a list of objectives.\n\n".$_POST['irp']."\n\nObjectives:\n";

    if (defined('TESTING')) $result = ["error" => ["message" => "TESTING"]];
    else $result = curl($prompt, $model);

    if (array_key_exists("error", $result)) {
      // OpenAI API returned an error
      $_SESSION["error"] = $result["error"]["message"];
      header( 'location: /index.php?error=4' );
      exit();
    } else {
      echo "GOOD<br>";
      $_SESSION["obj"] = trim($result["choices"][0]["text"]);
      $section .= "#objectives";
    }

  }
} elseif (isset($_GET["opt"]) && $_GET["opt"]==2) {
  echo "Option 2";
  if (!strlen($_POST['conv'])) {
    // No content to post to API
    header( 'location: /index.php?error=2' );
    exit();
  } else {
    $_SESSION["conv"] = $_POST['conv'];
    $prompt = "Identify the actions performed.\n\n".$_POST['conv']."\n\nActions performed:\n";

    if (defined('TESTING')) $result = ["error" => ["message" => "TESTING"]];
    else $result = curl($prompt, $model);

    if (array_key_exists("error", $result)) {
      // OpenAI API returned an error
      $_SESSION["error"] = $result["error"]["message"];
      header( 'location: /index.php?error=4' );
      exit();

    } else {
      echo "GOOD<br>";
      $_SESSION["tasks"] = trim($result["choices"][0]["text"]);
      $section .= "#tasks";
    }
  }

} elseif (isset($_GET["opt"]) && $_GET["opt"]==3) {
  // Accept the customised lists
  $_SESSION['obj'] = $_POST['obj'];
  $_SESSION['tasks'] = $_POST['tasks'];
  if (!strlen($_SESSION['obj']) || !strlen($_SESSION['tasks'])) {
    // No content to post to API
    header( 'location: /index.php?error=3' );
    exit();
  } else {
    $tasks = preg_replace("/\d+\. /", "-", $_SESSION['tasks']); // Remove numbers from TASK list
    $prompt = "objectives are\n".$_SESSION['obj']."\n\ntasks performed are\n".$tasks."\n\nlist only the objectives matching tasks performed, preserve the objective index";
    // echo "\n---------------COMPLETED-----------------\n";
    // echo $prompt;
    // echo "\n-----------------------------------------\n";

    if (defined('TESTING')) $result = ["error" => ["message" => "TESTING"]];
    else $result = curl($prompt, $model);

    if (array_key_exists("error", $result)) {
      // OpenAI API returned an error
      $_SESSION["error"] = $result["error"]["message"];
      header( 'location: /index.php?error=4' );
      exit();

    } else {
      $_SESSION["completed"] = trim($result["choices"][0]["text"]);
      echo $_SESSION["completed"];

      $prompt = "The objectives are\n".$_SESSION["obj"]."\n\nfollowing objectives were met\n".$_SESSION["completed"]."\n\nfollowing objectives were missed";
      // echo "\n---------------MISSED--------------------\n";
      // echo $prompt;
      // echo "\n-----------------------------------------\n";
      if (defined('TESTING')) $result = ["error" => ["message" => "TESTING"]];
      else $result = curl($prompt, $model);

      if (array_key_exists("error", $result)) {
        // OpenAI API returned an error
        $_SESSION["error"] = $result["error"]["message"];
        header( 'location: /index.php?error=4' );
        exit();

      } else {
        $_SESSION["missed"] = trim($result["choices"][0]["text"]);
        echo $_SESSION["missed"];
        $section .= "#evaluation";
      }
    }
  }
} else {
  header( 'location: /index.php?error=0' );
  exit();
}

// print_r($_SESSION); // For testing

// Reload the home page
header( 'location: /index.php'.$section );
exit();



?>
