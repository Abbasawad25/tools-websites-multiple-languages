<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
// rix - PHP Script
// Author: abbasawad25
/* 
/////////// tools website multiple languages ///////
######## script tools  #######
------------------ about me --------------------------
#my name is abbas awad ahmed 
#im form in sudan
github
https://github.com/Abbasawad25
 faecbook 
https://www.facebook.com/abbasawad26
https://www.facebook.com/abbasawad24
youtube
https://youtube.com/@abbasawad?si=dyfkjbAiUOqsvJMn

Twitter
https://twitter.com/abbasawad26
https://twitter.com/abbasawad25
your web site
https://abbasawad25.epizy.com/abbasawad26
and
join from group on faecbook
https://facebook.com/groups/milliosudaneseprogrammer/

*/

if(isset($_GET['b'])) {
$b = $_GET['b'];


if($b == "set_default") {
	$id = $_GET['id'];
	if(!file_exists("languages/$id.php")) {
		header("Location: ?a=languages");
	}
	?>
	

           <div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<?php
					$update = $db->query("UPDATE settings SET default_language='$id'");
					echo "New default language is <b>$id</b>.";
					?>
					
					</div>
				</div>
			</div>
	<?php
} elseif($b == "add") {
	?>
	

           <div class="col-md-12">
				<div class="card">
					<div class="card-body">
					
					<?php
					if(isset($_POST['btn_save'])) {
						$lang_name = $_POST['lang_name'];
						
						if(empty($lang_name)) { echo "Please enter language name."; }
						elseif(!$lang_name) { echo "Please enter a valid language name. Use latin characters. For example: English"; }
						elseif(file_exists("backend/languages/$lang_name.php")) { echo "Language <b>$lang_name</b> already exists."; }
						else {
						$contents = '<?php
// '.$id.' Language for abbasawad25 PHP Script
// Last update: '.date("d/m/Y H:i").'
$lang = array();
';
						$key = $_POST['key'];
						foreach($_POST['key'] as $k=>$v) {
							$contents .= '$lang["'.$k.'"] = "'.$v.'";
';
						}
						$contents .= '?>';
						$update = file_put_contents("languages/$lang_name.php",$contents);
						if($update) {
							echo "Language <b>$lang_name</b> was added successfully.";
						} else {
							echo "Please set chmod 777 of file <b>languages</b> directory.";
						}
						}
					}
					?>
				
					<form action="" method="POST">
						<div class="form-group">
							<label>Language name</label>
							<input type="text" class="form-control" name="lang_name">
						</div>
						
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="30%">Key</th>
									<th width="70%">Value</th>
								</tr>
							</thead>
							<tbody>
							<?php
							include("languages/ar.php");
							foreach($lang as $k=>$v) {
								echo '<tr>
										<td><b>'.$k.'</b></td>
										<td><input type="text" class="form-controL" name="key['.$k.']" value="'.$v.'"></td>
									</tr>';
							}
							?>	
							</tbody>
						</table>
						<button type="submit" class="btn btn-primary" name="btn_save"><i class="fa fa-check"></i> Save changes</button>
					</form>
					
					</div>
				</div>
			</div>
	<?php
} elseif($b == "edit") {
	$id = $_GET['id'];
	if(!file_exists("languages/$id.php")) {
		header("Location: ?a=languages");
	}
	?>
	

           <div class="col-md-12">
				<div class="card">
					<div class="card-body">
					<h3><?php echo filter_var($id, FILTER_SANITIZE_STRING); ?></h3>
					<br>
					
					<?php
					if(isset($_POST['btn_save'])) {
						$contents = '<?php
// '.$id.' Language for rix PHP Script
// Last update: '.date("d/m/Y H:i").'
$lang = array();
';
						$key = $_POST['key'];
						foreach($_POST['key'] as $k=>$v) {
							$contents .= '$lang["'.$k.'"] = "'.$v.'";
';
						}
						$contents .= '?>';
						$update = file_put_contents("languages/$id.php",$contents);
						if($update) {
							echo "Your changes was saved successfully.";
						} else {
							echo "Please set chmod 777 of file <b>languages</b> directory.";
						}
					}
					?>
				
					<form action="" method="POST">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th width="30%">Key</th>
									<th width="70%">Value</th>
								</tr>
							</thead>
							<tbody>
							<?php
							include("languages/$id.php");
							foreach($lang as $k=>$v) {
								echo '<tr>
										<td><b>'.$k.'</b></td>
										<td><input type="text" class="form-controL" name="key['.$k.']" value="'.$v.'"></td>
									</tr>';
							}
							?>	
							</tbody>
						</table>
						<button type="submit" class="btn btn-primary" name="btn_save"><i class="fa fa-check"></i> Save changes</button>
					</form>
					
					</div>
				</div>
			</div>
	<?php
} elseif($b == "delete") {
	$id = $_GET['id'];
	if(!file_exists("languages/$id.php")) {
		header("Location: ?a=languages");
	}
	?>
	

           <div class="col-md-12">
					<div class="card">
                        <div class="card-body">
			<?php
			if("en" == $id) { 
				echo "$id is default language. Please change it and then delete it.";
			} else {	
				@unlink("languages/$id.php");
				echo "Language <b>$id</b> was deleted successfully.";
			}
			?>
		</div>
	</div>
	</div>
	<?php
} } else {
?>


           <div class="col-md-12">
					<div class="card">
                        <div class="card-body">
						<a href="?&b=add" title="add"><i class="fa fa-pencil"></i>add languages</a>
		<table class="table table-striped">
			<thead>
				<tr>
					<th width="75%">Language name</th>
					<th width="25%">Default</th>
					<th width="5%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($handle = opendir('languages')) {
					while (false !== ($file = readdir($handle)))
					{
						if ($file != "." && $file != ".." && $file != "geoplugin.php" && $file != "langConfig.php" && strtolower(substr($file, strrpos($file, '.') + 1)) == 'php')
						{
							$lang = str_ireplace(".php","",$file);
							
							
							echo '<tr>
									<td>'.$lang.'</td>
									<td>'.'d'.'</td>
									<td>
										<a href="?a=languages&b=edit&id='.$lang.'" title="Edit"><i class="fa fa-pencil"></i>edit</a> 
										<a href="?a=languages&b=delete&id='.$lang.'" title="Delete"><i class="fa fa-times">delete</i></a>
									</td>
								</tr>';
						}
					}
					closedir($handle);
				}
				?>
			</tbody>
		</table>
	</div>
</div>
</div>
<?php
}
?>