
<?php 
include('db.php');
$db = new db();
//$db->setValues('student','james','karismike','mr','anthony@gmail.vom','098977665');
//$db->Assign_teacher_to_student(5,3);
//$db->Assign_contact_to_student(7,10,'contact');
//$db->deleteStudent(5);
//echo print_r($db->findAll('contact'));
//echo '<pre>';
//echo print_r($db->findById('student',6));
//echo '</pre>';
/*
echo '<pre>';
echo print_r($db->showStudentAndTheTeacherBytudentId(6));
echo '</pre>';
echo '<pre>';
echo print_r($db->getStudentAndContact());
echo '</pre>';


echo '<pre>';
echo print_r($db->getStudentAndContact());
echo '</pre>';

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

    <div class="row">
                      <form>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                          </div>
                          <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                          </div>
                          <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                  </div>


*/
echo '<pre>';
print_r($db->getOneStudentAndContact(6));
echo '</pre>';