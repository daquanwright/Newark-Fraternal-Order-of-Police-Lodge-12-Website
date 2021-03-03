//Google Sign in
function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
  }

//   function getCookie(cname) {
//     var name = cname + "=";
//     var decodedCookie = decodeURIComponent(document.cookie);
//     var ca = decodedCookie.split(';');
//     for(var i = 0; i <ca.length; i++) {
//       var c = ca[i];
//       while (c.charAt(0) == ' ') {
//         c = c.substring(1);
//       }
//       if (c.indexOf(name) == 0) {
//         return c.substring(name.length, c.length);
//       }
//     }
//     return "";
//   }

//   function police() {
//     $.ajax({
//         url: "questionBank.html", 
//         context: document.body,
//         success: function(response) {
//             $("#subBody").html(response);
//             document.getElementById("welcStr").innerHTML = "Welcome "+getCookie("quizyUser");
//             questionUpdate('populateQus(this)');
//         }
//     });
// }

// function memeber() {
//     document.getElementById("welcStr").innerHTML = "Welcome "+getCookie("quizyUser");
//     examTaker();
// }



function checkLoginState() {
  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}