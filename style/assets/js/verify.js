
    $(function() {

       $("#fname_error_message").hide();
       $("#sname_error_message").hide();
       $("#password_error_message").hide();
       $("#retype_password_error_message").hide();

       var error_fname = false;
       var error_sname = false;
       var error_password = false;
       var error_retype_password = false;

       $("#form_fname").focusout(function(){
          check_fname();
       });
       $("#form_sname").focusout(function() {
          check_sname();
       });
       $("#form_password").focusout(function() {
          check_password();
       });
       $("#form_retype_password").focusout(function() {
          check_retype_password();
       });

       function check_fname() {
          var pattern = /^[a-zA-Z]*$/;
          var fname = $("#form_fname").val();
          if (pattern.test(fname) && fname !== '') {
             $("#fname_error_message").hide();
             $("#form_fname").css("border-bottom","2px solid #34F458");
          } else {
             $("#fname_error_message").html("Should contain only Characters");
             $("#fname_error_message").show();
             $("#form_fname").css("border-bottom","2px solid #F90A0A");
             error_fname = true;
          }
       }

       function check_sname() {
          var pattern = /^[a-zA-Z]*$/;
          var sname = $("#form_sname").val()
          if (pattern.test(sname) && sname !== '') {
             $("#sname_error_message").hide();
             $("#form_sname").css("border-bottom","2px solid #34F458");
          } else {
             $("#sname_error_message").html("Should contain only Characters");
             $("#sname_error_message").show();
             $("#form_sname").css("border-bottom","2px solid #F90A0A");
             error_fname = true;
          }
       }

       function check_password() {
          var password_length = $("#form_password").val().length;
          if (password_length < 8) {
             $("#password_error_message").html("Atleast 8 Characters");
             $("#password_error_message").show();
             $("#form_password").css("border-bottom","2px solid #F90A0A");
             error_password = true;
          } else {
             $("#password_error_message").hide();
             $("#form_password").css("border-bottom","2px solid #34F458");
          }
       }

       function check_retype_password() {
          var password = $("#form_password").val();
          var retype_password = $("#form_retype_password").val();
          if (password !== retype_password) {
             $("#retype_password_error_message").html("Passwords Did not match");
             $("#retype_password_error_message").show();
             $("#form_retype_password").css("border-bottom","2px solid #F90A0A");
             error_retype_password = true;
          } else {
             $("#retype_password_error_message").hide();
             $("#form_retype_password").css("border-bottom","2px solid #34F458");
          }
       }

       function check_phone() {
          var phone = $("#form_phone").val().length;
          if (phone !== 11) {
             $("#form_phone_error_message").html("The phone number should NOT be less than 11 numbers");
             $("#form_phone_error_message").show();
             $("#form_phone").css("border-bottom","2px solid #F90A0A");
             error_phone = true;
          } else {
             $("#form_phone_error_message").hide();
             $("#form_phone").css("border-bottom","2px solid #34F458");
          }
       }

       $("#registration_form").submit(function() {
          error_fname = false;
          error_sname = false;
          error_password = false;
          error_retype_password = false;
          error_phone = false;

          check_fname();
          check_sname();
          check_password();
          check_retype_password();
          check_phone();

          if (error_fname === false && error_sname === false && error_password === false && error_retype_password === false && error_phone === false) {
             alert("Registration Successful!");
             return true;
          } else {
             alert("Please Fill the form Correctly");
             return false;
          }


       });
    });
