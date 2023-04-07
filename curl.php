<?php
$apiKey = "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";

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/completions');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"model\": \"text-davinci-003\",\n  \"prompt\": \"summerise the following playbook into a list of platform independent objectivesnn[SECTION]nnthe objectives are\",\n  \"temperature\": 0,\n  \"max_tokens\": 500,\n  \"top_p\": 1,\n  \"frequency_penalty\": 0,\n  \"presence_penalty\": 0\n}");

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
print_r($result);

?>
