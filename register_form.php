<?php date_default_timezone_set('Asia/Kolkata'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</head>
<body style="background-image: url(assets/sand_black_relief_133792_3840x2160.jpg);


height: 100%; 


background-position: center;
background-repeat: repeat;
background-size: cover;">

  <div class="container-fluid w-75">
    <div class="card mt-5 mb-5">
      <div class="card-header bg-dark text-light">
        Registration
      </div>
      <div class="card-body">
        <form class="row g-3" action="register.php" method="post" id="reg">
          <h3>General Details</h3>
          <div class="col-md-6">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="name" required>
          </div>
          <div class="col-md-6">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="emaill" value="<?php echo $_GET['email_id'];  ?>" id="emaill" disabled>
            <input type="email" class="form-control" name="email" value="<?php echo $_GET['email_id'];  ?>" id="email" hidden>
          </div>
          <div class="col-md-6">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Phone Number</label>
            <input type="number" class="form-control" name="contact" id="contact" required>
            <input type="number" class="form-control" name="trainer" value="<?php echo $_GET['trainer'];  ?>" id="trainer" hidden>
          </div>
          <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Dob</label>
            <input type="date" class="form-control" name="dob" id="dob" required>
          </div>
          <div class="col-md-6">
            <label for="gender" class="form-label">Gender</label>
           <div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="gender1" value="male" required>
              <label class="form-check-label" for="inlineRadio1">Male</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="gender" id="gender2" value="female" required>
              <label class="form-check-label" for="inlineRadio2">Female</label>
            </div>
           </div>
          </div>
          <div class="col-12">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" required>
          </div>
          <hr>
          <h3>Measurements</h3>

          <div class="card">
            <div class="card-body">
              <p>You'll only need a measuring tape. Then, start taking measurements:</p>
                <ol>
                    <li><strong>Height</strong> - make sure you stand up straight and barefoot.</li>
                    <li><strong>Neck</strong> - the circumference should be measured just underneath the larynx (Adam's apple).</li>
                    <li><strong>Waist</strong> - should be measured horizontally, around the narrowest part of the abdomen for women and at the at the navel level for men.</li>
                    <li><strong>Hips</strong> - should be measured at the widest part of the buttocks or hip.</li>
                </ol>
            </div>
          </div>

          

          <div class="col-md-4">
            <label for="height" class="form-label">Height in cm</label>
            <input type="number" name="height" class="form-control" id="height" required>
          </div>
          <div class="col-md-4">
            <label for="weight" class="form-label">Weight in Kg</label>
            <input type="number" class="form-control" name="weight" id="weight" required>
          </div>
          <div class="col-md-4">
            <label for="waist" class="form-label">Waist in cm</label>
            <input type="number" class="form-control" name="waist" id="waist" required>
          </div>
          <div class="col-md-6">
            <label for="hip" class="form-label">Hip in cm</label>
            <input type="number" class="form-control" name="hip" id="hip" required>
          </div>
          <div class="col-md-6">
            <label for="neck" class="form-label">Neck in cm</label>
            <input type="number" class="form-control" name="neck" id="neck" required>
            <input type="number" class="form-control" name="bmr" id="bmr" hidden>
            <input type="number" class="form-control" name="tdee" id="tdee" hidden>
            <input type="number" class="form-control" name="bodyfat" id="bodyfat" hidden>
            <input type="number" class="form-control" name="leanmass" id="leanmass" hidden>
            <input type="text" class="form-control" value="<?php echo date('Y-m-d'); ?>" name="to_date" id="to_date" hidden>
          </div>

          <hr>
          <h3>Other Details</h3>

          <div class="col-md-3">
            <label for="alcohol" class="form-label">Will You Drink alcohol ?</label>
            <div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="alcohol" id="alcohol1" value="yes" required>
                <label class="form-check-label" for="inlineRadio1">Yes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="alcohol" id="alcohol2" value="no" required>
                <label class="form-check-label" for="inlineRadio2">No</label>
              </div>
             </div>
          </div>
          <div class="col-md-3">
            <label for="smoke" class="form-label">Will You Smoke ?</label>
            <div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="smoke" id="smoke1" value="yes" required>
                <label class="form-check-label" for="inlineRadio1">Yes</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="smoke" id="smoke2" value="no" required>
                <label class="form-check-label" for="inlineRadio2">No</label>
              </div>
             </div>
          </div>
          <div class="col-md-6">
            <label for="activity_level" class="form-label">Activity Level</label>
            <select class="form-select" name="activity_level" id="activity" aria-label="Default select example" required>
             
              <option value="1.2">Sedentary (little to no exercise + work a desk job)</option>
              <option value="1.375">Lightly Active (light exercise 1-3 days / week)</option>
              <option value="1.55">Moderately Active (moderate exercise 3-5 days / week) </option>
              <option value="1.725">Very Active (heavy exercise 6-7 days / week)</option>
              <option value="1.9">Extremely Active (very heavy exercise, hard labor job, training 2x / day) </option>
            </select>
          </div>

          <div class="col-md-4">
            <label for="goal" class="form-label">Goal</label>
            <select class="form-select" name="goal" aria-label="Default select example" required>
             
              <option value="Fat Loss">Fat Loss</option>
              <option value="Weight Gain">Weight Gain</option>
              
            </select>
          </div>
          <div class="col-md-4">
            <label for="profession" class="form-label">Profession</label>
            <input type="text" class="form-control" name="profession" id="profession" required>
          </div>
          <div class="col-md-4">
            <label for="meal_type" class="form-label">Meal type</label>
            <select class="form-select" name="meal_type" id="meal_type" aria-label="Default select example" required>
             
              <option value="1">veg</option>
              <option value="1">Non-veg</option>
              
            </select>
          </div>

          <div class="col-md-12">
            <label for="medical" class="form-label">Any Medical Issues ?</label>
            <div class="form-floating">
              <textarea class="form-control" name="medical" id="medical"></textarea>
             
            </div>
          </div>

          <hr>
          <h3>Payment</h3>

          <div class="col-md-12">
            <label for="inputPassword4" class="form-label">Subscription</label>
            <select class="form-select" name="payment" id="payment" aria-label="Default select example">
             
              <option value="1">1 month - Rs 2000</option>
              <option value="3">3 month - Rs 6000</option>
              <option value="6">6 month - Rs 10000 </option>
              <option value="12">12 month - Rs 13000</option>
            </select>
          </div>


         
          
          
          <div class="col-12">
            <button type="button" id="register" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
  <script>

$(document).ready(function () {


  function fatcal(height, weight, waist, hip, neck, gender, ac, dob) {

var d = new Date(dob);
var today = new Date();
var age = Math.floor((today - d) / (365.25 * 24 * 60 * 60 * 1000));

// console.log(age);
// console.log(ac);




if (gender == "male") {

  var bo = Math.round(495 / (1.0324 - 0.19077 * Math.log10(waist - neck) + 0.15456 * Math.log10(height)) - 450);

  $("#bodyfat").val(bo);
  var fatmass = Math.round((bo / 100) * weight);
  $("#leanmass").val(Math.round(weight - fatmass));
  var b = Math.round(66 + (13.7 * weight) + (5 * height) - (6.8 * parseInt(age)));
  $("#bmr").val(b);
  $("#tdee").val(ac * b);
  console.log("male");

} else {
  var bo = Math.round(495 / (1.29579 - 0.35004 * Math.log10(waist + hip - neck) + 0.221 * Math.log10(height)) - 450);
  $("#bodyfat").val(bo);
  var fatmass = Math.round((bo / 100) * weight);
  $("#leanmass").val(Math.round(weight - fatmass));
  var b = Math.round(655 + (9.6 * weight) + (1.8 * height) - (4.7 * parseInt(age)));
  $("#bmr").val(b);
  $("#tdee").val(Math.round(ac * b));
  console.log("female");

}


}

$("#register").click(function () {
  $.validator.messages.required = '';

 
  
  // $("#reg").validate();
  // $('#reg').submit();
 
  if($("#reg").valid()){
    var h = parseInt($("#height").val().trim());
    var w = parseInt($("#weight").val().trim());
    var wa = parseInt($("#waist").val().trim());
    var hi = parseInt($("#hip").val().trim());
    var n = parseInt($("#neck").val().trim());
    var g = String($('input[name="gender"]:checked').val().trim());
    var activity = parseFloat($("#activity").find(":selected").val().trim());
    var dob = $("#dob").val().trim();

    fatcal(h, w, wa, hi, n, g, activity, dob);

    $('#reg').submit();
  }
  else{
    alert("fill all fields")
  }

  

});
});
  </script>
  
</body>
</html>