<?php 
include('classes/db.php');
$db = new db();

if(isset($_POST['sid'])){
$table_id = trim($_POST['sid']);
$first_name = htmlentities(trim($_POST['first_name']));
$Surname = htmlentities(trim($_POST['Surname']));
$title = htmlentities(trim($_POST['title']));
$email = htmlentities(trim($_POST['email']));
$phone_number = htmlentities(trim($_POST['phone_number']));

$db->setValuesAndUpdate('student',$first_name,$Surname,$title,$email,$phone_number,$table_id);
 header("Location:student.php?id=".$table_id);
}



if(isset($_POST['teacherascontact'])){
    $student_id = $_POST['stid'];
    $contact_id =  $_POST['teacherascontact'];
   echo $contact_id.'  '.$student_id;
  if(!$db->checkIfContactAlreadyAsignedToStudent('teacher',$student_id,$contact_id)){
    $db->Assign_contact_to_student($student_id,$contact_id,'teacher');
    header("Location:student.php?id=".$student_id ); //redirect with success message
  }
  header("Location:student.php?id=".$student_id ); //redirect with unsuccess message eg 
}



if(isset($_POST['contactascontact'])){
    $student_id = $_POST['stid'];
    $contact_id =  $_POST['contactascontact'];
   echo $contact_id.'  '.$student_id;
   if(!$db->checkIfContactAlreadyAsignedToStudent('contact',$student_id,$contact_id)){
    $db->Assign_contact_to_student($student_id,$contact_id,'contact');
    header("Location:student.php?id=".$student_id ); //redirect with success message
  }
  header("Location:student.php?id=".$student_id ); //redirect with unsuccess messsge
}


if(isset($_POST['newcontact'])){
    $student_id = trim($_POST['newcontact']);
    $first_name = htmlentities(trim($_POST['first_name']));
    $Surname = htmlentities(trim($_POST['Surname']));
    $title = htmlentities(trim($_POST['title']));
    $email = htmlentities(trim($_POST['email']));
    $phone_number = htmlentities(trim($_POST['phone_number']));
    $contact_id = $db->setValuesAndUpdate('contact',$first_name,$Surname,$title,$email,$phone_number);
    
   if($contact_id){

    $db->Assign_contact_to_student($student_id,$contact_id,'contact');
   };

    header("Location:student.php?id=".$student_id);
    }
    if(isset($_POST['teachertostudent'])){
        $student_id =  $_POST['stid'];
        $teacher_id = $_POST['teachertostudent'];
       
      $db->Assign_teacher_to_student($student_id,$teacher_id);
      header("Location:student.php?id=".$student_id);

    }

    if(isset($_GET['action'])){
        $student_id = $_GET['sid'];
       
        if( isset($_GET['tid'])){
            $contact_id = $_GET['tid'];
            
        $db->remove_contact_to_student($student_id,$contact_id,'teacher');
        header("Location:student.php?id=".$student_id);
        }
        if(isset($_GET['cid'])){
            $contact_id = $_GET['cid'];
            echo "teacher";
        $db->remove_contact_to_student($student_id,$contact_id,'contact');
        header("Location:student.php?id=".$student_id);

    }
}


if(isset($_GET['actiondelete'])){

    $db->deleteStudent($_GET['sid']);
    header("Location:index.php");
}

// update / add new record

if(isset($_POST['newteacher'])){  
    echo "here";  
    $first_name = htmlentities(trim($_POST['first_name']));
    $Surname = htmlentities(trim($_POST['Surname']));
    $title = htmlentities(trim($_POST['title']));
    $email = htmlentities(trim($_POST['email']));
    $phone_number = htmlentities(trim($_POST['phone_number']));

    if( isset($_POST['tid'])){
        //we are updating record
        $table_id = trim($_POST['tid']);
        $db->setValuesAndUpdate('teacher',$first_name,$Surname,$title,$email,$phone_number,$table_id);
        header("Location:singleteacher.php?id=".$table_id);
    }else{
        //New record 
     $db->setValuesAndUpdate('teacher',$first_name,$Surname,$title,$email,$phone_number);
     header("Location:teacher.php");
}
    }

    if(isset($_GET['actionDeleteteacher'])){
          echo "deleted";
        $db->deleteteacher($_GET['sid']);
    header("Location:teacher.php");
    }
    

    if(isset($_POST['contact'])){  
        echo "here";  
        $first_name = htmlentities(trim($_POST['first_name']));
        $Surname = htmlentities(trim($_POST['Surname']));
        $title = htmlentities(trim($_POST['title']));
        $email = htmlentities(trim($_POST['email']));
        $phone_number = htmlentities(trim($_POST['phone_number']));
    
        if( isset($_POST['cid'])){
            //we are updating record
            $table_id = trim($_POST['cid']);
            $db->setValuesAndUpdate('contact',$first_name,$Surname,$title,$email,$phone_number,$table_id);
            header("Location:singlecontact.php?id=".$table_id);
        }else{
            //New record 
         $db->setValuesAndUpdate('contact',$first_name,$Surname,$title,$email,$phone_number);
         header("Location:contact.php");
    }
        }
    
        if(isset($_GET['actionDeletecontact'])){
             
            $db->deleteContact($_GET['sid']);
    header("Location:contact.php");
        }
    

        if(isset($_POST['newstudent'])){
            
            $first_name = htmlentities(trim($_POST['first_name']));
            $Surname = htmlentities(trim($_POST['Surname']));
            $title = htmlentities(trim($_POST['title']));
            $email = htmlentities(trim($_POST['email']));
            $phone_number = htmlentities(trim($_POST['phone_number']));            
           $db->setValuesAndUpdate('student',$first_name,$Surname,$title,$email,$phone_number);
             header("Location:index.php?id=".$table_id);
            }
            
