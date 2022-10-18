<?php

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity
 * @Table(name="jabaianb.voyage")
 */
class voyage{

    /** @Id @Column(type="integer")
     *  @GeneratedValue
     */
    public $id;

    /** @ManyToOne(targetEntity="utilisateur")
     * @JoinColumn(name="conducteur",referencedColumnName="id")
     */
    public $conducteur;

    /** @ManyToOne(targetEntity="trajet")
     * @JoinColumn(name="trajet",referencedColumnName="id")
     */
    public $trajet;

    /** @Column(type="int") */
    public $tarif;

    /** @Column(type="int") */
    public $nbPlace;

    /** @Column(type="int") */
    public $heureDepart;

    /** @Column(type="string", length=500) */
    public $contraintes;


}

?>
