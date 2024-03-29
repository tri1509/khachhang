$(document).ready(function () {
  $(".nav-link.active .sub-menu").slideDown();
  $("#sidebar-menu .arrow").click(function () {
    $(this).parents("li").children(".sub-menu").slideToggle();
    $(this).toggleClass("fa-angle-right fa-angle-down");
  });
  $("input[name='checkall']").click(function () {
    var checked = $(this).is(":checked");
    $(".table-checkall tbody tr td input:checkbox").prop("checked", checked);
  });

  $("#password, #password_2").on("keyup", function () {
    if ($("#password").val() == $("#password_2").val()) {
      $("#add-user").removeAttr("disabled");
    } else {
      $("#add-user").attr("disabled", "disabled");
    }
  });

  // KHÁCH HÀNG THIẾT KẾ WEBSITE TẠI NINA
  $("#project .items").slice(0, 6).show();
  $("#load-page").on("click", function (e) {
    e.preventDefault();
    $("#project .items:hidden").slice(0, 3).slideDown();
    if ($("#project .items:hidden").length == 0) {
      $(".loading-page").fadeOut("slow");
    }
  });

  // table-admin
  $("#table-admin").DataTable({
    destroy: true,
    dom: "lBfrtip",
    bFilter: true,
    aLengthMenu: [
      [50, 100, 200, -1],
      [50, 100, 200, "All"],
    ],
  });

  // VỀ ĐẦU TRANG
  var offset = 500;
  var duration = 100;
  $(window).scroll(function () {
    if ($(this).scrollTop() > offset) $("#top-up").fadeIn(duration);
    else $("#top-up").fadeOut(duration);
  });
  $("#top-up").click(function () {
    $("body,html").animate(
      {
        scrollTop: 0,
      },
      duration
    );
  });

  // BẢNG BÁO GIÁ THIẾT KẾ WEBSITE TRỌN GÓI

  $("body").on("click", ".list-package li", function (event) {
    event.preventDefault();
    var o = $(this);
    var r = o.attr("rel");
    $(".list-package li").removeClass("active");
    o.addClass("active");

    $(".content-package").removeClass("active");
    $("#" + r).addClass("active");
  });

  // QUY TRÌNH THIẾT KẾ WEBSITE TẠI NINA

  var ix = 1;
  setInterval(function () {
    var step = ".step" + ix;
    $(".design-img img").removeClass("active");
    $(step + " img").addClass("active");
    ix++;
    if (ix == 6) {
      ix = 1;
    }
  }, 1000);
  ("use strict");

  // LOADER
  $(".loader").delay(700).fadeOut("slow");
  $("#untree_co--overlayer").delay(700).fadeOut("slow");

  // ACTIVE ĐƯỜNG DẪN
  var path = window.location.href;
  $("#sidebar-menu .sub-menu li a").each(function () {
    if (this.href === path) {
      $(this).addClass("text-primary");
    }
  });

  // COPPY

  $(".copy").tooltip({ animation: true, trigger: "manual", title: "Đã copy" });
  $(".copy")
    .click(function () {
      text = $(this).text();
      $(this).tooltip("show");
      if (!navigator.clipboard) {
        fallbackCopyTextToClipboard(text);
        return;
      }
      navigator.clipboard.writeText(text).then(
        function () {
          console.log("Async: Copying to clipboard was successful!");
        },
        function (err) {
          console.error("Async: Could not copy text: ", err);
        }
      );
    })
    .mouseout(function () {
      $(this).tooltip("hide");
    });
  function fallbackCopyTextToClipboard(text) {
    var textArea = document.createElement("textarea");
    textArea.value = text;
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    try {
      var successful = document.execCommand("copy");
      var msg = successful ? "successful" : "unsuccessful";
      console.log("Fallback: Copying text command was " + msg);
    } catch (err) {
      console.error("Fallback: Oops, unable to copy", err);
    }
    document.body.removeChild(textArea);
  }
  loading = 0;
});
