<?php

namespace Padam87\AttributeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="attribute_definition")
 */
class Definition
{
    const TYPE_TEXT = 'text';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_CHOICE = 'choice';
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_RADIO = 'radio';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @var text
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=100)
     * @var string
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $unit;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $required = FALSE;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var string
     */
    private $orderIndex;

    /**
     * @ORM\ManyToOne(targetEntity="Schema", inversedBy="definitions")
     * @ORM\JoinColumn(name="schema_id", referencedColumnName="id")
     * @var Schema
     */
    private $schema;

    /**
     * @ORM\OneToMany(targetEntity="Option", mappedBy="definition", orphanRemoval=true, cascade={"persist", "remove"}, fetch="EXTRA_LAZY")
     * @ORM\OrderBy({"id" = "ASC"})
     * @var ArrayCollection
     */
    private $options;

    /**
     * @var \Padam87\AttributeBundle\Entity\Attribute
     *
     * @ORM\OneToMany(targetEntity="\Padam87\AttributeBundle\Entity\Attribute", mappedBy="definition", cascade={"remove"})
     */
    private $attributes;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default"=true})
     */
    private $visibleInExport;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", options={"default"=true})
     */
    private $visibleInListing;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->options = new \Doctrine\Common\Collections\ArrayCollection();
        $this->attributes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
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
     * Set name
     *
     * @param string $name
     * @return Definition
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Definition
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Definition
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set unit
     *
     * @param string $unit
     * @return Definition
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set required
     *
     * @param boolean $required
     * @return Definition
     */
    public function setRequired($required)
    {
        $this->required = $required;

        return $this;
    }

    /**
     * Get required
     *
     * @return boolean
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * Set orderIndex
     *
     * @param integer $orderIndex
     * @return Definition
     */
    public function setOrderIndex($orderIndex)
    {
        $this->orderIndex = $orderIndex;

        return $this;
    }

    /**
     * Get orderIndex
     *
     * @return integer
     */
    public function getOrderIndex()
    {
        return $this->orderIndex;
    }

    /**
     * Set schema
     *
     * @param \Padam87\AttributeBundle\Entity\Schema $schema
     * @return Definition
     */
    public function setSchema(\Padam87\AttributeBundle\Entity\Schema $schema = null)
    {
        $this->schema = $schema;

        return $this;
    }

    /**
     * Get schema
     *
     * @return \Padam87\AttributeBundle\Entity\Schema
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Add options
     *
     * @param \Padam87\AttributeBundle\Entity\Option $options
     * @return Definition
     */
    public function addOption(\Padam87\AttributeBundle\Entity\Option $option)
    {
        $this->options[] = $option;
        $option->setDefinition($this);

        return $this;
    }

    /**
     * Remove options
     *
     * @param \Padam87\AttributeBundle\Entity\Option $options
     */
    public function removeOption(\Padam87\AttributeBundle\Entity\Option $options)
    {
        $this->options->removeElement($options);
    }

    /**
     * Get options
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Add attributes
     *
     * @param \Padam87\AttributeBundle\Entity\Attribute $attributes
     */
    public function addAttribute(\Padam87\AttributeBundle\Entity\Attribute $attributes)
    {
        $this->attributes[] = $attributes;

        return $this;
    }

    /**
     * Remove attributes
     *
     * @param \Padam87\AttributeBundle\Entity\Attribute $attributes
     */
    public function removeAttribute(\Padam87\AttributeBundle\Entity\Attribute $attributes)
    {
        $this->attributes->removeElement($attributes);
    }

    /**
     * Get attributes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    public function isVisibleInListing()
    {
        return $this->visibleInListing;
    }

    public function setVisibleInListing($value)
    {
        $this->visibleInListing = $value;

        return $this;
    }

    public function isVisibleInExport()
    {
        return $this->visibleInExport;
    }

    public function setVisibleInExport($value)
    {
        $this->visibleInExport = $value;

        return $this;
    }

    public function isChoice()
    {
        return in_array($this->getType(), array(
            self::TYPE_CHOICE,
            self::TYPE_CHECKBOX,
            self::TYPE_RADIO,
        ));
    }
}
