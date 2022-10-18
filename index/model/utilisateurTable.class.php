<?php
// Inclusion de la classe utilisateur
require_once "utilisateur.class.php";


class utilisateurTable {

	public static function getUserByLoginAndPass($login, $pass)
	{
		$em = dbconnection::getInstance()->getEntityManager();
		$UserRepository = $em->getRepository('utilisateur');
		echo $login.$pass;
		$user = $UserRepository->findOneBy(array('identifiant' => $login, 'pass' => sha1($pass)));

			echo $user->identifiant;

		return $user;
	}

	public static function getUserById($id){
		$em = dbconnection::getInstance()->getEntityManager();
		$UserRepository = $em->getRepository('utilisateur');
	}

  
}


?>
