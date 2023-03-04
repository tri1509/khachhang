$(document).ready(function () {
  $(".nav-link.active .sub-menu").slideDown();
  $("p").slideUp();
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

  jQuery("#mainSlider").nivoSlider({
    directionNav: false,
    animSpeed: 500,
    effect: "random",
    slices: 18,
    pauseTime: 5000,
    pauseOnHover: false,
    controlNav: false,
  });

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

  $("body").on("click", ".list-package li", function (event) {
    event.preventDefault();
    var o = $(this);
    var r = o.attr("rel");
    $(".list-package li").removeClass("active");
    o.addClass("active");

    $(".content-package").removeClass("active");
    $("#" + r).addClass("active");
  });
});
