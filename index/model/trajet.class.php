<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="jabaianb.utilisateur")
 */
class trajet{

    /** @Id @Column(type="integer")
     *  @GeneratedValue
     */
    public $id;

    /** @Column(type="string", length=25) */
    public $depart;

    /** @Column(type="string", length=25) */
    public $arrivee;

    /** @Column(type="int") */
    public $distance;


}

?>
