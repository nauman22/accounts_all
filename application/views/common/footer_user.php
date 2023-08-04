
 <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright &copy; Top Lead Funds 2023</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
     
    <script src="../assets/user/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/user/js/chart.min.js"></script>
    <script src="../assets/user/js/bs-init.js"></script>
    <script src="../assets/user/js/Animated-Type-Heading-BS5.js"></script>
    <script src="../assets/user/js/theme.js"></script>
      <script type="text/javascript">
       
      $("#user_pwd_update").submit(function(e){
          var oldpwd = $("#old-password").val();
          
          var newpass = $("#newpass").val();
          var confirmpwd = $("#confirmpwd").val();
          
          if(newpass != confirmpwd){
             alert("please type correct password in new and confirm input fields")
              return false;
          }
          else{
              var values = $(this).serialize();
          
 $.ajax({
        url: "chkPwd",
        type: "post",
        data: {"pwd":oldpwd} ,
         async: false,
        success: function (response) {
            console.log(response);
              // Store the response in a variable
   var data = JSON.parse(response);

// Access the value
var respValue = data.resp;
    console.log(respValue); // Output: "match"
           // return false;
          // var data = response;
           
            console.log("-----------");
           // var respValue = data.resp;
            // console.log(respValue);
            ismatch = respValue;
            if(respValue == "match"){
                
           alert("password matched");
          return true;   
            } else {
              alert("Password not matched your current password please try again #!");
              return false;   
            }
           
          // return false;
           // You will get response from your PHP page (what you echo or print)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
           alert("Password not matched your current password please try again #2");
           return false;
        }
    }); 
       if(ismatch == "match"){
           return true;
       } else{
      return false;     
       }
   // 
          }
    
});
$("#Submit-withdrawal-btn").click(function(){
       var ddlmode = $("#ddlmode").val();
          
          var Amountwithd = $("#Amount-withd").val();
         
          
          if(ismatch != "match"){
             alert("please verify OTP first!")
              return false;
          }
          else{
             
 $.ajax({
        url: "withdrawl_update",
        type: "post",
        data: {"amount":Amountwithd,"mode":ddlmode} ,
         async: false,
        success: function (response) {
            console.log(response);
              // Store the response in a variable
   var data = JSON.parse(response);

// Access the value
var respValue = data.resp;
    console.log(respValue); // Output: "match"
           // return false;
          // var data = response;
           
            console.log("-----------");
           // var respValue = data.resp;
            // console.log(respValue);
            ismatch = respValue;
            if(respValue == "match"){
                
           alert("Saved Successfully");
          return true;   
            } else {
              alert("Password not matched your current password please try again #!");
              return false;   
            }
           
          // return false;
           // You will get response from your PHP page (what you echo or print)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
           alert("an error occoured! please try again letter!");
           return false;
        }
    }); 
       if(ismatch == "match"){
           return true;
       } else{
      return false;     
       }
   // 
          }
})
function logout(){
   if (confirm("Are you sure you want to logout? ") == true) {
     window.location.assign("logout");
} else {
 // text = "You canceled!";
}   
}
     $(".btnApprov").click(function(){
         var id = $(this).attr("data-id")
         var action = $(this).attr("data-action")
         var type = $(this).attr("data-type")
     if (confirm("Are you sure you want to perform this action ?") == true) {
         var t = "adminDashboard/"+action+"/"+id+"/"+type;
       window.location.assign(t);
} else {
  
}
     })
     $("#currency").change(function(){
         debugger;
          $("#plan").children("optgroup[label='Select USD Plan']").hide();
        $("#plan").children("optgroup[label='Select TRX Plan']").hide(); 
         if($(this).val() == "USD"){
              $("#plan").children("optgroup[label='Select USD Plan']").show();
         }   else if($(this).val() == "TRX"){
              $("#plan").children("optgroup[label='Select TRX Plan']").show();  
         }
        
     })
        $("#plan").children("optgroup[label='Select USD Plan']").hide();
        $("#plan").children("optgroup[label='Select TRX Plan']").hide();
      </script>
    
        <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
          <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
          <script type="text/javascript">
          let table = new DataTable('#myTable');
          let kyctable = new DataTable('#kycTable');
          let withDrawTable = new DataTable('#withDrawTable');
          </script>
        
</body>                                                      

</html> 