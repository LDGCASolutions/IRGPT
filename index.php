<?php
  include 'inc/session.inc.php';
  include 'inc/header.inc.php';
?>
  <a href="/index.php"><h1>IR GPT</h1></a>
  <p>by Team BBQ</p>
  <p>This is an application for evaluating the performance of incident response. GPT-3 LLM is used to identify objectives of a given IRP, tasks accomplished during incident response and finally identify which objectives were met or missed during the process.</p>
  <?php
    if (isset($_GET['error'])) {
  ?>
  <section class="error">
    <?php if ($_GET['error']==1) { ?>
      Empty IRP. Try again.
    <?php } elseif ($_GET['error']==2) { ?>
      No evidence. Try again.
    <?php } elseif ($_GET['error']==3) { ?>
      Objectives list and/or Task list empty.
    <?php } else { ?>
      Unknown Error. Try again.
    <?php } ?>
  </section>
  <?php
    }
  ?>
  <div class="row">
    <div id="objectives" class="col">
      <h2>Identify Key Objectives</h2>
      <p>Copy the Incident Response Playbook to analyse</p>
      <form class="" action="/inc/curl.inc.php?opt=1" method="post">
        <p>
          <textarea name="irp" rows="8" cols="80" placeholder="Incident Response Playbook goes here"><?php if (strlen($_SESSION["irp"])) echo $_SESSION["irp"]; ?></textarea>
        </p>
        <button type="submit" name="button">Analyse</button>
      </form>
    </div>
    <div class="col">
      <h2>Key Objectives</h2>
      <p>Key objectives identified by LLM are as follows</p>
      <p>
        <textarea form="missMatch" name="obj" rows="8" cols="80" placeholder="Incident Response Objectives will appear here"><?php if (strlen($_SESSION["obj"])) echo $_SESSION["obj"]; ?></textarea>
      </p>
      <form class="" action="inc/clear.inc.php" method="post">
        <button type="submit" name="button">Clear</button>
      </form>
    </div>
  </div>
  <div id="tasks" class="row">
    <div class="col">
      <h2>Identify responder achievements</h2>
      <p>Copy the evidence of the incident response</p>
      <form class="" action="/inc/curl.inc.php?opt=2" method="post">
        <p>
          <textarea name="conv" rows="8" cols="80" placeholder="Responder conversation goes here"><?php if (strlen($_SESSION["conv"])) echo $_SESSION["conv"]; ?></textarea>
        </p>
        <button type="submit" name="button">Analyse</button>
      </form>
    </div>
    <div class="col">
      <h2>Key Achievements</h2>
      <p>Key achievements identified by LLM are as follows</p>
      <p>
        <textarea form="missMatch" name="tasks" rows="8" cols="80" placeholder="Tasks performed will appear here"><?php if (strlen($_SESSION["tasks"])) echo $_SESSION["tasks"]; ?></textarea>
      </p>
      <form class="" action="inc/clear.inc.php" method="post">
        <button type="submit" name="button">Clear</button>
      </form>
    </div>
  </div>
  <div id="evaluation" class="">
    <h2>Evaluate the response</h2>
    <p>"Key objectives" and "Key achievements" lists will be analysed to identify objectives that were achieved or missed.</p>
    <form id="missMatch" class="" action="/inc/curl.inc.php?opt=3" method="post">
      <button type="submit" name="button">Analyse</button>
    </form>
  </div>
  <div class="row">
    <div class="col">
      <h2>IRP objectives met by the responder</h2>
      <textarea name="completed" rows="8" cols="80" placeholder="Completed objectives will appear here"><?php if (strlen($_SESSION["completed"])) echo $_SESSION["completed"]; ?></textarea>
    </div>
    <div class="col">
      <h2>IRP objectives missed by the responder</h2>
      <textarea name="missed" rows="8" cols="80" placeholder="Missed objectives will appear here"><?php if (strlen($_SESSION["missed"])) echo $_SESSION["missed"]; ?></textarea>
    </div>
  </div>
  <div class="">
    <form class="" action="inc/clear.inc.php" method="post">
      <button type="submit" name="button">Clear</button>
    </form>
  </div>
<?php
  include 'inc/footer.inc.php';
?>
