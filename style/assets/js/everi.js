
  $(document).ready(function(){

    $('#email').focusout(function(){
      email_validate();
    });

    function email_validate() {

      var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
      var email = $('#email').val();

      if(email !== '') {
        if(pattern.test(email)) {
        $('#lbl').css('color','green');
        $('#email').css('border','2px solid green');
        $('#success').css('display','block');
        $('#error').css('display','none');
        $('#span1').css('display','none');
        $('#span2').css('display','none');
        $('#warning').css('display','none');
        }
        else {
        $('#lbl').css('color','red');
        $('#email').css('border','2px solid red');
        $('#error').css('display','block');
        $('#success').css('display','none');
        $('#span1').css('display','block');
        $('#span2').css('display','none');
        $('#warning').css('display','none');
        }
      }
      else {
        $('#span2').css('display','block');
        $('#lbl').css('color','red');
        $('#email').css('border','2px solid red');
        $('#error').css('display','none');
        $('#success').css('display','none');
        $('#warning').css('display','block');
        $('#span1').css('display','none');
      }
    }
  });
