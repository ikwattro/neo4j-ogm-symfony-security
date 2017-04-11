<?php

namespace AppBundle\Entity;

use GraphAware\Neo4j\OGM\Annotations as OGM;

/**
 * @OGM\Node(label="Role")
 */
class Role
{
    /**
     * @var int
     *
     * @OGM\GraphId()
     */
    protected $id;

    /**
     * @var string
     *
     * @OGM\Property(type="string")
     */
    protected $name;

    /**
     * @var User[]
     *
     * @OGM\Relationship(type="HAS_ROLE", direction="INCOMING", mappedBy="roles", collection=true, targetEntity="User")
     */
    protected $users;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return User[]
     */
    public function getUsers()
    {
        return $this->users;
    }
}