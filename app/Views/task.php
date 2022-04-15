<?= $this->extend('defaultLayout') ?>

<?= $this->section('content') ?>

<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"/></svg>
        <span class="fs-4">Task</span>
      </a>

      <ul class="nav nav-pills">
        <li class="nav-item"><a href="<?= base_url(); ?>" class="nav-link active" aria-current="page">Home</a></li>
        
        <li class="nav-item"><a href="<?= base_url('logout') ?>" class="nav-link">Logout</a></li>
      </ul>
    </header>
    
      
  <div class="row">
    <h5><?php echo 'Welcome: '.ucfirst(session('user_name')); ?></h5>

      <div class="col-md-8 offset-2">
        <button type="button" class="btn btn-primary callTaskFormModal" > Add Task </button>
        <table class="table" class="tasklist">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Desc.</th>
      <th scope="col">Due date</th>
      <th scope="col">Is Completed</th>
      <th scope="col">Action</th>

    </tr>
  </thead>
  <tbody>
    
  </tbody>
</table>
      </div>
  </div>



<!-- Modal -->
<div class="modal fade" id="taskFormModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body loadTaskForm">
      
      </div>
    
    </div>
  </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('jscontent') ?>
<script> 
  jsFramework.init({
    currentPage:"task",
    form_id: 'taskformid'
  });
</script>
<?= $this->endSection() ?>
