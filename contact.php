<?php include('header.php'); 
include('classes/db.php');
$db = new db();
?>

<div class="row">
  <div class="col-md-12">

  <div class="col-md-12">

  <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home">All contact</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#menu1">Add new</a>
  </li>
 
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active mt-4 mb-4" id="home"> 


  <table class="table table-striped">
  <thead>
    <tr>
    <th scope="col">Title  </th>
     <th scope="col">contact First Name  </th>
      <th scope="col">conatct Last Name </th>      
      <th scope="col"> Action </th>
    </tr>
  </thead>
  <tbody>

 <?php 
  foreach($db->findAll('contact') as $rows): ?>
    <tr>
      <td><?php echo $rows['title'] ; ?></td>
      <td><?php echo $rows['first_name'] ; ?></td>
      <td><?php echo $rows['Surname'] ; ?></td>
       <td> <a href="singlecontact.php?id=<?php echo $rows['id'] ; ?>" class="btn btn-primary" >View More</a>  </td>
    </tr> 

    <?php endforeach; ?>
  </tbody>
</table>

  </div>
  <div class="tab-pane container fade mt-4 mb-4" id="menu1">

  <form method="post" action="controller.php" >
               <input type="hidden"  name="newcontact" value="1">
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
                  <input type="email" class="form-control" id="email" name="email"  placeholder="Enter email" >                          
               </div>
               <div class="form-group">
                  <label>Phone</label>
                  <input type="text" class="form-control" id="phone_number" name="phone_number"  placeholder="Enter phone number" >                          
               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
            </form>
  </div>
 
</div>


</div>
</div>
<?php include('footer.php'); ?>