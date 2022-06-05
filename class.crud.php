<?php

class crud
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
	public function create($titulo, $interprete, $duracion, $lanzamiento, $candescargas, $precio, $comentarios)
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO citas(titulo, interprete, duracion, lanzamiento, candescargas, precio, comentarios) VALUES(:titulo, :interprete, :duracion, :lanzamiento, :candescargas, :precio, :comentarios)");
			$stmt->bindparam(":titulo",$titulo);
			$stmt->bindparam(":interprete",$interprete);
			$stmt->bindparam(":duracion",$duracion);
			$stmt->bindparam(":lanzamiento",$lanzamiento);
			$stmt->bindparam(":candescargas",$candescargas);
			$stmt->bindparam(":precio",$precio);
			$stmt->bindparam(":comentarios",$comentarios);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
	}
	
	public function getID($id_citas)
	{
		$stmt = $this->db->prepare("SELECT * FROM citas WHERE id=:id_citas");
		$stmt->execute(array(":id_citas"=>$id_citas));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($id_citas,$titulo, $interprete, $duracion, $lanzamiento, $candescargas, $precio, $comentarios)
	{
		try
		{
			$stmt=$this->db->prepare("UPDATE citas SET  titulo=:titulo, 
		                                               interprete=:interprete, 
													   duracion=:duracion, 
													   lanzamiento=:lanzamiento,
													   candescargas=:candescargas, 
													   precio=:precio,
													   comentarios=:comentarios
													WHERE id=:id_citas ");
			$stmt->bindparam(":titulo",$titulo);
			$stmt->bindparam(":interprete",$interprete);
			$stmt->bindparam(":duracion",$duracion);
			$stmt->bindparam(":lanzamiento",$lanzamiento);
			$stmt->bindparam(":id_citas",$id_citas);
			$stmt->bindparam(":candescargas",$candescargas);
			$stmt->bindparam(":precio",$precio);
			$stmt->bindparam(":comentarios",$comentarios);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function delete($id_citas)
	{
		$stmt = $this->db->prepare("DELETE FROM citas WHERE id=:id_citas");
		$stmt->bindparam(":id_citas",$id_citas);
		$stmt->execute();
		return true;
	}
	
	/* paging */
	
	public function dataview($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
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
                <td align="center">
                <a href="edit-data.php?edit_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                </td>
                <td align="center">
                <a href="delete.php?delete_id=<?php print($row['id']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                </td>
                </tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>No hay nada aquí...</td>
            </tr>
            <?php
		}
		
	}
	
	public function paging($query,$records_per_page)
	{
		$starting_position=0;
		if(isset($_GET["page_no"]))
		{
			$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}
	
	public function paginglink($query,$records_per_page)
	{
		
		$self = $_SERVER['PHP_SELF'];
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$total_no_of_records = $stmt->rowCount();
		
		if($total_no_of_records > 0)
		{
			?><ul class="pagination"><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET["page_no"]))
			{
				$current_page=$_GET["page_no"];
			}
			if($current_page!=1)
			{
				$previous =$current_page-1;
				echo "<li><a href='".$self."?page_no=1'>First</a></li>";
				echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
			}
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
					echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
				}
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
				echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
				echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
			}
			?></ul><?php
		}
	}
	
	/* paging */
	
}
