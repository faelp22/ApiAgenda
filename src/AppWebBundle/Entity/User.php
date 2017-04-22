<?php

namespace AppWebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * User
 *
 * @ORM\Table("system_users")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=true)
     */
    private $nome;

    /** 
     * @var ArrayCollection 
     * 
     * @ORM\OneToMany(targetEntity="AppWebBundle\Entity\Compromisso", mappedBy="user", cascade={"remove"}) 
     */ 
    private $compromisso;
    /** 
     * @var ArrayCollection 
     * 
     * @ORM\OneToMany(targetEntity="AppWebBundle\Entity\Atividade", mappedBy="user", cascade={"remove"}) 
     */ 
    private $atividade;

    /** 
     * @var ArrayCollection 
     * 
     * @ORM\OneToMany(targetEntity="AppWebBundle\Entity\Contato", mappedBy="user", cascade={"remove"}) 
     */ 
    private $contato;


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
     * @return string 
     */ 
    public function __toString() 
    { 
        if($this->getNome())
            return $this->getNome(); 
        return $this->getUsernameCanonical();

    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return User
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
     * Add compromisso
     *
     * @param \AppWebBundle\Entity\Compromisso $compromisso
     *
     * @return User
     */
    public function addCompromisso(\AppWebBundle\Entity\Compromisso $compromisso)
    {
        $this->compromisso[] = $compromisso;

        return $this;
    }

    /**
     * Remove compromisso
     *
     * @param \AppWebBundle\Entity\Compromisso $compromisso
     */
    public function removeCompromisso(\AppWebBundle\Entity\Compromisso $compromisso)
    {
        $this->compromisso->removeElement($compromisso);
    }

    /**
     * Get compromisso
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCompromisso()
    {
        return $this->compromisso;
    }

    /**
     * Add atividade
     *
     * @param \AppWebBundle\Entity\Atividade $atividade
     *
     * @return User
     */
    public function addAtividade(\AppWebBundle\Entity\Atividade $atividade)
    {
        $this->atividade[] = $atividade;

        return $this;
    }

    /**
     * Remove atividade
     *
     * @param \AppWebBundle\Entity\Atividade $atividade
     */
    public function removeAtividade(\AppWebBundle\Entity\Atividade $atividade)
    {
        $this->atividade->removeElement($atividade);
    }

    /**
     * Get atividade
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAtividade()
    {
        return $this->atividade;
    }

    /**
     * Add contato
     *
     * @param \AppWebBundle\Entity\Contato $contato
     *
     * @return User
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
}
