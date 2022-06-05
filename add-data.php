<?php
include_once 'dbconfig.php';
if(isset($_POST['btn-save']))
{
/*	$fname = $_POST['first_name'];
	$lname = $_POST['last_name'];
	$email = $_POST['email_id'];
	$contact = $_POST['contact_no'];*/

$titulo = $_POST['titulo'];
$interprete = $_POST['interprete'];
$duracion =  $_POST['duracion'];
$lanzamiento =  $_POST['lanzamiento'];
$candescargas = $_POST['candescargas'];
$precio = $_POST['precio'];
$comentarios = $_POST['comentarios'];



	
	if($crud->create($titulo, $interprete, $duracion, $lanzamiento, $candescargas, $precio, $comentarios))
	{
		header("Location: add-data.php?inserted");
	}
	else
	{
		header("Location: add-data.php?failure");
	}
}
?>
<?php include_once 'header.php'; ?>
<div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
	?>
    <div class="container">
	<div class="alert alert-info">
    <strong>WOW!</strong> Registro agregado correctamente <a href="index.php">HOME</a>!
	</div>
	</div>
    <?php
}
else if(isset($_GET['failure']))
{
	?>
    <div class="container">
	<div class="alert alert-warning">
    <strong>SORRY!</strong> ERROR while inserting record !
	</div>
	</div>
    <?php
}
?>

<div class="clearfix"></div><br />

<div class="container">

 	
	 <form method='post'>
 
    <table class='table table-bordered'>
 
        <tr>
            <td>titulo</td>
            <td><input type='text' name='titulo' class='form-control' value="<?php if (isset($titulo))echo $titulo; ?>" required></td>
        </tr>
 
        <tr>
            <td>interprete</td>
            <td><input type='text' name='interprete' class='form-control' value="<?php if (isset($interprete))echo $interprete; ?>" required></td>
        </tr>
 
        <tr>
            <td>duracion</td>
            <td><input type='text' name='duracion' class='form-control' value="<?php if (isset($duracion))echo $duracion; ?>" required></td>
        </tr>
 
        <tr>
            <td>lanzamiento</td>
            <td><input type='text' name='lanzamiento' class='form-control' value="<?php if (isset($lanzamiento))echo $lanzamiento; ?>" required></td>
        </tr>
 
        <tr>
            <td>candescargas</td>
            <td><input type='text' name='candescargas' class='form-control' value="<?php if (isset($candescargas))echo $candescargas; ?>" required></td>
        </tr>

        <tr>
            <td>precio</td>
            <td><input type='text' name='precio' class='form-control' value="<?php if (isset($precio))echo $precio; ?>" required></td>
        </tr>

        <tr>
            <td>comentarios</td>
            <td><input type='text' name='comentarios' class='form-control' value="<?php if (isset($comentarios))echo $comentarios; ?>" required></td>
        </tr>  
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Crear nuevo registro
			</button>  
            <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Regresar a home</a>
            </td>
        </tr>
 
    </table>
</form>
     
     
</div>

<?php include_once 'footer.php'; ?>