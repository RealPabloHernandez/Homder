<?php
    if($message != ""){
        if($err_login){$access_reff="login_ref";}
        else{
            $access_reff="signin_ref";
        }    
?>
    <script>initAccess_modal(<?php echo ("'$access_reff' , '$message'")?>)</script>
    
<?php 
    $message="";
    }

    if(!$inSession){
        echo '<script>postbtn.addEventListener("click", ()=>{access_ref.click()});</script>';
    }
?>