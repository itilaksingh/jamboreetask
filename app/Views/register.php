<?= $this->extend('defaultLayout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-7 offset-md-2">
    
<div class="form-signin">
  <form id="registerFormid" method="post" action="<?= base_url('register/store') ?>">
    <h1 class="h3 mb-3 fw-normal text-center">Register</h1>
     <div class="form-floating">
      <input type="text" class="form-control" id="full_name" name="full_name" placeholder="full_name">
      <label for="floatingInput">Full Name</label>
    </div>
    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="emailid" placeholder="name@example.com">
      <label for="floatingInput">Email </label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="password" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating">
      <input type="password" name="confirmpassword" class="form-control" id="confirmpassword" placeholder="Password">
      <label for="floatingPassword">Confirm Password</label>
    </div>
 
    <button class="w-100 btn btn-lg btn-primary" type="submit" >Register</button>
  </form>
</div>
</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('jscontent') ?>
<script> 
  jsFramework.init({
    form_id:"registerFormid",
    currentPage:"register"
  });
</script>
<?= $this->endSection() ?>
