<?php 
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 * jalg joanlaga@hotmasil.com, permite la modificacion de las traducciones desde el front-end o usuario, enero 2013
 * funcion nueva. No Existe en Horti ni en openbiblio 
*/

require_once("../shared/common.php");
$tab = "admin";
$nav = "adminTranslate";
$helpPage = "translate";

require_once("../functions/errorFuncs.php");
require_once("../shared/logincheck.php");

require_once("../classes/Localize.php");
$loc = new Localize(OBIB_LOCALE,$tab);

require_once("../shared/header.php");
include('../functions/translate_funtions.php');

$local = readDirs(null);
$klang = 'es'; //jalg Lee el modulo selecionado segun se elija, sera el directorio de locale ejemplo: en, caprta /en/
$lang = 'en'; //jalg Lee el modulo selecionado segun se elija, sera el directorio de locale ejemplo: en, caprta /en/
$modules = readDirs($klang);
$langs = array();
$Base = array();//Item for Base file
$trans = array();//Item for view or change file
$k = array();//count
$v = array();//count
//$Translate= readDirs('es');

?>
	<h1><?php  echo $loc->getText("admin-Translate"); ?></h1>
	<pre><?php  echo $loc->getText("admin-transAdver"); ?></pre>
	<pre><?php  echo '<pre>' . $loc->getText("admin-transPrev"). '</pre>'; ?></pre>
	
		<form action="translate.php" method="post" name="modlang" Module > 
			<select name="klang" size="1" class="text" >
				<option value=""> <?php echo getText("Seleccione el Idioma Base");?> </option>
					<?php foreach ($local as $ks ) {	?>
				<option value="<?php echo $local[$ks];?>"> <?php echo $local[$ks];?> </option>
				<?php } ?>
			</select>

			<select name="lang" size="1" class="text" >
				<option value=""> <?php echo getText("Seleccione el Idioma a ver");?> </option>
					<?php foreach ($local as $s ) {	?>
				<option value="<?php echo $local[$s];?>"> <?php echo $local[$s];?> </option>
				<?php } ?>
			</select>

			<select name="module" size="1" class="text" onchange="javascript:document.modlang.submit();">
				<option value=""> <?php echo getText("Seleccione el Modulo a ver");?> </option>
			<?php foreach ($modules as $k ) { ?>
			<option value="<?php echo $modules[$k];?>"> <?php echo $modules[$k];?> </option>
				<?php } ?>
			</select>
		</form>

<?php 
	if($_POST["module"] == null){ // Preconfigura la pagina para valores iniciales, selecciona modulo por default.
		$module ='opac.php';
	  }else{
		$module = $_POST["module"];    
	}
	if($_POST["klang"] == null){ // Preconfigura la pagina para valores iniciales, selecciona idoma base "spanish".
		$klang ='es';
	}else{
		$klang = $_POST["klang"];
	}				
	if($_POST["lang"] == null){ // Preconfigura la pagina para valores iniciales, selecciona idoma a ver "Inglish".
		$lang ='en';
	}else{
		$lang = $_POST["lang"];
	}				
/*
echo "</br> modulo ";
echo $module ;//modulo seleccionado
echo "</br> klang ";
echo $klang ;//idioma base
echo "</br>lang ";
echo $lang ;//idioma ver
echo "</br>";
*/
include(OBI_DIR. $klang . '/' . $module);
	ob_start();
		if (file_exists(OBI_DIR. $klang . '/' . $module)) {//busca las cadenas si no esta el file klang busca en lang
				@readfile(OBI_DIR. $klang . '/' . $module);
			} else {
				@readfile(OBI_DIR. $lang . '/' . $module);
			}
				eval("\$Base=array(".ob_get_contents()."\n'0');");
	ob_end_clean();
			foreach ($Base as $k => $v) {
				if ($v != '0') {
					$trans[ (is_int($k) ? $v : $k) ] = array($Base => $v );
				}
		}

ksort($trans); //jalg el texto base  indice trans

		foreach ($trans as $k => $v) {
			if ($v != '0') {
				$lara[ (is_int($k) ? $v : $k) ] = array($klang => $v );
			}
		}
ksort($lara); //jalg el texto ver indice trans

$locale = array();
	include(OBI_DIR. $lang . '/' . $module);
	ob_start();
		// read language files from module's locale directory preferrably
		if (file_exists(OBI_DIR. $lang . '/' . $module)) {
			@readfile(OBI_DIR. $lang . '/' . $module);
		} else {
			@readfile(OBI_DIR. $lang . '/' . $module);
		}
		eval("\$locale=array(".ob_get_contents()."\n'0');");
	ob_end_clean();

