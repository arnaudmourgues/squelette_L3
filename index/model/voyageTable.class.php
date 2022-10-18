<?php
// Inclusion de la classe voyage
require_once "voyage.class.php";

class voyageTable {

  public static function getVoyageByTrajet($trajet){
	  $em = dbconnection::getInstance()->getEntityManager();
	  $voyageRepository = $em->getRepository('voyage');

	  $voyage = $voyageRepository->findBy(array('trajet'=> $trajet ));

	  if ($voyage == false) echo 'Voyage non trouvé';
	  return $voyage;
  }

  
}


?>
