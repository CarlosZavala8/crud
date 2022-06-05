<?php
include_once 'dbconfig.php';
?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<a href="add-data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Agregar registro</a>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 <table class='table table-bordered table-responsive'>
     <tr>
                                <th>ID</th>
                                <th>titulo</th>
                                <th>interprete</th>
                                <th>duracion</th>                                
                                <th>lanzamiento</th>  
                                <th>candescargas</th>
                                <th>precio</th>
                                <th>comentarios</th>
     <th colspan="2" align="center">ACCIONES</th>
     </tr>
     <?php
		$query = "SELECT * FROM citas";       
		$records_per_page=3;
		$newquery = $crud->paging($query,$records_per_page);
		$crud->dataview($newquery);
	 ?>
    <tr>
        <td colspan="7" align="center">
 			<div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
        	</div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php include_once 'footer.php'; ?>