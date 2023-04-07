<?php
  include 'inc/header.inc.php';
?>
  <h1>IR GPT</h1>
  <p>This is a Incdent Response bot built using the GPT-3 LLM</p>
  <h2>Identify Key Objectives</h2>
  <p>Copy the Incident Response Playbook to analyse</p>
  <p>
    <textarea name="irp" rows="8" cols="80"></textarea>
  </p>
  <button type="button" name="button">Analyse</button>
  <h2>Key Objectives</h2>
  <p>Key objectives identified by LLM are as follows</p>
  <p>
    <textarea name="objectives" rows="8" cols="80"></textarea>
  </p>

  <a href="/curl.php">Curl</a>

<?php
  include 'inc/footer.inc.php';
?>
