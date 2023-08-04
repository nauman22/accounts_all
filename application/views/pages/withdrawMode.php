 
       <form id="form-reset" method="post">
 <div class="container-fluid">
                    <h3 class="text-primary mb-4">Withdrawal Mode:</h3>
                </div>
                <div>
                    <div class="row g-0 text-start justify-content-center">
                        <div class="col">
                            <div class="row">
                                <div class="col offset-1"><label class="form-label" style="color: rgb(0,0,0);font-family: Nunito, sans-serif;font-size: 20px;">Select Withdrawal Mode * :</label>
                                    <div class="select">
                                    <select id="ddlmode" style="font-family: Nunito, sans-serif;padding-left: 0px;font-size: 20px;color: var(--bs-gray-800);" required="">
                                            <optgroup label="Select Withdrawal Mode">
                                                <option value="11" selected="">Ref Bonus</option>
                                                <option value="23">ROI</option>
                                                <option value="24">Affiliate Bonus</option>
                                            </optgroup>
                                        </select></div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: rgb(0,0,0);font-size: 20px;">Mobile No.</span>
                                    <div style="margin-top: 5px;"></div>
                                    <label class="label lbl-success" ><?php echo $phone; ?></label>
                                        <input type="hidden" value="<?php echo $phone; ?>" id="number" name="number">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="col offset-1"><span style="color: rgb(0,0,0);font-size: 20px;">Amount</span>
                                    <div style="margin-top: 5px;"></div><input type="number" id="Amount-withd" style="font-size: 20px;font-family: Nunito, sans-serif;text-align: left;width: 200px;height: 40px;" required="" placeholder="Enter Amount ">
                                </div>
                            </div>
                            <div class="row" style="margin-top: 27px;">
                                <div class="col offset-1 text-start align-self-center">
                                   
                                    <div class="row">
                                         <div id="recaptcha-container"></div>
                                        <div class="col"><button class="btn btn-success jello animated" id="send-verified" type="button" style="margin-top: 12px;border-radius: 20px;margin-left: 0px;border-style: solid;border-color: var(--bs-teal);text-align: center;width: 200px;height: 49px;">Send OTP Code</button>
                                            <div></div><span style="color: rgb(0,0,0);font-size: 20px;">Enter OTP</span>
                                        </div>
                                    </div>
                                    
                                    <div style="margin-top: 5px;"></div><input type="password" id="OTP-code" style="font-size: 20px;width: 200px;height: 40px;"><button class="btn btn-primary" id="otp-verified" type="button" style="margin-top: 12px;margin-left: 0px;">Verify</button>
                                    <div>
                                    <span id="successfull-verified" hidden style="  font-family: Nunito, sans-serif;text-align: left;color: #099965;">Successfully Verified&nbsp;</span>
                                    <span id="notsuccessfull-verified" hidden style=" font-family: Nunito, sans-serif;text-align: left;color: #e11d1d;">Incorrect Code&nbsp;</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col offset-1"><button class="btn btn-primary" id="Submit-withdrawal-btn" type="button" style="width: 90px;height: 40px;font-size: 20px;font-family: Nunito, sans-serif;">Submit</button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $phone; ?>" id="number" name="number">
                
           
            </form>
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
   // alert(location.pathname.split('/').slice(-1)[0]);

function render(){
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();
}
 if (location.pathname.split('/').slice(-1)[0] == 'withdrawMode') {
    // alert("hello")
render();     
 }
$("#send-verified").click(function(){
    
    phoneAuth();
})
$("#otp-verified").click(function(){
    
    codeverify();
})
    // function for send message
function phoneAuth(){
    
    var number = document.getElementById('number').value;
    alert(number);
    firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function(confirmationResult){
        window.confirmationResult = confirmationResult;
        coderesult = confirmationResult;
        alert("SMS sent.")
       // document.getElementById('sender').style.display = 'none';
       // document.getElementById('verifier').style.display = 'block';
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
var ismatch =  "";
    // function for code verify
function codeverify(){
    var code = document.getElementById('OTP-code').value;
    coderesult.confirm(code).then(function(){
        ismatch =  "match";
        $('#successfull-verified').show();
        $('#notsuccessfull-verified').hide();
        
    }).catch(function(){
        $('#successfull-verified').hide();
        $('#notsuccessfull-verified').show();
    })
}

</script>