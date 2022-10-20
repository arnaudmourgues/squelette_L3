<?php
// Inclusion de la classe utilisateur
require_once "utilisateur.class.php";


class utilisateurTable
{

    public static function getUserByLoginAndPass($login, $pass)
    {
        $em = dbconnection::getInstance()->getEntityManager();
        $UserRepository = $em->getRepository('utilisateur');
        $user = $UserRepository->findOneBy(array('identifiant' => $login, 'pass' => sha1($pass)));
        return $user;
    }

    public static function getUserById($id)
    {
        $em = dbconnection::getInstance()->getEntityManager();
        $UserRepository = $em->getRepository('utilisateur');
        $user = $UserRepository->findOneBy(array('id' => $id));
        if ($user == false) {
            echo 'Compte invalide';
        }
        return $user;
    }


}


?>
