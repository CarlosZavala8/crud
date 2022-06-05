<?php
include_once 'dbconfig.php';
if(isset($_POST['btn-update']))
{
$id = $_GET['edit_id'];
$titulo = $_POST['titulo'];
$interprete = $_POST['interprete'];
$duracion =  $_POST['duracion'];
$lanzamiento = $_POST['lanzamiento'];
$candescargas =  $_POST['candescargas'];
$precio = $_POST['precio'];
$comentarios = $_POST['comentarios'];
	
	if($crud->update($id,$titulo, $interprete, $duracion, $lanzamiento, $candescargas, $precio, $comentarios))
	{
		$msg = "<div class='alert alert-info'>
				<strong>BIEN!</strong> Tu registro se ha actualizado correctamente <a href='index.php'>HOME</a>!
				</div>";
	}
	else
	{
		$msg = "<div class='alert alert-warning'>
				<strong>SORRY!</strong> Hay un error al actualizar tu registro! 
				</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($crud->getID($id));	
}

?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<?php
if(isset($msg))
{
	echo $msg;
}
?>
</div>

<div class="clearfix"></div><br />

<div class="container">
	 
     <form method='post'>
 
    <table class='table table-bordered'>
 
               <tr>
            <td>titulo</td>
            <td><input type='text' name='titulo' class='form-control' value="<?php echo $titulo; ?>" required></td>
        </tr>
 
        <tr>
            <td>interprete</td>
            <td><input type='text' name='interprete' class='form-control' value="<?php echo $interprete; ?>" required></td>
        </tr>
 
        <tr>
            <td>duracion</td>
            <td><input type='text' name='duracion' class='form-control' value="<?php echo $duracion; ?>" required></td>
        </tr>
 
        <tr>
            <td>lanzamiento</td>
            <td><input type='text' name='lanzamiento' class='form-control' value="<?php echo $lanzamiento; ?>" required></td>
        </tr>
 
        <tr>
            <td>candescargas</td>
            <td><input type='text' name='candescargas' class='form-control' value="<?php echo $candescargas; ?>" required></td>
        </tr>

        <tr>
            <td>precio</td>
            <td><input type='text' name='precio' class='form-control' value="<?php echo $precio; ?>" required></td>
        </tr>

        <tr>
            <td>comentarios</td>
            <td><input type='text' name='comentarios' class='form-control' value="<?php echo $comentarios; ?>" required></td>
        </tr>        
 
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-primary" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update this Record
				</button>
                <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; regresar</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>