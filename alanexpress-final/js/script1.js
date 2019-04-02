
              // This is called with the results from from FB.getLoginStatus().
              function statusChangeCallback(response) {
                console.log('statusChangeCallback');
                console.log(response);
                // The response object is returned with a status field that lets the
                // app know the current login status of the person.
                // Full docs on the response object can be found in the documentation
                // for FB.getLoginStatus().
                if (response.status === 'connected') {
                  // Logged into your app and Facebook.
                  testAPI();
                  // window.location.assign("/alanexpress-final/list-view-restaurant.php?user=dsds&email=dsds");
                } else {
                  // The person is not logged into your app or we are unable to tell.
                  document.getElementById('status').innerHTML = 'Please log ' +
                    'into this app.';
                }
              }
            
              // This function is called when someone finishes with the Login
              // Button.  See the onlogin handler attached to it in the sample
              // code below.
              function checkLoginState() {
                FB.getLoginStatus(function(response) {
                  statusChangeCallback(response);
                });
              }
            
              window.fbAsyncInit = function() {
                FB.init({
                  appId      : '408631019927365' , 
                  cookie     : true,  // enable cookies to allow the server to access 
                                      // the session
                  xfbml      : true,  // parse social plugins on this page
                  version    : 'v3.2' // The Graph API version to use for the call
                });
            
                // Now that we've initialized the JavaScript SDK, we call 
                // FB.getLoginStatus().  This function gets the state of the
                // person visiting this page and can return one of three states to
                // the callback you provide.  They can be:
                //
                // 1. Logged into your app ('connected')
                // 2. Logged into Facebook, but not your app ('not_authorized')
                // 3. Not logged into Facebook and can't tell if they are logged into
                //    your app or not.
                //
                // These three cases are handled in the callback function.
            
                FB.getLoginStatus(function(response) {
                  statusChangeCallback(response);
                });
            
              };
            
              // Load the SDK asynchronously
              (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "https://connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
              }(document, 'script', 'facebook-jssdk'));
            
              // Here we run a very simple test of the Graph API after login is
              // successful.  See statusChangeCallback() for when this call is made.
              function testAPI() {
                console.log('Welcome!  Fetching your information.... ');
                FB.api('/me?fields=id,email,name', function(response) {
                  console.log('Successful login for: ' + response.name);
                  document.getElementById('status').innerHTML =
                    'Thanks for logging in, ' + response.name + ' '+response.email +'!'; 
                    // '<%Session["user"] = "' + response.name + '"; %>'
                    
                    addUser(response.name, response.email);
                    // window.location.assign("/alanexpress-final/list-view-restaurant.php?user="+response.name+"&email="+response.email);
                   
                    //  window.location.replace("restaraunt-view.php");
                });
              }

              // function getUser(name,email){
              //   var getUserURL = "http://SMUImage:8082/users1/"+name;
              //   $.get(getUserURL, function (data) {
              //     var username = data.username; //the arr is in data.Order of the JSON
      
              // }) // $.get
              //     .fail(function () {
              //       addUser(name, email);
              //     })
              //   // window.location.assign("/alanexpress-final/list-view-restaurant.php?user="+name);
              // }

            function addUser(name, email) {
              
                $.ajaxSetup({
                  headers:{
                      'Content-Type':"application/json"
                  }
              });
                  
              $.post("http://SMUImage:8082/users1",
                      JSON.stringify(
                      {
                          "username": ""+name+"",
                          "password": ""+name+"",
                          "usertype": "customer",
                          "gender": "male",
                          "email": ""+email+"",
                          "longitude": "103.84981790000006",
                          "latitude": "1.294667"
                      }) 
              // ,function(data, status){
              //     alert ("Data: "+data+ "\nStatus: "+status);
              //     // window.location.replace("/alanexpress-final/list-view-restaurant.php?user="+response.name+"&gender=male");
              // }
              );

              // window.location.assign("/alanexpress-final/list-view-restaurant.php?user="+name+"&email="+email);
              setTimeout(function () {
                //Redirect with JavaScript
                window.location.href= 'http://localhost/alanexpress-final/list-view-restaurant.php?user='+name+"&gender=male";
             }, 2000);
              
              }
            
            
          
            //   Below we include the Login Button social plugin. This button uses
            //   the JavaScript SDK to present a graphical Login button that triggers
            //   the FB.login() function when clicked.
            // -->

         //NOTE HEREEEE: CODE THAT IS BELOW THIS LINE IS A THE BUTTON FOR THE LOGIN PAGE 
            // <script src='script1.js' type='text/javascript'></script> 
           // <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
            // </fb:login-button>
            
            // <div id="status">
            // </div> 
