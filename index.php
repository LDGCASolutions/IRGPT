<?php
  include 'inc/session.inc.php';
  include 'inc/header.inc.php';
?>
  <a href="/index.php"><h1>IR GPT</h1></a>
  <p>This is a Incdent Response bot built using the GPT-3 LLM</p>
  <?php
    if (isset($_GET['error'])) {
  ?>
  <section class="error">
    <?php if ($_GET['error']==1) { ?>
      Invalid IRP. Try again.
    <?php } ?>
  </section>
  <?php
    }
  ?>
  <?php
    print_r($_SESSION);
  ?>
  <h2>Identify Key Objectives</h2>
  <p>Copy the Incident Response Playbook to analyse</p>
  <form class="" action="/inc/curl.inc.php" method="post">
    <p>
      <textarea name="irp" rows="8" cols="80" placeholder="Incident Response Playbook goes here">
        <?php if (strlen($_SESSION["irp"])) echo $_SESSION["irp"]; ?>
      </textarea>
    </p>
    <button type="submit" name="button">Analyse</button>
  </form>
  <h2>Key Objectives</h2>
  <p>Key objectives identified by LLM are as follows</p>
  <p>
    <textarea name="objectives" rows="8" cols="80" placeholder="Incident Response Objectives will appear here">
      <?php if (strlen($_SESSION["obj"])) echo $_SESSION["obj"]; ?>
    </textarea>
  </p>

<?php
  include 'inc/footer.inc.php';
?>
