var jsFramework={
	 $instance: null,
    options: {
        ajaxResponse: null,
        form_id: '',
        form_url: '', 
        form_method: '',  
        currentPage: '',     
    },
    init: function (params) {
        var supportedParams = ['form_id', 'form_url', 'form_method','currentPage'];
        for (i in supportedParams) {
            if (typeof params[supportedParams[i]] != 'undefined') {
                jsFramework.options[supportedParams[i]] = params[supportedParams[i]];
            }
        }
        if (this.options.currentPage=='register') {
                this.registerSubmit();

        }else if (this.options.currentPage=='login') {
                this.loginSubmit(); 

        }else if (this.options.currentPage=='task') {
             this.taskList();  
                this.taskCreate();
                this.taskEdit();
                this.taskComplete();
                this.taskDelete();
                this._callTaskForm();


        } 
        
        

    },
    ajaxCallback:function(url, method, formdata, container_id=null, callData=false){
        $('#successContainer').addClass('d-none');
        $('#successContainer').html('');
        $('#errorContainer').addClass('d-none');
        $('#errorContainer').html('');

    	var instance=this;
    		  $.ajax({
                    url: url,
                    type: method,
                    data: formdata,
                    dataType:'json',
                    cache:false,
                    beforSend: function(){
                    	if (container_id!=null) {
                    		$('#'+container_id).addClass('disabled');
                    	}                    	
                    },
                    success: function (result) {
                        callData=result;
                        instance.options.ajaxResponse=result;
                        if (result.msg) {
                            $('#successContainer').removeClass('d-none');
                        $('#successContainer').html(result.msg); 
                        }
                        
                        $('#'+container_id).removeClass('disabled');
                    },
                    error: function (request, status, error) {
                    	$('#errorContainer').removeClass('d-none');
                       var validationErrors="";                       
                        if (request.responseJSON) {
                        	$.each(request.responseJSON, function(key,val) {             
						            validationErrors+=key+": "+val+"<br>";       
						      });
                        }
                        $('#errorContainer').html(error+'<br>'+validationErrors);
                        $('#'+container_id).removeClass('disabled');
                    }

                });
    		  
    },
    registerSubmit:function(){
    	 var instance = this;
    	 var form_id=instance.options.form_id;
    	 $('#'+form_id).submit(function(event){

                  $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType:'json',
                    cache:false,
                    beforSend: function(){
                        if (form_id!=null) {
                            $('#'+form_id).addClass('disabled');
                        }                       
                    },
                    success: function (result) {
                        window.location.href="/login";
                        if (result.msg) {
                            $('#successContainer').removeClass('d-none');
                          $('#successContainer').html(result.msg); 
                        }
                        
                        
                        $('#'+form_id).removeClass('disabled');
                    },
                    error: function (request, status, error) {
                        $('#errorContainer').removeClass('d-none');
                       var validationErrors="";                       
                        if (request.responseJSON) {
                            $.each(request.responseJSON, function(key,val) {             
                                    validationErrors+=key+": "+val+"<br>";       
                              });
                        }
                        $('#errorContainer').html(error+'<br>'+validationErrors);
                        $('#'+form_id).removeClass('disabled');
                    }

                });
    	 		
    	 	event.preventDefault();
    	 });
    },
    loginSubmit:function(){
    	var instance = this;
    	 var form_id=instance.options.form_id;

         $('#'+form_id).submit(function(event){
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType:'json',
                    cache:false,
                    beforSend: function(){
                        if (form_id!=null) {
                            $('#'+form_id).addClass('disabled');
                        }                       
                    },
                    success: function (result) {
                        window.location.href="/";
                        if (result.msg) {
                            $('#successContainer').removeClass('d-none');
                          $('#successContainer').html(result.msg); 
                        }
                        
                        
                        $('#'+form_id).removeClass('disabled');
                    },
                    error: function (request, status, error) {
                        $('#errorContainer').removeClass('d-none');
                       var validationErrors="";                       
                        if (request.responseJSON) {
                            $.each(request.responseJSON, function(key,val) {             
                                    validationErrors+=key+": "+val+"<br>";       
                              });
                        }
                        $('#errorContainer').html(error+'<br>'+validationErrors);
                        $('#'+form_id).removeClass('disabled');
                    }

                });
            event.preventDefault();
         });
    },
    taskList:function(){
        var instance=this;
                  $.get("/task/list", function(response, status){
                    var rows="";
            if (response.data) {
                $.each(response.data, function(key, value) {
                    var is_complete="-";
                    var hide="";
                    if (value.completed==1) {
                        is_complete="Completed";
                        hide="d-none";
                    }
                    rows+='<tr><td>'+(key+1)+'</td>\
                            <td>'+value.title+'</td>\
                             <td>'+value.description+'</td>\
                              <td>'+value.due_date+'</td>\
                              <td>'+is_complete+'</td>\
                              <td><a href="javascript:void(0)" data-id="'+value.id+'" class="deletetask btn btn-danger btn-sm">Delete</a> &nbsp; \
                              <a href="javascript:void(0)" data-id="'+value.id+'" class="completetask btn btn-primary btn-sm '+hide+'">Mark As Completed</a> &nbsp;\
                              <a href="javascript:void(0)" data-id="'+value.id+'" class="btn btn-success btn-sm callTaskFormModal">Edit</a></td>\
                    </tr>';
                });
            }
            $('table tbody').html(rows);
          });
                   setTimeout(function(){
                     $('#successContainer').addClass('d-none');
        $('#successContainer').html('');
        $('#errorContainer').addClass('d-none');
        $('#errorContainer').html('');
                 }, 3000);
    },
    _callTaskForm: function(){
        var instance=this;
        $(document).on('click', '.callTaskFormModal',function(e){  
            var id=$(this).attr('data-id');
            if (id=='' || id==null || id=='undefined') {
                id=0
            }
            $.get("/task/_form/"+id, function(response){
            if (response!='') {
                $('.loadTaskForm').html(response);
                $('#taskFormModel').modal('show');
            }

          },'html');  
            e.preventDefault();
        });

    },
    taskCreate:function(){
        var instance = this;
         var form_id=instance.options.form_id;
         $(document).on('submit', '#'+form_id, function(event){

              $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    dataType:'json',
                    cache:false,
                    beforSend: function(){
                        if (form_id!=null) {
                            $('#'+form_id).addClass('disabled');
                        }                       
                    },
                    success: function (result) {
                       $('#taskFormModel').modal('hide');
                        if (result.msg) {
                            $('#successContainer').removeClass('d-none');
                            $('#successContainer').html(result.msg); 
                        }

                        
                        $('#'+form_id).removeClass('disabled');
                      instance.taskList();
                    },
                    error: function (request, status, error) {
                      $('#errorContainer').html(error);
                        $('#'+form_id).removeClass('disabled');
                    }

                });
            event.preventDefault();
         });
    },
    taskEdit:function(){
        // console.log('2');
    },
    taskComplete:function(){
         var instance=this;
         $(document).on('click', '.completetask',function(e){
         
            var id=$(this).attr('data-id');
            if (id) {
                $.post("/task/mark-complete/"+id, function(response, status){
                    if (response.success==1) {
                        $('#successContainer').removeClass('d-none');
                        $('#successContainer').html(response.msg); 
                         instance.taskList();
                    }else{
                        $('#errorContainer').removeClass('d-none');
                        $('#errorContainer').html(response.msg); 
                    }
                  });
            }
               
            e.preventDefault();
        });
    },
    taskDelete:function(){
                 var instance=this;

     $(document).on('click', '.deletetask',function(e){

     
            var id=$(this).attr('data-id');
            if (id) {
                $.post("/task/delete/"+id, function(response, status){
                     if (response.success==1) {
                         instance.taskList();
                        $('#successContainer').removeClass('d-none');
                        $('#successContainer').html(response.msg); 
                    }else{
                        $('#errorContainer').removeClass('d-none');
                        $('#errorContainer').html(response.msg); 
                    }
                  });
            }
               
            e.preventDefault();
        });
    }
}