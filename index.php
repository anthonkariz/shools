<?php include('header.php'); 
   include('classes/db.php');
   $db = new db();
   
   ?>
<div class="row">
<div class="col-md-8 col-sm-12">
                <section class="main pl-5">
                  <div class="row">
                    <div class="col-md-12">
                      <h4> Table and </h4>
                    </div>
                  </div>   
                 
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
                 </section>
            </div>
       

       </div>
     </div>

     
<?php include('footer.php'); ?>


