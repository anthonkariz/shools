<?php 
include('config.php');
class db{
private $table_id;
private $teacher_id;
private $rows = array();

private $first_name ="";
private $Surname ="";
private $title ="";
private $email ="";
private $phone_number ="";
private $tableName="";

private $db_connection = null;


public  function __construct(){
    $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($this->db_connection->connect_errno) {
        echo "error connecting Database";
              exit();
                       }

}
// set the values for updating the database a void DRY 
public function setValuesAndUpdate($tableName,$first_name,$Surname,$title,$email,$phone_number,$table_id=NULL){

 $this->first_name = $first_name;
  $this->Surname =$Surname;
   $this->title =$title;
    $this->email =$email;
  $this->phone_number =$phone_number;
 $this->tableName=$tableName;
 $this->table_id = $table_id;

   if($table_id){
  
  $this->updateTables($tableName,$table_id);
    echo "update";
   }
   if(!$table_id){
   
     return  $this->geTeacherOrContact();
     }


}


private function geTeacherOrContact(){  
    $stmt = $this->db_connection->prepare("INSERT INTO $this->tableName(first_name,Surname,title,email,phone_number) VALUES (?,?,?,?,?)");
    $stmt->bind_param('sssss',$first_name,$Surname,$title,$email,$phone_number);
    $first_name = $this->first_name;
    $Surname =$this->Surname;
    $title = $this->title;
    $email = $this->email;
    $phone_number =$this->phone_number;
    $stmt->execute(); 
    $stmt->close(); 
    
   return $this->db_connection->insert_id;
}


public function Assign_teacher_to_student($student_id,$teacher_id){
    if ($stmt = $this->db_connection->prepare("UPDATE student SET 	teacher_id = ? WHERE id = ?")) {
        $stmt->bind_param('ii',$teacher_id,$stident_id);
        $teacher_id = $teacher_id;
        $stident_id = $student_id;
        $stmt->execute(); 
        $stmt->close();

    }else{

        echo "something went wrong";
    }

}

public function Assign_contact_to_student($student_id,$contact_id,$type){
    if($type =="teacher"){
    
        $stmt = $this->db_connection->prepare("INSERT INTO contact_linker(teacher_id,student_id) VALUES (?,?)");
        $stmt->bind_param('ii',$contact_id,$student_id);
    
    }else{
        $stmt = $this->db_connection->prepare("INSERT INTO contact_linker(contact_id,student_id) VALUES (?,?)");
        $stmt->bind_param('ii',$contact_id,$student_id);
    }
    $student_id = $student_id;
    $contact_id =$contact_id;
    $stmt->execute(); 
    $stmt->close(); 

}


//Remove a contact to a student 

public function remove_contact_to_student($student_id,$contact_id,$type){
    if($type =="teacher"){
    
        $sql = "DELETE  FROM contact_linker  WHERE teacher_id = $contact_id AND student_id = $student_id";
        if ($this->db_connection->query($sql) === FALSE) {    
  
            echo "Error deleting record: " . $this->db_connection->error;
        }
    }else{
        $sql = "DELETE FROM contact_linker  WHERE contact_id = $contact_id AND student_id = $student_id";
        if ($this->db_connection->query($sql) === FALSE) {    
  
            echo "Error deleting record: " . $this->db_connection->error;
        }
    }


}




public function  deleteteacher($id){   

    $sql = "DELETE  FROM teacher  WHERE  teacher.id = $id";

    if ($this->db_connection->query($sql) === FALSE) {    
  
        echo "Error deleting record: " . $this->db_connection->error;
    }else{
        $sql = "DELETE  FROM contact_linker  WHERE  teacher_id = $id";
        $this->db_connection->query($sql);
       
        }
 }


//Delete multple table 
public function  deleteStudent($id){   

    $sql = "DELETE student,contact_linker FROM student INNER JOIN contact_linker WHERE student.id  = contact_linker.student_id AND  student.id = $id";

    if ($this->db_connection->query($sql) === FALSE) {    
  
        echo "Error deleting record: " . $this->db_connection->error;
    }
 }


 public function  deleteContact($id){   

    $sql = "DELETE  FROM contact  WHERE  contact.id = $id";

    if ($this->db_connection->query($sql) === FALSE) {    
  
        echo "Error deleting record: " . $this->db_connection->error;
    }else{
        $sql = "DELETE  FROM contact_linker  WHERE  contact_id = $id";
        $this->db_connection->query($sql);
       
        }
 }

/** Prevents assigning of same contact more than once  on a single student
 *
 */
   function checkIfContactAlreadyAsignedToStudent($type,$student_id,$contact_id){
       if($type =="contact"){
    $sql ="select * from contact_linker where contact_id = $contact_id AND student_id = $student_id";
       }
       if($type =="teacher"){
    $sql ="select * from contact_linker where teacher_id = $contact_id  AND student_id = $student_id";
       }

    $result = $this->db_connection->query($sql);
    if($result){
            if(mysqli_num_rows($result) > 0 ){      
            return true;
            }else{
                return false;
            }
}else{
    return false;
   
}


  }

