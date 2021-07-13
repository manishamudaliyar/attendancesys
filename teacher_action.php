<?php

//teacher_action.php

include('database_connection.php');

session_start();

if (isset($_POST["action"]))
 {
	if($_POST["action"] == "fetch")
	{
		$query= = "
		SELECT * FROM tbl_teacher
		INNER JOIN tbl_grade
		ON tbl_grade.grade_id = tbl_teacher.teacher_grade_id";
		if(isset($_POST["search"]["value"]))
		{
           
           $query .='
           WHERE tbl_teacher.teacher_name LIKE "%' .$_POST["search"]["value"].'%"
           OR tbl_teacher.teacher_emailid LIKE "%' .$_POST["search"]["value"].'%"
           OR tbl_grade.grade_name LIKE "%' .$_POST["search"]["value"].'%"
           ';
		}
		if(isset($_POST["order"]))
		{
           $query .='
           ORDER BY '.$_POST['order']['0']['column'].''.$_POST['order']['0']['dir'].'
           ';

		}
	else
	{
		$query .= 'ORDER BY tbl_teacher.teacher_id DESC';
	}
	if($_POST["length"] != -1)
	{
		$query .= 'LIMIT' .$_POST['start'] .',' .$_POST['length'];
	}
      $statement = $connect-> prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
      $data = array();
      $filtered_rows = $statement->rowCount();
      foreach($result as $row)
      {
      	$sub_array = array();
      	$sub_array[] = '<img src="teacher_image/' .$row["teacher_image"].'"
      	class="img-thumbnail" width="75" />';
      	$sub_array[] = $row["teacher_name"];
      	$sub_array[] = $row["teacher_emailid"];
      	$sub_array[] = $row["grade_name"];
      	$sub_array[] ='<button type="button" name="view_teacher" class="btn btn-info btn-sm view_teacher" id="'.$row["teacher_id"].'">View</button>' ;
      	$sub_array[] ='<button type="button" name="edit_teacher" class="btn btn-info btn-sm edit_teacher" id="'.$row["teacher_id"].'">Edit</button>';
      	$sub_array[] = '<button type="button" name="delete_teacher" class="btn btn-info btn-sm delete_teacher" id="'.$row["teacher_id"].'">Delete</button>' ;
      	$data[] = $sub_array;
      }

      $output = array(
      	"draw" => intval($_POST["draw"]),
      	"recordsTotal"  =>  $filtered_rows,
      	"recordsFiltered"  =>get_total_records($connect, 'tbl_teacher'),
      	"data"   => $data
      );
	}

	echo json_encode($output);
}

?>