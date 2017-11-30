<?php

namespace Thomas\TagBundle\Concern;

trait Taggable {


    /**
     * @var array
     * @ORM\ManyToMany(targetEntity="Thomas\TagBundle\Entity\Tag", cascade={"persist"})
     */
    private $tags;


    /**
     * Add tag
     *
     * @param \Thomas\TagBundle\Entity\Tag $tag
     *
     * @return Article
     */
    public function addTag(\Thomas\TagBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \Thomas\TagBundle\Entity\Tag $tag
     */
    public function removeTag(\Thomas\TagBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

}