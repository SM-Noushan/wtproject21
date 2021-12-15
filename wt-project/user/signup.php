<script>
    document.title = "Signup";
</script>
<?php
    require_once 'header.php'; 
    require_once 'sequredlogin.php';
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">  </div>
            <div class="col-sm-4"> 
                <h2>Lets Register</h2>
                <br>
                <form id="registrationForm" action="signupprocess.php" method="post" onsubmit="return checking()" enctype="multipart/form-data">
                <div class="form-floating mb-3">
                    <input class="form-control" name="pname" id="pname" type="text" placeholder="pname" required>
                    <label for="pname"><i class="fa fa-user"></i>&nbsp Name</label>
                    <span class="text-danger" id="errpname"></span>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" name="email" id="email" type="email" placeholder="email" required>
                    <label for="email"><i class="fa fa-envelope"></i>&nbsp Email</label>
                    <span class="text-danger"></span>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" name="phone" id="phone" type="tel" placeholder="phone" required>
                    <label for="phone"><i class="fa fa-mobile"></i>&nbsp Phone</label>
                    <span class="text-danger" id="errphone"></span>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" name="pass" id="pass" type="password" placeholder="pass" minlength="8" required>
                    <label for="pass"><i class="fa fa-key"></i>&nbsp Password</label>
                    <span class="text-danger" id="errpass"></span>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" name="cpass" id="cpass" type="password" placeholder="cpass" minlength="8" required>
                    <label for="cpass"><i class="fa fa-key"></i>&nbsp Confirm Password</label>
                    <span class="text-danger" id="errcpass"></span>
                </div>
                <div class="input-group">
                    <label class="input-group-text"  for="inputGroupFile01"><i class="fa fa-picture-o"></i>&nbsp Image File</label>
                    <input type="file" class="form-control" name="imgfile" id="file" onchange="return fileValidation()">
                </div>
                <div class="input-group mb-3">
                    <span class="text-danger"></span>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-secondary btn-lg" name="reset-form" id="resetButton" type="reset">Reset</button>
                    <button class="btn btn-dark btn-lg" name="registration-user" id="submitButton" type="submit">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        var pname    = document.getElementById("pname");
        var pass     = document.getElementById("pass");
        var cpass    = document.getElementById("cpass");
        var tel      = document.getElementById("phone");
        var nameid   = "", status = "", cstatus = "", phone = "";
        var nameerr  = document.getElementById("errpname");
        var passerr  = document.getElementById("errpass");
        var cpasserr = document.getElementById("errcpass");
        var phoneerr = document.getElementById("errphone");
        
        pname.onkeyup = function() {
            console.log(pname.value.trim());
            let regEx = /^[a-zA-Z ]+$/;
            if(pname.value.trim()!=""){
                if(pname.value.match(regEx)){
                    nameid="ok";
                    nameerr.innerHTML="";
                }
                else{
                    nameid="";
                    nameerr.innerHTML="Invalid Name";
                }
            }
            else{
                nameid="";
                nameerr.innerHTML="Empty Name";
            }
        }
        pass.onkeyup = function() {
            let regEx = /[a-z]/g;
            let regEX = /[A-Z]/g;
            let regEx0 = /[0-9]/g;
            let errmsg = "a-z|A-Z|0-9";
            if(pass.value.match(regEx) && pass.value.match(regEX) && pass.value.match(regEx0)){
                status="ok";
                passerr.innerHTML ="";
            }
            else{
                passerr.innerHTML =errmsg;
                status="";
            }
            if(pass.value != cpass.value){
                cpasserr.innerHTML="Password Doesn't Match";
                cstatus="";
            }
            else{
                cstatus="ok";
                cpasserr.innerHTML="";
            }
        }
        cpass.onkeyup = function() {
            if(pass.value != cpass.value){
                cpasserr.innerHTML="Password Doesn't Match";
                cstatus="";
            }
            else{
                cstatus="ok";
                cpasserr.innerHTML="";
            }
        }
        tel.onkeyup = function(){
            if(!isNaN(tel.value) && tel.value.length===11){
                phone="ok";
                phoneerr.innerHTML="";
            }
            else{
                phoneerr.innerHTML="Invalid Phone";
                phone="";
            }
        }
        function fileValidation(){
            var fileInput = document.getElementById('file');
            var filePath = fileInput.value;
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.jfif)$/i;
            if(!allowedExtensions.exec(filePath)){
                alert('Please upload file having extensions .jpeg/.jpg/.png/.Jfif only.');
                fileInput.value = '';
                return "false";
            }
            // }else{
            //     //Image preview
            //     if (fileInput.files && fileInput.files[0]) {
            //         var reader = new FileReader();
            //         reader.onload = function(e) {
            //             document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'"/>';
            //         };
            //         reader.readAsDataURL(fileInput.files[0]);
            //     }
            // }
        }

        function checking(){
            if(fileValidation()!="false"){
                if(status!="ok" || phone!='ok' || cstatus!='ok' || nameid!="ok"){
                alert("Registration Failed");
                return false;
                }
                else
                    return true;
            }
            else
                return false;
        }
    </script>
<?php
    require_once 'footer.php';
?>