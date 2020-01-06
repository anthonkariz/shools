<?php include('header.php'); 
   include('classes/db.php');
   $db = new db();
   
   ?>
<div class="row">
   <div class="col-md-12">
      <table class="table table-striped">
         <tbody>
            <?php foreach($db->showStudentAndTheTeacherBytudentId($_GET['id']) as $rows):  ?>
            <tr>
               <th scope="col"> Student Name  </th>
               <td> <?php echo $rows['title'] ; ?>  <?php echo $rows['first_name'] ; ?> <?php echo $rows['Surname'] ; ?> </td>
            <tr>
               <th scope="col"> Student contacts </th>
               <td> Phone - <?php echo $rows['phone_number'] ; ?>  Email-  <?php echo $rows['email'] ; ?></td>
            </tr>
            <tr>
               <?php if( $rows['teacher_id']):?>
               <th scope="col"> Student Teacher   </th>
               <td> <?php echo $rows['Ttitle'] ; ?>  <?php echo $rows['tFname'] ; ?> <?php echo $rows['TSurname'] ; ?> </td>
               <?php else: ?>
               <th scope="col"> Student Teacher   </th>
               <td> <a href="#"> No teacher assigned Please assign one  </a>  </td>
               <?php endif;?> 
            </tr>
            <?php endforeach; ?>
            <?php
               $i =1;
               foreach($db->getOneStudentAndContact($_GET['id']) as $row):  ?>
            <tr>
               <?php 
                  if( ($row['teacher_id']) || ($row['contact_id'] )):?>
               <?php  if($row['contact_id']): ?>
            <tr>
               <th scope="col"> Contact <?php echo $i++; ?>  </th>
               <td> <a href="#"> <?php echo $row['ctitle']; ?>  <?php echo $row['cfirst_name'] ; ?> <?php echo $row['csurname'] ; ?> </a> ( <a href="controller.php?cid=<?php echo $row['contact_id'] ; ?>&&sid=<?php echo $rows['Sid'] ; ?>&&action=delcontact"> Remove </a>)</td>
               <?php endif;?>
            </tr>
            <?php  if($row['teacher_id']): ?>
            <tr>
               <th scope="col"> Contact <?php echo $i++; ?>     </th>
               <td> <a href="#"> <?php echo $row['t_title']; ?>  <?php echo $row['tfirst_name'] ; ?> <?php echo $row['tsurname'] ; ?></a> ( <a href="controller.php?tid=<?php echo $row['teacher_id'] ; ?>&&sid=<?php echo $rows['Sid'] ; ?>&&action=delcontact">Remove</a>) (a teacher) </td>
            </tr>
            <?php endif;?>
            <?php else: ?>
            <th scope="col"> Contact   </th>
            <td> <a href="assignteacher.php?tid=<?php echo $row['Sid'] ; ?>"> No contact assigned Please assign one  </a>  </td>
            <?php endif;?> 
            </tr>
            <?php endforeach; ?>
            <tr>
               <td colspan="2"> <a href="controller.php?actiondelete=1&sid=<?php echo $rows['Sid'] ; ?> " class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?');"  > Delete </a>  </td>
            </tr>
         </tbody>
      </table>
   </div>
</div>
<div class="row">
   <div class="col-md-12 stForm">
   <h4 class="ribon"> Edit  <?php echo $rows['Surname'] ; ?> Deatils </h4>
      <form method="post" action="controller.php" >
         <input type="hidden"  name="sid" value="<?php echo $rows['Sid'] ; ?>">
         <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name" value="<?php echo $rows['first_name'] ; ?>" required>                          
         </div>
         <div class="form-group">
            <label>Surname</label>
            <input type="text" class="form-control" id="Surname" name="Surname" placeholder="Enter Surname" value="<?php echo $rows['Surname'] ; ?>" required>                          
         </div>
         <div class="form-group">
            <label>title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $rows['title'] ; ?>" placeholder="Enter title">                          
         </div>
         <div class="form-group">
            <label>Email email</label>
            <input type="email" class="form-control" id="email" name="email"  value="<?php echo $rows['email'] ; ?>" placeholder="Enter email">                          
         </div>
         <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $rows['phone_number'] ; ?>" placeholder="Enter phone number">                          
         </div>
         <button type="submit" class="btn btn-primary">Submit</button>
      </form>
   </div>
