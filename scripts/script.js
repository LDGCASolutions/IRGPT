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
  var modelSelector = document.getElementById("modelSelector");
  modelSelector.onclick = selectModel;
}

window.onload = init