 //Retrive single data 
 public function findAll($table){
     $rows = array();
    $sql ="select * from $table";
    $result = $this->db_connection->query($sql);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
         $rows[] = $row;      
     }
    
     return $rows;
  }


  public function findById($table,$id){
    $rows = array();
    $sql ="select * from $table WHERE id = $id";
   $result = $this->db_connection->query($sql);
   while($row = $result->fetch_array(MYSQLI_ASSOC)){
         $rows[] = $row;      
   }

     return $rows;
  }
  
public function showStudentAndTheTeacherBytudentId($student_id){
    $sql ="select student.teacher_id,
    teacher.id as tid,
    teacher.first_name as tFname,
    teacher.Surname as TSurname,
    teacher.title as Ttitle,
    teacher.email as Temail,
    student.Surname,
    student.first_name,
    student.title,    
    student.teacher_id,
    student.email,
    student.phone_number,
    student.id  as Sid  
    from student LEFT JOIN teacher ON student.teacher_id = teacher.id     
    WHERE student.id = $student_id";
    $result = $this->db_connection->query($sql);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
             
     
        $this->rows[] = $row;   
    

    }

    return $this->rows;
  }

   

  public function showAllStudentAndTheTeacher(){

    $sql ="SELECT student.teacher_id,
    teacher.id as tid,
    teacher.first_name as tFname,
    teacher.Surname as TSurname,
    teacher.title as Ttitle,
    teacher.email as Temail,
    student.Surname,
    student.first_name,
    student.title,
    student.email,
    student.id  as Sid  
    from student LEFT JOIN teacher ON student.teacher_id = teacher.id";
    $result = $this->db_connection->query($sql);
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
         $this->rows[] = $row;      
     }

     return $this->rows;
  }


  public function getStudentAndContact(){
   

$sql = "SELECT lin.id, lin.teacher_id,lin.contact_id,   
        t.id as tid, t.first_name as tfirst_name,t.Surname as tsurname,           
               c.id as cid, c.first_name as cfirst_name,c.surname as csurname,
               s.id as sid, s.first_name as sfirst_name,s.Surname as ssurname 
 from student s  LEFT JOIN contact_linker lin ON lin.student_id = s.id
   LEFT  JOIN contact c ON  c.id = lin.contact_id
     LEFT JOIN teacher t ON  lin.teacher_id = t.id 
 ";
    $result = $this->db_connection->query($sql);
    if($result){
    while($row = $result->fetch_array(MYSQLI_ASSOC)){
         $this->rows[] = $row;      
     }
     return $this->rows;
    }else{
        return $this->db_connection->error;
    
    }
   
  }


  public function getOneStudentAndContact($student_id){
   $rows = array();

    $sql = "SELECT lin.id, lin.teacher_id,lin.contact_id,   
             t.id as tid, t.first_name as tfirst_name,t.Surname as tsurname,t.title as t_title,        
                  c.id as cid, c.first_name as cfirst_name,c.surname as csurname, c.title as ctitle,
                   s.id as sid, s.first_name as sfirst_name,s.Surname as ssurname 
     from student s  LEFT JOIN contact_linker lin ON lin.student_id = s.id
       LEFT  JOIN contact c ON  c.id = lin.contact_id
         LEFT JOIN teacher t ON  lin.teacher_id = t.id
         where s.id = $student_id
     ";
        $result = $this->db_connection->query($sql);
        if($result){
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
             $rows[] = $row;      
         }
         return $rows;
        }else{
            return $this->db_connection->error;
        
        }
       
      }

// update Table takes name of the table and the 


private function updateTables($tableName,$table_id){

    if ($stmt = $this->db_connection->prepare("UPDATE $tableName SET first_name = ?,Surname = ?,title = ?,email = ?,phone_number = ? WHERE id = ?")) {
        $stmt->bind_param('sssssi',$first_name,$Surname,$title,$email,$phone_number,$id); 
        $id   = $table_id;
        $first_name = $this->first_name;
        $Surname =$this->Surname;
        $title = $this->title;
        $email = $this->email;
        $phone_number =$this->phone_number;
        $stmt->execute(); 
        $stmt->close();

    }else{

        echo "something went wrong";
    }
}

}
