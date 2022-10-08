$(document).ready(function () {
  function remove_diet() {
    $(".first").on("click", ".red", function () {
      $(this).prop("disabled", true);
      $(this).children().eq(1).attr("hidden", true);

      $(this).children().eq(0).removeAttr("hidden");

      var div = $(this).closest("tr");

      $.ajax({
        type: "POST",
        url: "delete_diet.php",
        data: {
          id: $(this).val(),
        },
        success: function (data) {
          if (data === "1") {
            div.remove();
          } else {
            alert(data);
          }
        },
      });
    });
  }
  remove_diet();
  $(".add_diet").click(function () {
    if (
      ($(this).parent().siblings().eq(0).children().val(),
      $(this).parent().siblings().eq(1).children().val() == "")
    ) {
      alert("Invalid");
    } else {
      $(this).prop("disabled", true);
      $(this).children().eq(1).attr("hidden", true);
      $(this).children().eq(0).attr("hidden", false);
      var t = $(this);

      var food = $(this).parent().siblings().eq(0).children().val();
      var quantity = $(this).parent().siblings().eq(1).children().val();
      var id = $(this).val();

      var divv = $(this).parents().eq(2).siblings();
      console.log($(this).parents().eq(2).siblings());
      var client_id = $("#client_id").val();

      $.ajax({
        type: "POST",
        url: "insert_diet.php",
        data: {
          id: id,
          food: food,
          quantity: quantity,
          client_id:client_id
        },
        success: function (data) {
          divv.append(
            `<tr>
                            <td>` +
              food +
              `</td>
                            <td>` +
              quantity +
              `</td>
                            
                            <td>
                            <button type="button" name="remove" value="` +
              data +
              `" class="btn btn-danger red">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                        <span><i class="fa-solid fa-trash" style="font-size: 0.73em;"></i></span>
                        </button>

                </td></tr>`
          );

          t.prop("disabled", false);
          t.children().eq(1).attr("hidden", false);
          t.children().eq(0).attr("hidden", true);
        },
      });

      //$(this).parents().eq(2).siblings().after('<tr><td>'+food+'</td><td>'+quantity+'</td><td><button type="button" name= "remove" class="btn btn-danger red">X</button></td></tr>');
      remove_diet();
      //   $("input[name=food], input[name=quantity]").val("");
      $(
        $(this).parent().siblings().eq(0).children().val(""),
        $(this).parent().siblings().eq(1).children().val("")
      );
    }
  });

  function remove_workout() {
    $(".first").on("click", ".red2", function () {
      $(this).prop("disabled", true);

      $(this).children().eq(1).attr("hidden", true);

      $(this).children().eq(0).removeAttr("hidden");

      var div = $(this).closest("tr");

      $.ajax({
        type: "POST",
        url: "delete_workout.php",
        data: {
          id: $(this).val(),
        },
        success: function (data) {
          if (data === "1") {
            div.remove();
          } else {
            alert(data);
          }
        },
      });
    });
  }
  remove_workout();
  $(".add_workout").click(function () {
    if (
      ($(this).parent().siblings().eq(0).children().val(),
      $(this).parent().siblings().eq(1).children().val(),
      $(this).parent().siblings().eq(2).children().val() == "")
    ) {
      alert("Invalid");
    } else {
      $(this).prop("disabled", true);
      $(this).children().eq(1).attr("hidden", true);
      $(this).children().eq(0).attr("hidden", false);
      var t = $(this);
      var idw = $(this).val();

      var workout = $(this).parent().siblings().eq(0).children().val();
      var sets = $(this).parent().siblings().eq(1).children().val();
      var rep = $(this).parent().siblings().eq(2).children().val();
      var divv = $(this).parents().eq(2).siblings();
      var client_id = $("#client_id").val();

      $.ajax({
        type: "POST",
        url: "insert_workout.php",
        data: {
            idw: idw,
            workout: workout,
            sets: sets,
            rep:rep,
            client_id:client_id
        },
        success: function (data) {

           

          divv.append(
            `<tr>
                <td>`+workout +`</td>
                <td>`+sets +`</td>
                <td>`+rep +`</td>
                        
                        <td>
                        <button type="button" name="remove" value="` +
              data +
              `" class="btn btn-danger red2">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" hidden></span>
                    <span><i class="fa-solid fa-trash" style="font-size: 0.73em;"></i></span>
                    </button>

            </td></tr>`
          );

          t.prop("disabled", false);
          t.children().eq(1).attr("hidden", false);
          t.children().eq(0).attr("hidden", true);
        },
      });

      //$(this).parents().eq(2).siblings().after('<tr><td>'+workout+'</td><td>'+sets+'</td><td>'+rep+'</td><td><button type="button" name= "remove" class="btn btn-danger red2">X</button></td></tr>');
      remove_workout();
      //   $("input[name=food], input[name=quantity]").val("");
      $(
        $(this).parent().siblings().eq(0).children().val(""),
        $(this).parent().siblings().eq(1).children().val(""),
        $(this).parent().siblings().eq(2).children().val("")
      );
    }
  });

  //console.log(Math.round(495 / (1.29579 - .35004 * Math.log10(29 * 2.54 + 38 * 2.54 - 12 * 2.54) + .22100 * Math.log10(66 * 2.54)) - 450));

  $("#login-btn").click(function () {
    var email = $("#email").val().trim();
    var password = $("#password").val().trim();

    if (email != "" && password != "") {
      $.ajax({
        type: "POST",
        url: "loginval.php",
        data: {
          email: email,
          password: password,
        },
        success: function (data) {
          if (data === "1") {
            window.location.href = "main.php";
          } else {
            alert(data);
          }
        },
      });
    } else {
      alert("Empty Field");
    }
  });

  $("#checkin_submit").click(function () {
    var h = parseInt($("#height").val().trim());
    var w = parseInt($("#weight").val().trim());
    var wa = parseInt($("#waist").val().trim());
    var hi = parseInt($("#hip").val().trim());
    var n = parseInt($("#neck").val().trim());
    var g = String($("#gender").val().trim());
    var d = fatcal(h, w, wa, hi, n, g);

    console.log(d);

    $.ajax({
      type: "POST",
      url: "checkin_entry.php",
      data: {
        height: h,
        weight: w,
        waist: wa,
        hip: hi,
        neck: n,

        health: JSON.stringify(d),
      },
      success: function (data) {
        if (data === "1") {
          alert("done");
          $('#checkinform input[type="number"]').val("");
        } else {
          alert(data);
          $('#checkinform input[type="number"]').val("");
        }
      },
    });
  });

  function fatcal(height, weight, waist, hip, neck, gender) {
    var health_data = {};

    if (gender == "male") {
      health_data.bodyfat = Math.round(
        495 /
          (1.0324 -
            0.19077 * Math.log10(waist - neck) +
            0.15456 * Math.log10(height)) -
          450
      );
      health_data.fatmass = Math.round((health_data.bodyfat / 100) * weight);
      health_data.leanmass = Math.round(weight - health_data.fatmass);
    } else {
      health_data.bodyfat = Math.round(
        495 /
          (1.29579 -
            0.35004 * Math.log10(waist + hip - neck) +
            0.221 * Math.log10(height)) -
          450
      );
      health_data.fatmass = Math.round((health_data.bodyfat / 100) * weight);
      health_data.leanmass = Math.round(weight - health_data.fatmass);
    }

    return health_data;
  }

  // fatcal(168,59,81,0,30,"male");
});
