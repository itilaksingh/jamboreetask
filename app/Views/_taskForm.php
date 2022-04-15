
<form id="taskformid" action="<?= base_url("/task/save") ?>" method="post">
 
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="<?php echo @$formdata['title'];?>" placeholder="">
    </div>  

    <div class="form-group">
      <label for="description">description</label>
      <textarea class="form-control" id="description" name="description" rows="3"><?php echo @$formdata['description'];?></textarea>
    </div>
    <div class="form-group">
      <label for="title">Due Date</label>
      <input type="date" class="form-control" id="duedate" name="duedate" value="<?php echo @$formdata['due_date'];?>" placeholder="">
    </div>
   <input type="hidden" name="taskid" id="taskid" value="<?php echo @$formdata['id'];?>">
    <div class="form-group">
      <br>
      <input type="submit" class="btn btn-primary" name="save" id="save" value="Save">
        <!-- <input type="reset" class="btn btn-secondary" name="reset" id="reset" value="Reset"> -->
      </div>

</form>