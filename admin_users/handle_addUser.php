
<?php
if(isset($_POST['register'])){
        if(!empty($_POST['name']) && !empty( $_POST['email'])  && !empty($_POST['password']) && !empty($_FILES) && !empty($_POST['room']) && !empty($_POST['ext'])){
          function validation ($data){

            return htmlspecialchars(stripslashes(trim($data)));
   
           } 

          
          
          
          $ass_arr = [];
          $image_errors=[];
          $name = validation($_POST['name']);
          $email = validation($_POST['email']);
          $ext = validation($_POST['ext']);
          $room = validation($_POST['room']);
          $pass = validation($_POST['password']);
          

            
                        if(!preg_match('/^[a-z]*$/i',$name)){
                            $ass_arr['valid_name']= "<p>Please Enter a valid name</p>"; 
                        }if(filter_var($email,FILTER_VALIDATE_EMAIL) == false){
                            $ass_arr['valid_email']= "<p>Please Enter a valid email</p>"; 
                        }
 
                    // email validation has been ended

                  // password validation starts
                
                    if(strlen($pass) < '7'){
                        $ass_arr['length_pass']= "<p>Please password shod be more than 7 characters</p>"; 
                    }
                    
                
                  // password validation has been ended

                  // room validation starts
                
                  
                   if (!preg_match('/^[1-9][0-9]*$/',$room)){
                      $ass_arr['valid_room']= "<p>Please  your room number should be just numbers</p>"; 
                  }
                  
             
                // password validation has been ended
                 // room validation  starts 

                
                  if (!preg_match('/^[1-9][0-9]*$/',$ext)){
                     $ass_arr['valid_ext']= "<p>Please  your ext number should be just numbers</p>"; 
                 }
                 
            
               // password validation has been ended

                 
                var_dump($_FILES); echo "<br>";
                var_dump($_POST);
               
                //image validation
                if($_FILES['image']['name']){
                   
                    if($_FILES['image']['size']>(10**6)){
                        $image_errors['image_size'] = "<p>Please imagge must be less thn 1mega byte</p>";
                    }
                    $extension = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
                    $images_extensions= ['png','jpg','jpeg'];
                    // echo $extension;
                    if(!in_array($extension,$images_extensions)){
                        $image_errors['image_extention'] = "<p>Please imagge extention must be 'png','jpg','jpeg' </p>";
                    } 

                    if(empty($image_errors)){
                        $photopath= '../uploads/';
                        $photoname= time().".".$extension;
                        $fullpath = $photopath.$photoname;
                         move_uploaded_file($_FILES['image']['tmp_name'],$fullpath);


                    }

                }

                if(count($ass_arr)>0 || count($image_errors)>0){
                  
                  session_start();
                  $_SESSION['errors']=$ass_arr;
                  $_SESSION['imgerrors']=$image_errors;
                 
                  var_dump ($_SESSION['errors']);
                  var_dump($_SESSION['imgerrors']);
                
                 
                   
                  //  header("loction:register.php");
                 
                  }else{
                    // echo"hhhh";

                    require '../inc/database.php';
                    try{
                      session_start();
                      session_destroy();
                   
                    $db = new DB();
                    var_dump ($db);
                    // $query_statment= "INSERT INTO user (name,e_mail,pass_word,room,EXT,image) VALUES(?,?,?,?,?,?)";
                    $data = $db->insertdata("user","name,e_mail,pass_word,room,EXT,image","'$name','$email','$pass',$room,$ext,'$photoname'");
                    var_dump( $data);

        
                    
                      header('location:all_users.php');
                   }catch(PDOException $e){
                    var_dump( $e->getMessage());
              }
                  // checklist validation has been ended
                
        }
           
        
    }
  }

  ///////////////////////////////////////////UPDATE CONFIG////////////////////////////////////

if(isset($_POST['Update'])){
    
    var_dump($_FILES); echo "<br>";
            var_dump($_POST);
    if(!empty($_POST['name']) && !empty( $_POST['email'])  && !empty($_POST['password']) && !empty($_FILES ['image']) && !empty($_POST['room']) && !empty($_POST['ext'])){
      function validation ($data){

        return htmlspecialchars(stripslashes(trim($data)));

       } 

      
      
      
      $ass_arr = [];
      $image_errors=[];
      $name = validation($_POST['name']);
      $email = validation($_POST['email']);
      $ext = validation($_POST['ext']);
      $room = validation($_POST['room']);
      $pass = validation($_POST['password']);
      $pass_confirm = validation($_POST['Pass_confirm']);
      

        
                    if(!preg_match('/^[a-z]*$/i',$name)){
                        $ass_arr['valid_name']= "<p>Please Enter a valid name</p>"; 
                    }if(filter_var($email,FILTER_VALIDATE_EMAIL) == false){
                        $ass_arr['valid_email']= "<p>Please Enter a valid email</p>"; 
                    }

                // email validation has been ended

              // password validation starts
            
                if(strlen($pass) < '7'){
                    $ass_arr['length_pass']= "<p>Please password shod be more than 7 characters</p>"; 
                }if($pass_confirm!=$pass){
                    $ass_arr['not_matched']= "<p>password does not match</p>"; }
                
            
              // password validation has been ended

              // room validation starts
            
              
               if (!preg_match('/^[1-9][0-9]*$/',$room)){
                  $ass_arr['valid_room']= "<p>Please  your room number should be just numbers</p>"; 
              }
              
         
            // password validation has been ended
             // room validation  starts 

            
              if (!preg_match('/^[1-9][0-9]*$/',$ext)){
                 $ass_arr['valid_ext']= "<p>Please  your ext number should be just numbers</p>"; 
             }
             
        
           // password validation has been ended

             
            
           
            //image validation
            if($_FILES['image']['name']){
               
                if($_FILES['image']['size']>(10**6)){
                    $image_errors['image_size'] = "<p>Please imagge must be less thn 1mega byte</p>";
                }
                $extension = pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION);
                $images_extensions= ['png','jpg','jpeg'];
                // echo $extension;
                if(!in_array($extension,$images_extensions)){
                    $image_errors['image_extention'] = "<p>Please imagge extention must be 'png','jpg','jpeg' </p>";
                } 

                if(empty($image_errors)){
                    $photopath= '../uploads/';
                    $photoname= time().".".$extension;
                    $fullpath = $photopath.$photoname;
                     move_uploaded_file($_FILES['image']['tmp_name'],$fullpath);


                }

            }

            if(count($ass_arr)>0 || count($image_errors)>0){
             
              session_start();
              $_SESSION['errors']=$ass_arr;
              $_SESSION['imgerrors']=$image_errors;
             
              var_dump ($_SESSION['errors']);
              var_dump($_SESSION['imgerrors']);
                header('location:handle_addUser.php');
            
             
               
              
             
            }else{
                require '../inc/database.php';
                try{
                        
                        
                    
                        $db = new DB();
                        var_dump ($db);
                        
                        $data = $db->updatedata("user","name='$name', e_mail='$email', pass_word='$pass', room=$room, EXT=$ext , image='$photoname'","id={$_POST['idoriginal']}");

                         header("location:all_users.php");
                        var_dump($data);
        
   
                  
  
                    }catch(PDOException $e){
                        var_dump( $e->getMessage());
                    } 
     
     
     
     
     
                
}
} 
} 



 


 
 

     
        
 
 
  









   
    

?>









