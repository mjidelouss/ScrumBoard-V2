const updateTitle = document.getElementById("update_title");
const updateDate = document.getElementById("update_dateInput");
const updateDesc = document.getElementById("update_desc");
const updateStatus = document.getElementById("update_status");
const updatePriority = document.getElementById("update_priority");
const updateType = document.getElementById("updateType");
const taskId = document.getElementById("tasId");

function initializeTask(i) {
  let init = document.getElementById(i);
  let dataInfo = init.getAttribute("data-info");
  let arr = dataInfo.split(',')
  let date = arr[4].split(' ');
  if (arr[2] === "Feature") {
    document.getElementById("feature").checked = true;
    document.getElementById("bug").checked = false;
  } else {
    document.getElementById("feature").checked = false;
    document.getElementById("bug").checked = true;
  }
  updateTitle.value = arr[0];
  updatePriority.value = arr[1];
  updateDate.value = date[0];
  updateDesc.value = arr[5];
  updateStatus.value = arr[3];
  taskId.value = i;
  }