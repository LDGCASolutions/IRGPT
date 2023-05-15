function selectModel() {
  var objModel = document.getElementById("objModel");
  var tskModel = document.getElementById("tskModel");
  var evalModel = document.getElementById("evalModel");

  if (modelSelector.checked) {
    console.log("Fine tuned model selected");
    objModel.value = "model1";
    tskModel.value = "model1";
    evalModel.value = "model1";
  }
  else {
    console.log("Base TEXT-DAVINCI-003 model selected");
    objModel.value = "base";
    tskModel.value = "base";
    evalModel.value = "base";
  }
}

function init() {
  // Model selector operation
  var modelSelector = document.getElementById("modelSelector");
  modelSelector.onclick = selectModel;

  // Display Objective counter
  var objCountView = document.getElementById("objCount");
  var objTextArea = document.getElementById("objText");
  var objCount = 0;

  if (objTextArea.value.length > 0) {
    objCount = objTextArea.value.match(/\d\. /g).length;

    if (objCount > 0) {
      objCountView.innerHTML = "Key Objectives (" + objCount + ")";
    }
  }

  // Display Achievement counter
  var taskCountView = document.getElementById("tskCount");
  var taskTextArea = document.getElementById("taskText");
  var taskCount = 0;

  if (taskTextArea.value.length > 0) {
    taskCount = taskTextArea.value.match(/\d\. /g).length;

    if (taskCount > 0) {
      taskCountView.innerHTML = "Key Achievements (" + taskCount + ")";
    }
  }

  // Display Objectives Met counter
  var objMetCountView = document.getElementById("objMetCount");
  var objMet = document.getElementById("objMet");
  var objMetCount = 0

  if (objMet.value.length > 0) {
    objMetCount = objMet.value.match(/\d\. /g).length;

    objMetCountView.innerHTML = objMetCount + "/" + objCount + " IRP objectives met by the responder";
  }

  // Display Objectives Missed counter
  var objMissedCountView = document.getElementById("objMissedCount");
  var objMissed = document.getElementById("objMissed");
  var objMissedCount = 0

  if (objMissed.value.length > 0) {
    objMissedCount = objMissed.value.match(/\d\. /g).length;

    objMissedCountView.innerHTML = objMissedCount + "/" + objCount + " IRP objectives missed by the responder";
  }

}

window.onload = init
