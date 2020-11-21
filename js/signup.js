function checkPassword(form) {
  Password = document.getElementById("Password").value;
  ConfirmPassword = document.getElementById("ConfirmPassword").value;

  // If password not entered
  if (Password == "") {
    alert("Please Enter Password");
  }
  // If confirm password not entered
  else if (ConfirmPassword == "") {
    alert("Please Enter Confirm Password");
    return false;
  }

  // If Not same return False.
  else if (Password != ConfirmPassword) {
    alert("\n Password did not match: Please try again...");
    return false;
  }
}
