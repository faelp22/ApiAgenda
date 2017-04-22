<?php 
 
namespace AppWebBundle\Entity; 
 
use Doctrine\ORM\Mapping as ORM; 
use Symfony\Component\Validator\Constraints as Assert; 
 
/** 
 * Timestampable abstract class 
 * @ORM\MappedSuperclass 
 */ 
abstract class Timestampable 
{ 
    /** 
     * @var \DateTime 
     * 
     * @ORM\Column(name="created_at", type="datetime") 
     * @Assert\NotBlank 
     */ 
    private $createdAt; 
 
    /** 
     * @var \DateTime 
     * 
     * @ORM\Column(name="updated_at", type="datetime") 
     * @Assert\NotBlank 
     */ 
    private $updatedAt; 

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;
 
    /** 
     * Construct 
     */ 
    public function __construct() 
    { 
        $this->status = 0;
        $this->createdAt = new \DateTime('now'); 
        $this->updatedAt = new \DateTime('now'); 
    } 
 

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Timestampable
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Timestampable
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Timestampable
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }
}