ksort($locale);
			foreach ($locale as $k1 => $v) {
				if ($v != '0') {
				$trans= $v;
			}
		}

ksort($trans);// jalg lee la traduccion
		foreach ($trans as $k1 => $v) {
			if ($v != '0') {
					$lara[$k1][$lang] = $v;
					
			}
		}
 
$trans = $lara;

ksort($trans); // lee la clave de la traduccion
/*

echo "lara";
echo "<pre>";
print_r($lara);
echo "</pre>"

echo "langs";
echo "<pre>";
print_r($langs);
echo "</pre>";

echo "trans";
echo "<pre>";
print_r($trans);
echo "</pre>";

*/

?>

<form action="translate_save.php" method="post" name="editlang">
<input type="hidden" name="module" value="<?php echo $modules[$module];?>" />
<input type="hidden" name="lang" value="<?php echo $lang;?>" />

<table width="100%" border="1" cellpadding="1" cellspacing="1" class="table table-bordered table-striped">
<tr>
	<th width="10%" nowrap><?php echo $loc->getText("Clave -getText-: ") ;?> </th>
	<th width="40%" nowrap><?php echo $loc->getText("Archivo Base: ") . OBI_DIR . $klang . '/' . $modules[$module] ;?> </th>
	<th width="40%" nowrap><?php echo $loc->getText("Archivo Modificar: ") . OBI_DIR. $lang . '/' . $module ;?> </th>
</tr>

	<?php
		$index = 0;
	echo "<tr>\n";
		echo '<td><input type="text" name="trans['.$index.'][key]" value="'. $loc->getText("admin-transNewEntry").' " size="15" class="text" /></td>' . "\n";
		if ($lang == $klang) { 
	?>
 				<td><input type="text" name=" <?php echo $trans[$index][$klang]?> " value="<?php echo $loc->getText("admin-transNewEntry") ?>" size="40" class="text" /></td>
				<td><input type="hidden" name=" <?php echo $trans[$index][$lang]?> " value="<?php echo $loc->getText("admin-transNewEntry") ?>" size="40" class="text" /></td>
			<?php	} else { 	?>
				<td><input type="text" name=" <?php echo $trans[$index][$lang]?> " value="<?php echo $loc->getText("admin-transNewEntry") ?>" size="40" class="text" /></td>
				<td><input type="hidden" name=" <?php echo $trans[$index][$klang]?> " value="<?php echo $loc->getText("admin-transNewEntry") ?>" size="40" class="text" /></td>
<?php			}
	echo "</tr>\n";

		$index++;
		foreach ($trans as $k => $langs) {
	?>

<tr>	
	<td>  
		<?php 
			echo $k;
			echo ('<input type="hidden" name="trans['.$index.'][key]" value="' . $k . '" size="40" class="text" />'); 	
		?> 
	</td>

	<td>
	<?php
			$langs[$klang] = limpia_textos($langs[$klang]);//despliega item del  file base
				if ($lang == $klang) {
							echo '<input type="text" name="trans['.$index.']['.$klang.']" value="'. $langs[$klang].'" size="40" class="text" />';
					} else {
						echo $langs[$klang];
//						echo ('<input type="hidden" name="trans['.$index.'][en]" value="'. $langs['en'] .'" size="40" class="text" />');
					}
		?>
	</td>

	<td <?php //if ($trans[$index][$klang]=='') {echo 'BGCOLOR="#00FFFF"';} #fix debe de cambiar si el valor del key en el archivo a modificar no esta definido?> >
		<?php
			$langs[$lang] = limpia_textos($langs[$lang]);;//despliega item del  file a modificar
				if ($lang !== $klang) {
					if (mb_strlen($langs[$lang]) < 50) {
							echo ('<input type="text" name="trans['.$index.']['. $lang. ']"value="'. $langs[$lang] .'" size="50" class="text" />');
						} else {
							$rows = round(mb_strlen($langs[$lang] / 50)) +1 ;
							echo ('<textarea name="trans[' . $index . ']['. $lang. ']" cols="60" class="small" rows="' . $rows . '">' . $langs[$lang] . '</textarea>');
						}
					} else {
						echo $langs[$lang] ;
//						echo ('<input type="hidden" name="trans['.$index.'][es]" value="'. $langs['es'] .'" size="40" class="text" />');
				}
		?>

	</td>
			<?php		$index++;	}	?>

	</tr>
</table>
		<input type="submit" value="<?php echo $loc->getText("admin-transSubmit");?>" class="button"  \n/>
<button type="submit" class="btn btn-default"><?php echo $loc->getText("admin-transSubmit");?></button>

	</form>
  <?php include("../shared/footer.php");
