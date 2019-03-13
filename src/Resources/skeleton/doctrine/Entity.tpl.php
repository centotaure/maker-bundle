<?= "<?php\n" ?>

namespace <?= $namespace ?>;

<?php if ($api_resource): ?>use ApiPlatform\Core\Annotation\ApiResource;
<?php endif ?>
use Doctrine\ORM\Mapping as ORM;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
/**
<?php if ($api_resource): ?> * @ApiResource()
<?php endif ?>
 * @ORM\Table(name="centoweb_<?= $sql_name ?>")
 * @ORM\Entity(repositoryClass="<?= $repository_full_class_name ?>")
 */
class <?= $class_name."\n" ?>
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @GRID\Column(visible=false)
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
    * @var \DateTime
    *
    * @Gedmo\Timestampable(on="create")
    * @ORM\Column(name="created_at", type="datetime")
    * @GRID\Column(visible=false )
    */
    private $createdAt;
    
    /**
    * @var \DateTime
    *
    * @Gedmo\Timestampable(on="update")
    * @ORM\Column(name="updated_at", type="datetime")
    * @GRID\Column(visible=false )
    */
    private $updatedAt;

    /**
    * Set createdAt
    *
    * @param \DateTime $createdAt
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

}
