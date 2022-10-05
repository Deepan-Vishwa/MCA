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
                    password: password
                },
                success: function (data) {

                    if (data === '1') {

                        window.location.href = "main.php";

                    } else {
                        alert(data)
                    }

                }


            });

        } else {
            alert("Empty Field")
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
                    neck:n,
                    
                    health: JSON.stringify(d)
                },
                success: function (data) {

                    if (data === '1') {

                        alert("done");
                        $('#checkinform input[type="number"]').val('');

                    } else {
                        alert(data);
                        $('#checkinform input[type="number"]').val('');
                    }

                }



        });










        
        

    });






    function fatcal(height, weight, waist, hip, neck, gender) {






        var health_data = {};

        if (gender == "male") {

            health_data.bodyfat = Math.round(495 / (1.0324 - .19077 * Math.log10(waist - neck) + .15456 * Math.log10(height)) - 450);
            health_data.fatmass = Math.round((health_data.bodyfat/100)*weight);
            health_data.leanmass = Math.round((weight - health_data.fatmass));
        } else {
            health_data.bodyfat = Math.round(495 / (1.29579 - .35004 * Math.log10(waist + hip - neck) + .22100 * Math.log10(height)) - 450);
            health_data.fatmass = Math.round((health_data.bodyfat/100)*weight);
            health_data.leanmass = Math.round((weight - health_data.fatmass));
        }









         return health_data;



    }

    // fatcal(168,59,81,0,30,"male");

});