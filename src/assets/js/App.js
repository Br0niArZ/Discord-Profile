function getDominantColor(imgEl) {
  var blockSize = 5,
    defaultRGB = { r: 0, g: 0, b: 0 },
    canvas = document.createElement("canvas"),
    context = canvas.getContext && canvas.getContext("2d"),
    data,
    width,
    height,
    i = -4,
    length,
    rgb = { r: 0, g: 0, b: 0 },
    count = 0;

  if (!context) {
    return defaultRGB;
  }

  height = canvas.height =
    imgEl.naturalHeight || imgEl.offsetHeight || imgEl.height;
  width = canvas.width = imgEl.naturalWidth || imgEl.offsetWidth || imgEl.width;

  context.drawImage(imgEl, 0, 0);

  try {
    data = context.getImageData(0, 0, width, height);
  } catch (e) {
    return defaultRGB;
  }

  length = data.data.length;

  while ((i += blockSize * 4) < length) {
    ++count;
    rgb.r += data.data[i];
    rgb.g += data.data[i + 1];
    rgb.b += data.data[i + 2];
  }

  rgb.r = ~~(rgb.r / count);
  rgb.g = ~~(rgb.g / count);
  rgb.b = ~~(rgb.b / count);

  let hexColor =
    "#" +
    rgb.r.toString(16).padStart(2, "0") +
    rgb.g.toString(16).padStart(2, "0") +
    rgb.b.toString(16).padStart(2, "0");

  document.getElementById("user-banner").style.backgroundColor = hexColor;
}

let timestamps = [];
$(document).ready(function () {
  // Timestamps timer function
  updateTimers();
  setInterval(updateTimers, 1000);

  // Tooltips
  let tooltipsEl = $("[data-tooltip]");
  tooltipsEl.removeClass("hidden");

  // Reset scroll position
  let menuEL = $("[menu-item]");
  menuEL.on("click", function () {
    $("#content").scrollTop(0);
  });

  //update activities with AJAX
  setInterval(updateActivities, 10000);
});

// user activity loading with AJAX requests
function updateActivities() {
  const urlParams = new URLSearchParams(window.location.search);
  const userId = urlParams.get("userId") != null ? urlParams.get("userId") : "";

  console.log(userId);
  $.ajax({
    url: "reload.php?userId=" + userId,
    method: "GET",
    success: function (data) {
      $("#user-activities").html(data);
      updateTimers();
      tippy("[data-tippy-content]", {
        theme: "discord",
      });
      document.querySelectorAll("img").forEach(function (img) {
        img.onerror = function () {
          this.style.display = "none";
        };
      });
    },
    error: function (xhr, status, error) {
      console.error("Request failed:", status, error);
    },
  });
}

// Update timers
function updateTimers() {
  const userGameDivs = $(".user-game");
  const currentDate = new Date();

  for (let i = 0; i < timestamps.length; i++) {
    if (timestamps[i] != null) {
      let formattedTime;

      if (timestamps[i].end != null) {
        let timeDiff = timestamps[i].end - currentDate.getTime();
        formattedTime = formatTimeDifference(timeDiff, "left");
      } else if (timestamps[i].start != null) {
        let timeDiff = currentDate.getTime() - timestamps[i].start;
        formattedTime = formatTimeDifference(timeDiff, "elapsed");
      }

      userGameDivs.eq(i).find(".user-activity-timestamp").text(formattedTime);
    }
  }
}

// Function to format time difference
function formatTimeDifference(timeDiff, label) {
  if (timeDiff < 0) {
    timeDiff = 0;
    setTimeout(updateActivities, 500);
  }
  let hours = Math.floor(timeDiff / 3600000);
  let minutes = Math.floor((timeDiff % 3600000) / 60000);
  let seconds = Math.floor((timeDiff % 60000) / 1000);

  let formattedTime =
    (hours > 0 ? hours + ":" : "") +
    (minutes < 10 ? "0" : "") +
    minutes +
    (seconds < 10 ? ":0" : ":") +
    seconds +
    " " +
    label;

  return formattedTime;
}

//hide image on error loading
document.addEventListener("DOMContentLoaded", function (event) {
  document.querySelectorAll("img").forEach(function (img) {
    img.onerror = function () {
      this.style.display = "none";
    };
  });
});
