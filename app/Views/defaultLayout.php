  


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Task</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>/css/style.css" rel="stylesheet">
  </head>
  <body>
  <div class="container-fluid">
      <div class="row">
          <div class="col-md-5 offset-md-3 text-center">
              <div class="alert alert-success d-none" id="successContainer" role="alert">
                </div>
                <div class="alert alert-danger d-none" id="errorContainer" role="alert">
                </div>
          </div>
      </div>
  
  <?= $this->renderSection('content') ?>
</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url('js/jsFramework.js'); ?>"></script>

  <?= $this->renderSection('jscontent') ?>
  
  </body>
</html>


