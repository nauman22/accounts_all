<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>panel</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/Nunito.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/untitled.css">
    <link rel="stylesheet" href="../assets/css/visionae-reset-password-Login-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/visionae-reset-password.css">
    <style>
    .container {
        width: 302px;
        height: 175px;
        position: absolute;
        left: 0px;
        right: 0px;
        top: 0px;
        bottom: 0px;
        margin: auto;
    }
    #number, #verificationcode {
        width: calc(100% - 24px);
        padding: 10px;
        font-size: 20px;
        margin-bottom: 5px;
        outline: none;
    }
    #recaptcha-container {
        margin-bottom: 5px;
    }
    #send, #verify {
        width: 100%;
        height: 40px;
        outline: none;
    }
    .p-conf, .n-conf {
        width: calc(100% - 22px);
        border: 2px solid green;
        border-radius: 4px;
        padding: 8px 10px;
        margin: 4px 0px;
        background-color: rgba(0, 249, 12, 0.5);
        display: none;
    }
    .n-conf {
        border-color: red;
        background-color: rgba(255, 0, 4, 0.5);
    }
</style>
</head>

<body>
    <div id="block-reset" class="login-clean">
        <form id="form-reset" method="post">
            <h2 class="visually-hidden">Login Form</h2>
            <h3 class="text-center"><img src="../assets/img/Transparent%20logo.png" width="216px"></h3>
        <div id="sender">
            <input type="text" id="number" placeholder="+923...">
            <div id="recaptcha-container"></div>
            <input type="button" id="send" value="Send" onClick="phoneAuth()">
        </div>
        <div id="verifier" style="display: none">
            <input type="text" id="verificationcode" placeholder="OTP Code">
            <input type="button" id="verify" value="Verify" onClick="codeverify()">
            <div class="p-conf">Number Verified</div>
            <div class="n-conf">OTP ERROR</div>
        </div> </form>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/bs-init.js"></script>
    <script src="../assets/js/theme.js"></script>  
    <script type="text/javascript" src="../assets/js/jquery-3.7.0.min.js"></script>
     <script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-app-compat.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.12.1/firebase-auth-compat.js"></script>
    <script >
  // Import the functions you need from the SDKs you need

  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
 // apiKey: "AIzaSyC3MIN64hy_oTQfQWUHl0lID-CJkIfci0M",
  apiKey: "AIzaSyCTScnGLMn1M4DwEPXuPTJMpttVtIaEYMQ",
  //authDomain: "yt-project-a29f8.firebaseapp.com",
  authDomain: "projecttmp-14e2d.firebaseapp.com",
 // projectId: "yt-project-a29f8",
  projectId: "projecttmp-14e2d",
  //storageBucket: "yt-project-a29f8.appspot.com",
  storageBucket: "projecttmp-14e2d.appspot.com",
  //messagingSenderId: "159898773748",
  messagingSenderId: "401507654596",
 // appId: "1:159898773748:web:2985334de4f06ff73356a1",
  appId: "1:401507654596:web:bad6c0a4c6c093a3a8a291",
 // measurementId: "G-DLWR9M5SJC"
  measurementId: "G-JRK11W7W3Z"
};

  // Initialize Firebase
   firebase.initializeApp(firebaseConfig);
render();
function render(){
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();
}
    // function for send message
function phoneAuth(){
    
    var number = document.getElementById('number').value;
    firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult){
        window.confirmationResult = confirmationResult;
        coderesult = confirmationResult;
        document.getElementById('sender').style.display = 'none';
        document.getElementById('verifier').style.display = 'block';
    }).catch(function(error){
        alert(error.message);
    });
}
function checkPhone(number){
       $.ajax({

                url : 'checkPhone',
                type : 'POST',
                data : {
                    'userinput' : number,
                   
                },
                dataType:'json',
                success : function(data) {
                    if(data != false)
                    console.log(data[0]['id']);
                    /*console.log(data);
                    console.log(data[0]['id']);
                    console.log(data[0]['name']);
                    console.log(data[0]['description']);
                    console.log(data[0]['remarks']);*/
                   
                       
                            $("#id").val(data[0]['id']);             
                            $("#company_id").val(data[0]['company_id']);             
                            $("#date").val(data[0]['date']);             
                            $("#type").val(data[0]['type_id']);             
                            $("#account").val(data[0]['bank_id']);             
                            $("#head").val(data[0]['head_id']);             
                            $("#category").val(data[0]['category_id']);             
                            $("#mode").val(data[0]['mode_id']);             
                            $("#emp").val(data[0]['user_id']);             
                            $("#amount").val(data[0]['amount']);             
                            $("#description").val(data[0]['description']);             
                            $("#remarks").val(data[0]['remarks']); 
                            window.scrollTo({ top: 0, behavior: 'smooth' });  
                            Swal.fire(
                            'Record Deleted Successfully',
                            'Thank You.',
                            'success'
                        )
                        $('#datatablesSimple').DataTable().ajax.reload();             
                       
                        
                    }
                  
                        
                   
                    // alert('Data: '+data);
                ,
                error : function(request,error)
                {
                    alert("Request: "+JSON.stringify(request));
                }
            });
       
}
    // function for code verify
function codeverify(){
    var code = document.getElementById('verificationcode').value;
    coderesult.confirm(code).then(function(){
        document.getElementsByClassName('p-conf')[0].style.display = 'block';
        document.getElementsByClassName('n-conf')[0].style.display = 'none';
        
    }).catch(function(){
        document.getElementsByClassName('p-conf')[0].style.display = 'none';
        document.getElementsByClassName('n-conf')[0].style.display = 'block';
    })
}
</script>


</body>

</html>