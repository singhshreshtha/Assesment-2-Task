<?php
session_start();

function is_user_logged_in(){
    // return true if user is already logged in
    // otherwise return false
    if (isset($_SESSION['isUserLoggedIn']) and $_SESSION['isUserLoggedIn']) {
      return true;
    }
    return false;
    
}

function make_user_session($userdata){
    // set user details in session
  while ($row = mysqli_fetch_array($userdata)) {
        $_SESSION['isUserLoggedIn'] = true;
        $_SESSION['username'] = $row['name'];
     }
    // echo $_SESSION['isUserLoggedIn'];
    // echo $_SESSION['username'];
}

function destroy_user_session(){
    // destroy session and redirect to login page
   session_destroy();
   session_start();
}

?>