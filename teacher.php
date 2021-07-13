<?php

//teacher.php
include('header.php');
?>

<div class="container" style="margin-top: 30px">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-md-9">Teacher List</div>
				<div class="col-md-3" align="right">
			</div>
		</div>
    </div>
	    <div class="card-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered" id="teacher_table">
			<thead>
				<tr>
					<th>Image</th>
					<th>Teacher Name</th>
					<th>Email Address</th>
			        <th>Grade</th>
			        <th>View</th>
			        <th>Edit</th>
			        <th>Delete</th>		
				</tr>
			</thead>
			<tbody>
				
			</tbody>
			
		</table>
	    </div>
	</div>
	</div>
</div>
</body>
</html>

<script>
	$(document).ready(function(){
  
     var dataTable = $('#teacher_table').DataTable({
     	"processing":true,
     	"serverSide":true,
     	"order":[],
     	"ajax":{

     		url:"teacher_action.php",
     		type:"POST",
     		data:{action:'fetch'}
     	}
     });

	});
</script>