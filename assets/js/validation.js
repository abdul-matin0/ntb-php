// validate login and signup forms
function signupformValidation(){
    var errors = [];

    var name = document.forms["form-signup"]["name"].value;
    var uID = document.forms["form-signup"]["uID"].value;

    //trim values
    if(name.trim() == ""){
      errors.push("Enter your Name ");
      document.getElementById("error-name").innerHTML = "Name Missing";
    }
    if(uID.trim() == ""){
      errors.push("Enter User ID ");
      document.getElementById("error-uID").innerHTML = "User ID Missing";
    }

    //if there are errors display error message
    if(!errors.length == 0){

      // alert(errors);
      return false;
    }
  }

  function loginformValidation(){
      var errors = [];

    var uID = document.forms["form-login"]["uID"].value;

    //trim values
    if(uID.trim() == ""){
      errors.push("Enter User ID ");
      document.getElementById("error-luID").innerHTML = "User ID Missing";
    }

    //if there are errors display error message
    if(!errors.length == 0){

      // alert(errors);
      return false;
    }
  }