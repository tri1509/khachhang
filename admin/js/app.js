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

  $("#table-admin").DataTable();

  $("#password, #password_2").on("keyup", function () {
    if ($("#password").val() == $("#password_2").val()) {
      $("#add-user").removeAttr("disabled");
    } else {
      $("#add-user").attr("disabled", "disabled");
    }
  });
  $("#project .items").slice(0, 3).show();
  $("#load-page").on("click", function (e) {
    e.preventDefault();
    $("#project .items:hidden").slice(0, 3).slideDown();
    if ($("#project .items:hidden").length == 0) {
      $(".loading-page").fadeOut("slow");
    }
  });
  var offset = 500;
  var duration = 700;
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
});
