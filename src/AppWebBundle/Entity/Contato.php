<?php

namespace AppWebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contato
 *
 * @ORM\Table(name="contato")
 * @ORM\Entity(repositoryClass="AppWebBundle\Repository\ContatoRepository")
 */
class Contato extends Timestampable 
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
     * @ORM\Column(name="nome", type="string", length=150)
     * @Assert\NotBlank 
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=150)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=14)
     */
    private $telefone;

    /**
     * @var Compromisso
     * 
     * @ORM\ManyToOne(targetEntity="AppWebBundle\Entity\Compromisso", inversedBy="contato") 
     * @ORM\JoinColumn(name="compromisso_id", referencedColumnName="id", nullable=true) 
     */
    private $compromisso;

    /**
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity="AppWebBundle\Entity\User", inversedBy="contato") 
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
     * @return Contato
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
     * Set email
     *
     * @param string $email
     *
     * @return Contato
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefone
     *
     * @param string $telefone
     *
     * @return Contato
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone
     *
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }

    /**
     * Set compromisso
     *
     * @param \AppWebBundle\Entity\Compromisso $compromisso
     *
     * @return Contato
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
     * @return Contato
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
