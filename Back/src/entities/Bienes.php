<?php
namespace App\entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bienes
 *
 * @ORM\Table(name="bienes")
 * @ORM\Entity
 */
class Bienes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="id_bien", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $idBien;

    /**
     * @var
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="Bienes")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getIdBien()
    {
        return $this->idBien;
    }

    /**
     * @param int $idBien
     */
    public function setIdBien($idBien)
    {
        $this->idBien = $idBien;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return \Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param \Users $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }


}