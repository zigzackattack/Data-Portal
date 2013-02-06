<?php
$curr = $_GET['data'];

define("DRUPAL_ROOT", "/var/www/vhosts/biogeog.ucsb.edu");
require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$query = db_select('biogeog_portal_data','d');
	// Ged file id, file's parent id and title of the file.
	$query->fields('d',array('id','path'))
	// On first view, we will show directories starting at level 4.
		  ->condition('id',$id,'=');
	$results = $query->execute();

	$data = array();
	while($record = $results->fetchAssoc()) {
		header('Content-Disposition: image/tiff; filename="'.$record['title'].'"');
	    print(readfile($record['path']));
	}
} else {
	print("You haven't requested a directory id");
}
?>
