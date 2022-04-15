<?= $this->extend('defaultLayout') ?>

<?= $this->section('content') ?>

<div class="col-md-7 offset-md-2">
    
<main class="form-signin">
  <form id="loginformid" method="post" action="<?= base_url('/login/process') ?>">

    <h1 class="h3 mb-3 fw-normal text-center">Login</h1>

    <div class="form-floating">
      <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
      <label for="floatingInput">Email</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password">
      <label for="floatingPassword">Password</label>
    </div>

 
    <button class="w-100 btn btn-lg btn-primary" type="submit">LogIn</button>
  </form>
  <br>
  Create your own account: <a href="<?= base_url() ?>/register" class="btn btn-primary">Register</a>
</main>
</div>
<?= $this->endSection() ?>

<?= $this->section('jscontent') ?>
<script> 
  jsFramework.init({
    form_id:"loginformid",
    currentPage:"login"
  });
</script>
<?= $this->endSection() ?>
