<?php include('header.php'); 
   include('classes/db.php');
   $db = new db();
   
   ?>
<div class="row">
   <div class="col-md-12">
      <table class="table table-striped">
         <tbody>
            <?php foreach($db->findById('contact',$_GET['id']) as $rows):  ?>
            <tr>
               <th scope="col"> Contact Name  </th>
               <td> <?php echo $rows['title'] ; ?>  <?php echo $rows['first_name'] ; ?> <?php echo $rows['Surname'] ; ?> </td>
            <tr>
               <th scope="col"> Contact contacts </th>
               <td> Phone - <?php echo $rows['phone_number'] ; ?>  Email-  <?php echo $rows['email'] ; ?></td>
            </tr>
            
            <?php endforeach; ?>
            
              
            <tr>
               <td colspan="2"> <a href="controller.php?actionDeletecontact=1&sid=<?php echo $rows['id'] ; ?> " class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student?');"  > Delete </a>  </td>
            </tr>
         </tbody>
      </table>
   </div>
</div>
<div class="row">
   <div class="col-md-12 stForm">
      <h4>Edit  <?php echo $rows['Surname'] ; ?> Dedatils </h4>
      <form method="post" action="controller.php" >
         <input type="hidden"  name="contact" value="1">
         <input type="hidden"  name="cid" value="<?php echo $_GET['id'] ?>">
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
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $rows['title'] ; ?>" placeholder="Enter title" required>                          
         </div>
         <div class="form-group">
            <label>Email email</label>
            <input type="email" class="form-control" id="email" name="email"  value="<?php echo $rows['email'] ; ?>" placeholder="Enter email" required>                          
         </div>
         <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $rows['phone_number'] ; ?>" placeholder="Enter phone number" required>                          
         </div>
         <button type="submit" class="btn btn-primary">Submit</button>
      </form>
   </div>
</div>

<?php include('footer.php'); ?>