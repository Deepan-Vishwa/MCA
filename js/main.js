$(document).ready(function () {
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
    var activity = parseFloat($("#activity").val().trim());
    var dob = $("#dob").val().trim();
    var d = fatcal(h, w, wa, hi, n, g, activity, dob);

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

  function fatcal(height, weight, waist, hip, neck, gender, ac, dob) {

    var d = new Date(dob);
    var today = new Date();
    var age = Math.floor((today - d) / (365.25 * 24 * 60 * 60 * 1000));

    // console.log(age);
    // console.log(ac);
    

    var health_data = {};

    if (gender == "Male") {
      health_data.bodyfat = Math.round(495 / (1.0324 - 0.19077 * Math.log10(waist - neck) + 0.15456 * Math.log10(height)) - 450);
      health_data.fatmass = Math.round((health_data.bodyfat / 100) * weight);
      health_data.leanmass = Math.round(weight - health_data.fatmass);
      health_data.bmr = Math.round(66 + (13.7 * weight) + (5 * height) - (6.8 * parseInt(age)));
      health_data.tdee = ac * health_data.bmr;
      console.log("male");

    } else {
      health_data.bodyfat = Math.round(495 / (1.29579 - 0.35004 * Math.log10(waist + hip - neck) + 0.221 * Math.log10(height)) - 450);
      health_data.fatmass = Math.round((health_data.bodyfat / 100) * weight);
      health_data.leanmass = Math.round(weight - health_data.fatmass);
      health_data.bmr = Math.round(655 + (9.6 * weight) + (1.8 * height) - (4.7 * parseInt(age)));
      health_data.tdee = Math.round(ac * health_data.bmr);
      console.log("female");

    }

    return health_data;
  }

  // fatcal(168,59,81,0,30,"male");


  
            $("#pay").click(function() {
                console.log("object");

                var sub = $("#payment").val().trim();


                $.ajax({
                    type: "POST",
                    url: "insert_payment.php",
                    data: {
                        sub_type: sub

                    },
                    success: function(data) {
                        if (data === "1") {
                            alert("done");

                        } else {
                            alert(data);

                        }
                    },
                });
            });
});