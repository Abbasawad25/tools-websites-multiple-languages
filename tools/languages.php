
<?php
// rix - PHP Script
// Author: abbasawad25
### v.3.0.0
/* 
/////////// tools website multiple languages ///////
######## script tools  #######

*/
$apiKey = 'api-key'; //enter your api 
$apiUrl = 'https://moradfzone.kesug.com/api/translate.php';


if(isset($_GET['b'])) {
$b = $_GET['b'];
// emport file
    if($b == "import" && isset($_FILES['json_file'])) {
        $id = $_GET['id']; // name target file
        $jsonRaw = file_get_contents($_FILES['json_file']['tmp_name']);
        $data = json_decode($jsonRaw, true);

        if(is_array($data)) {
            $contents = "<?php\n// Imported & Converted to PHP: $id\n\$lang = " . var_export($data, true) . ";\n?>";
            if(file_put_contents("languages/$id.php", $contents)) {
                echo "<div class='alert alert-success'>✅ تم استيراد الملف وتحديث <b>$id.php</b> بنجاح!</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>❌ خطأ: ملف JSON غير صالح.</div>";
        }
    }

   //export file
    elseif($b == "export") {
        $id = $_GET['id'];
        $filePath = "languages/$id.php";
        if(file_exists($filePath)) {
        function smartInclude($filePath) {
    $content = file_get_contents($filePath);
    
    // this file is not exet retrune add add return in file
    if (stripos($content, 'return') === false) {
        $cleanContent = str_replace(['<?php', '?>'], '', $content);
        return eval("return " . trim($cleanContent, " ;") . ";");
    }
    
    return include($filePath);
}
        $data = smartInclude($filePath);
            
            if (is_array($data)) {
                $jsonResult = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                
                header('Content-Type: application/json');
                header('Content-Disposition: attachment; filename="' . $id . '.json"');
                echo $jsonResult;
                exit;
            } else {
                $error = "عذراً، لم نتمكن من العثور على مصفوفة صالحة داخل ملف PHP.";
        }
            
        }
    }
elseif($b == "translate_api") {
        $id = $_GET['id'];
        $filePath = "languages/$id.php";
        if(file_exists($filePath)) {
           
            include($filePath); 
            
            if (isset($lang) && is_array($lang)) {
                //transport array to json
                $jsonData = json_encode($lang, JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
                $tempJson = "languages/temp_trans_" . time() . ".json";
                file_put_contents($tempJson, $jsonData);

                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => $apiUrl,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FOLLOWLOCATION => true, 
                    CURLOPT_POST => true,
                    CURLOPT_HTTPHEADER => [
                        'X-API-Key: ' . $apiKey,
                        'Accept: application/json'
                    ],
                    CURLOPT_POSTFIELDS => [
                        'file' => new CURLFile(realpath($tempJson), 'application/json', $id . '.json'),
                        'source_lang' => 'en', 
                        'target_lang' => $id, 
                    ]
                ]);
                
                $response = curl_exec($curl);
                $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE); // code status request 
                $curlError = curl_error($curl);
                curl_close($curl);
                
                if(file_exists($tempJson)) unlink($tempJson);
                // Analysis of response code
                $result = json_decode($response, true);

                if($httpCode == 200 && isset($result['success']) && $result['success']) {
                    $translatedData = $result['translated'];
                    // Rebuild the file in the original way
                    $phpContent = "<?php\n";
                    $phpContent .= "// " . $id . " Language File - Translated via API\n";
                    $phpContent .= "\$lang = array();\n";
                    
                    foreach($translatedData as $key => $value) {
                        $cleanValue = addslashes($value); // Protect values from special icons
                        $phpContent .= "\$lang['$key'] = \"$cleanValue\";\n";
                    }
                    $phpContent .= "?>";
                    
                    file_put_contents($filePath, $phpContent);
                    echo "<div class='alert alert-success'>✅ تمت الترجمة بنجاح! تم تحديث <b>$id.php</b>.</div>";
                } else {
                	// Show the error details in the file
                    $errorDesc = $result['error'] ?? ($curlError ?: "كود الاستجابة: $httpCode");
                    echo "<div class='alert alert-danger'>❌ فشل الترجمة: $errorDesc</div>";
                    // Simple analyze
                    if($httpCode == 0) echo "<p style='color:red; font-size:12px;'>تنبيه: السيرفر لا يستطيع الوصول للرابط، تأكد من اتصال السيرفر بالإنترنت.</p>";
                }
            } else {
                echo "<div class='alert alert-danger'>❌ خطأ: المتغير \$lang غير موجود في $id.php</div>";
            }
        }
    }
    
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
						elseif(file_exists("languages/$lang_name.php")) { echo "Language <b>$lang_name</b> already exists."; }
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
							//Condemns the original file we want to translate from it
							include("languages/en.php");
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
                                        <a href="?a=languages&b=translate_api&id='.$lang.'" title="ترجمة"><i class="fa fa-globe"></i> ترجمة</a>
                                        <a href="?a=languages&b=export&id='.$lang.'" title="export"> <i class="fa fa-download"></i> تصدير</a>                         

                                        <form action="?a=languages&b=import&id='.$lang.'" method="POST" enctype="multipart/form-data" style="display: inline-block;">
                                            <label class="btn btn-success btn-action label-upload">
                                                <i class="fa fa-upload"></i> استيراد
                                                <input type="file" name="json_file" onchange="this.form.submit()" accept=".json">
                                            </label>
                                        </form> 
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