</div>
<div class="row">
   <div class="col-md-12 stForm">
      <h4 class="ribon"> Edit  <?php echo $rows['Surname'] ; ?> Add contact </h4>
      <ul class="nav nav-tabs">
         <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#home">A teacher</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu1">Existing Contact</a>
         </li>
         <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#menu2">New Contact</a>
         </li>
      </ul>
      <div class="tab-content">
         <div class="tab-pane active container" id="home">
            <form method="post" action="controller.php" >
               <div class="form-group">
                  <label>Select A teacher </label>
                  <select class="form-control" id="teacher" name="teacherascontact">
                     <?php foreach($db->findAll('teacher') as $teacher): ?>
                     <option value="<?php echo $teacher['id'];?>"> <?php echo $teacher['first_name'];?> <?php echo $teacher['Surname'];?></option>
                     <?php endforeach; ?>
                  </select>
                  <input type="hidden"  name="stid" value="<?php echo $rows['Sid'] ; ?>">                           
               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
            </form>
         </div>
         <div class="tab-pane container" id="menu1">
            <div class="form-group">
               <form method="post" action="controller.php" >
                  <div class="form-group">
                     <label>Select A contact  </label>
                     <select class="form-control" id="contactascontact" name="contactascontact">
                        <?php foreach($db->findAll('contact') as $contact): ?>
                        <option value="<?php echo $contact['id'];?>"> <?php echo $contact['first_name'];?> <?php echo $contact['Surname'];?></option>
                        <?php endforeach; ?>
                     </select>
                     <input type="hidden"  name="stid" value="<?php echo $rows['Sid'] ; ?>">                           
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
               </form>
            </div>
         </div>
         <div class="tab-pane container" id="menu2">
            <form method="post" action="controller.php" >
               <input type="hidden"  name="newcontact" value="<?php echo $rows['Sid'] ; ?>">
               <div class="form-group">
                  <label>First Name</label>
                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name"  required>                          
               </div>
               <div class="form-group">
                  <label>Surname</label>
                  <input type="text" class="form-control" id="Surname" name="Surname" placeholder="Enter Surname"  required>                          
               </div>
               <div class="form-group">
                  <label>title</label>
                  <input type="text" class="form-control" id="title" name="title"  placeholder="Enter title" required>                          
               </div>
               <div class="form-group">
                  <label>Email email</label>
                  <input type="email" class="form-control" id="email" name="email"  placeholder="Enter email" required>                          
               </div>
               <div class="form-group">
                  <label>Phone</label>
                  <input type="text" class="form-control" id="phone_number" name="phone_number"  placeholder="Enter phone number" required>                          
               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-md-12 mt-4 mb-4">
      <h4 class="ribon">Assign this  student  a teacher or update </h4>
      <form method="post" action="controller.php" >
         <div class="form-group">
            <label>Select A teacher </label>
            <select class="form-control" id="teacher" name="teachertostudent">
               <?php foreach($db->findAll('teacher') as $teacher): ?>
               <option value="<?php echo $teacher['id'];?>"> <?php echo $teacher['first_name'];?> <?php echo $teacher['Surname'];?></option>
               <?php endforeach; ?>
            </select>
            <input type="hidden"  name="stid" value="<?php echo $rows['Sid'] ; ?>">                           
         </div>
         <button type="submit" class="btn btn-primary">Submit</button>
      </form>
   </div>
</div>
<?php include('footer.php'); ?>