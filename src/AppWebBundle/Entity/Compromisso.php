<?php

namespace AppWebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert; 

/**
 * Compromisso
 *
 * @ORM\Table(name="compromisso")
 * @ORM\Entity(repositoryClass="AppWebBundle\Repository\CompromissoRepository")
 */
class Compromisso extends Timestampable 
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
     * @ORM\Column(name="descricao", type="text")
     */
    private $descricao;

    /**
     * @var string
     *
     * @ORM\Column(name="local", type="string", length=255)
     */
    private $local;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="datetime")
     * @Assert\NotBlank 
     */
    private $data;

    /** 
     * @var ArrayCollection 
     * 
     * @ORM\OneToMany(targetEntity="AppWebBundle\Entity\Atividade", mappedBy="compromisso", cascade={"remove"}) 
     */ 
    private $atividades;

    /** 
     * @var ArrayCollection 
     * 
     * @ORM\OneToMany(targetEntity="AppWebBundle\Entity\Contato", mappedBy="compromisso", cascade={"remove"}) 
     */ 
    private $contato;

    /**
     * @var User
     * 
     * @ORM\ManyToOne(targetEntity="AppWebBundle\Entity\User", inversedBy="compromisso") 
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false) 
     */
    private $user;

    /** 
     * Constructor 
     */ 
    public function __construct() 
    { 
        parent::__construct();
        
        $this->atividades = new ArrayCollection(); 
        $this->contato = new ArrayCollection(); 
    }

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
     * @return Compromisso
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
     * @return Compromisso
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
     * Set local
     *
     * @param string $local
     *
     * @return Compromisso
     */
    public function setLocal($local)
    {
        $this->local = $local;

        return $this;
    }

    /**
     * Get local
     *
     * @return string
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * Set data
     *
     * @param \DateTime $data
     *
     * @return Compromisso
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Add atividade
     *
     * @param \AppWebBundle\Entity\Atividade $atividade
     *
     * @return Compromisso
     */
    public function addAtividade(\AppWebBundle\Entity\Atividade $atividade)
    {
        $this->atividades[] = $atividade;

        return $this;
    }

    /**
     * Remove atividade
     *
     * @param \AppWebBundle\Entity\Atividade $atividade
     */
    public function removeAtividade(\AppWebBundle\Entity\Atividade $atividade)
    {
        $this->atividades->removeElement($atividade);
    }

    /**
     * Get atividades
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAtividades()
    {
        return $this->atividades;
    }

    /**
     * Add contato
     *
     * @param \AppWebBundle\Entity\Contato $contato
     *
     * @return Compromisso
     */
    public function addContato(\AppWebBundle\Entity\Contato $contato)
    {
        $this->contato[] = $contato;

        return $this;
    }

    /**
     * Remove contato
     *
     * @param \AppWebBundle\Entity\Contato $contato
     */
    public function removeContato(\AppWebBundle\Entity\Contato $contato)
    {
        $this->contato->removeElement($contato);
    }

    /**
     * Get contato
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContato()
    {
        return $this->contato;
    }

    /**
     * Set user
     *
     * @param \AppWebBundle\Entity\User $user
     *
     * @return Compromisso
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
