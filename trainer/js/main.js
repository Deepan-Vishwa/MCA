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
            alert("Unable to Process the request");
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
            alert("Unable to Process the request");
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
            alert("Invalid Username or Password");
          }
        },
      });
    } else {
      alert("Empty Field");
    }
  });

  $("#tdc_button").click(function () {

    var tdc = $("#tdc").val().trim();
    var clid = $(this).data("clid");

    console.log(tdc);
    console.log(clid);
    $.ajax({
      type: "POST",
      url: "insert_tdc.php",
      async: false,
      data:{

        clid:clid,
        tdc:tdc

      },
      success: function (data) {

        if(data === "1"){
          alert("Total Diet Calories Updated Successfully");
        }
        else{
          alert("Unable to Process the request");
        }
        
      },
    });




  });

  $(".client_card").click(function () {
    var i=$(this).data("cid");

if($(this).hasClass( "bg-danger" )){

 
    $.ajax({
      type: "POST",
      url: "update_status.php",
      async: false,
      data:{

        cid:i

      },
      success: function (data) {
        
      },
    });
  }



  });



});
