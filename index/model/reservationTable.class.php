<?php
// Inclusion de la classe reservation
require_once "reservation.class.php";

class reservationTable {

  public static function getReservationByVoyage($voyage){
	  $hemhem = dbconnection::getInstance()->getEntityManager();
	  $reservationRepository = $hemhem->getRepository('reservation');

	  $reservation = $reservationRepository->findBy(array('voyage'=> $voyage));

	  if ($reservation == false) echo 'Reservation non trouvé';
	  return $reservation;
  }

  
}


?>
