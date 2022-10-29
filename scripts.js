const updateTitle = document.getElementById("update_title");
const updateDate = document.getElementById("update_dateInput");
const updateDesc = document.getElementById("update_desc");
const updateStatus = document.getElementById("update_status");
const updatePriority = document.getElementById("update_priority");
const updateType = document.getElementById("updateType");

function initializeTask(i) {
  let r=document.getElementById(i);
  let d=r.getAttribute("data-info");
  console.log(d);
  let arr=d.split(',')
  if (arr[2] === "Feature") {
    document.getElementById("feature").checked = true;
    document.getElementById("bug").checked = false;
  } else {
    document.getElementById("feature").checked = false;
    document.getElementById("bug").checked = true;
  }
  updateTitle.value = arr[0];
  updatePriority.value = arr[1];
  updateDate.value = arr[4];
  updateDesc.value = arr[5];
  updateStatus.value = arr[3];
  }