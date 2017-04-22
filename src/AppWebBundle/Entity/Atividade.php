<?php

namespace AppWebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Atividade
 *
 * @ORM\Table(name="atividade")
 * @ORM\Entity(repositoryClass="AppWebBundle\Repository\AtividadeRepository")
 */
class Atividade extends Timestampable 
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255)
     * @Assert\NotBlank 
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text", nullable=true)
     */
    private $descricao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="prazo", type="datetime", nullable=true)
     */
    private $prazo;

    /**
     * @var Compromisso
     * 
     * @ORM\ManyToOne(targetEntity="AppWebBundle\Entity\Compromisso", inversedBy="atividade") 
     * @ORM\JoinColumn(name="compromisso_id", referencedColumnName="id", nullable=true) 
     */
    private $compromisso;

    /**
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity="AppWebBundle\Entity\User", inversedBy="atividade") 
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false) 
     */
    private $user;

    /** 
     * @return string 
     */ 
    public function __toString() 
    { 
        return $this->getNome(); 
    }
    

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return Atividade
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set descricao
     *
     * @param string $descricao
     *
     * @return Atividade
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set prazo
     *
     * @param \DateTime $prazo
     *
     * @return Atividade
     */
    public function setPrazo($prazo)
    {
        $this->prazo = $prazo;

        return $this;
    }

    /**
     * Get prazo
     *
     * @return \DateTime
     */
    public function getPrazo()
    {
        return $this->prazo;
    }

    /**
     * Set compromisso
     *
     * @param \AppWebBundle\Entity\Compromisso $compromisso
     *
     * @return Atividade
     */
    public function setCompromisso(\AppWebBundle\Entity\Compromisso $compromisso = null)
    {
        $this->compromisso = $compromisso;

        return $this;
    }

    /**
     * Get compromisso
     *
     * @return \AppWebBundle\Entity\Compromisso
     */
    public function getCompromisso()
    {
        return $this->compromisso;
    }

    /**
     * Set user
     *
     * @param \AppWebBundle\Entity\User $user
     *
     * @return Atividade
     */
    public function setUser(\AppWebBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppWebBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
