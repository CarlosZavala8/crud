<?php
include_once 'dbconfig.php';

if(isset($_POST['btn-del']))
{
	$id_juego = $_GET['delete_id'];
	$crud->delete($id_juego);
	header("Location: delete.php?deleted");	
}

?>

<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">

	<?php
	if(isset($_GET['deleted']))
	{
		?>
        <div class="alert alert-success">
    	<strong>Exito!</strong> Registro eliminado... 
		</div>
        <?php
	}
	else
	{
		?>
        <div class="alert alert-danger">
    	<strong>Seguro </strong> que quieres borrar el registro ? 
		</div>
        <?php
	}
	?>	
</div>

<div class="clearfix"></div>

<div class="container">
 	
	 <?php
	 if(isset($_GET['delete_id']))
	 {
		 ?>
         <table class='table table-bordered'>
         <tr>
                                <th>Id</th>
                                <th>titulo</th>
                                <th>interprete</th>
                                <th>duracion</th>                                
                                <th>lanzamiento</th>  
                                <th>candescargas</th>
                                <th>precio</th>
                                <th>comentarios</th>
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT * FROM citas WHERE id=:id_citas");
         $stmt->execute(array(":id_citas"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
             <td><?php print($row['id']); ?></td>
             <td><?php print($row['titulo']); ?></td>
             <td><?php print($row['interprete']); ?></td>
             <td><?php print($row['duracion']); ?></td>
             <td><?php print($row['lanzamiento']); ?></td>
             <td><?php print($row['candescargas']); ?></td>
             <td><?php print($row['precio']); ?></td>
             <td><?php print($row['comentarios']); ?></td>
             </tr>
             <?php
         }
         ?>
         </table>
         <?php
	 }
	 ?>
</div>

<div class="container">
<p>
<?php
if(isset($_GET['delete_id']))
{
	?>
  	<form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <button class="btn btn-large btn-primary" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; SI</button>
    <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
	<?php
}
else
{
	?>
    <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Regresar a HOME</a>
    <?php
}
?>
</p>
</div>	
<?php include_once 'footer.php'; ?>