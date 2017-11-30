<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    protected  $username;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    protected  $plainPassword;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    protected $isActive;

    /**
     * @ORM\Column(name="picture", type="string", nullable=true)
     *
     * @Assert\File(
     *     maxSize = "2M",
     *     mimeTypes = {"image/jpg", "image/jpeg", "image/gif", "image/png"},
     *     mimeTypesMessage = "Non valid file format",
     *     uploadIniSizeErrorMessage = "To huge file",
     *     uploadErrorMessage = "Erreur dans l'upload du fichier"
     * )
     */
    private $picture;

    /**
     * @ORM\Column(name="createdAt", type="datetime")
     * @Assert\DateTime()
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     * @Assert\DateTime()
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Article", inversedBy="likes")
     * @ORM\JoinTable(name="article_like")
     *
     */
    private $articleLikes;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Article", inversedBy="wishes")
     * @ORM\JoinTable(name="article_wish")
     */
    private $articleWishes;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Article", inversedBy="watched")
     * @ORM\JoinTable(name="article_watch")
     *
     */
    private $articleWatcheds;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $role;

    /**
     * One User has Many Articles.
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Article", mappedBy="user")
     */
    private $articles;

    /**
     * One User has Many Comments.
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="user", cascade={"remove"})
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Category", inversedBy="likes")
     * @ORM\JoinTable(name="category_like")
     *
     */
    private $categoryLikes;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $mute;

    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid('', true));
        $this->createdAt = new \DateTime();
        $this->role = 1;
        $this->mute = false;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getSalt()
    {
// you *may* need a real salt depending on your encoder
// see section on salt below
        return null;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        $role = $this->role;
        if ($role == 2)
            return array('ROLE_ADMIN');
        else
            return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
// see section on salt below
// $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
// see section on salt below
// $this->salt
            ) = unserialize($serialized);
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($password)
    {
        $this->plainPassword = $password;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return User
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
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return User
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return User
     */
    public function setCreatedAt(\DateTime $createdAt)
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
     * @return User
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
     * Add articleLike
     *
     * @param \AppBundle\Entity\Article $articleLike
     *
     * @return User
     */
    public function addArticleLike(\AppBundle\Entity\Article $articleLike)
    {
        $this->articleLikes[] = $articleLike;

        return $this;
    }

    /**
     * Remove articleLike
     *
     * @param \AppBundle\Entity\Article $articleLike
     */
    public function removeArticleLike(\AppBundle\Entity\Article $articleLike)
    {
        $this->articleLikes->removeElement($articleLike);
    }

    /**
     * Get articleLikes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticleLikes()
    {
        return $this->articleLikes;
    }


    /**
     * Set role
     *
     * @param integer $role
     *
     * @return User
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return integer
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add comment
     *
     * @param \AppBundle\Entity\Comment $comment
     *
     * @return User
     */
    public function addComment(\AppBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \AppBundle\Entity\Comment $comment
     */
    public function removeComment(\AppBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return User
     */
    public function addArticle(\AppBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \AppBundle\Entity\Article $article
     */
    public function removeArticle(\AppBundle\Entity\Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add categoryLike
     *
     * @param \AppBundle\Entity\Category $categoryLike
     *
     * @return User
     */
    public function addCategoryLike(\AppBundle\Entity\Category $categoryLike)
    {
        $this->categoryLikes[] = $categoryLike;

        return $this;
    }

    /**
     * Remove categoryLike
     *
     * @param \AppBundle\Entity\Category $categoryLike
     */
    public function removeCategoryLike(\AppBundle\Entity\Category $categoryLike)
    {
        $this->categoryLikes->removeElement($categoryLike);
    }

    /**
     * Get categoryLikes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategoryLikes()
    {
        return $this->categoryLikes;
    }

    /**
     * Set mute
     *
     * @param boolean $mute
     *
     * @return User
     */
    public function setMute($mute)
    {
        $this->mute = $mute;

        return $this;
    }

    /**
     * Get mute
     *
     * @return boolean
     */
    public function getMute()
    {
        return $this->mute;
    }

    /**
     * Add articleWatched
     *
     * @param \AppBundle\Entity\Article $articleWatched
     *
     * @return User
     */
    public function addArticleWatched(\AppBundle\Entity\Article $articleWatched)
    {
        $this->articleWatcheds[] = $articleWatched;

        return $this;
    }

    /**
     * Remove articleWatched
     *
     * @param \AppBundle\Entity\Article $articleWatched
     */
    public function removeArticleWatched(\AppBundle\Entity\Article $articleWatched)
    {
        $this->articleWatcheds->removeElement($articleWatched);
    }

    /**
     * Get articleWatcheds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticleWatcheds()
    {
        return $this->articleWatcheds;
    }


    /**
     * Add articleWish
     *
     * @param \AppBundle\Entity\Article $articleWish
     *
     * @return User
     */
    public function addArticleWish(\AppBundle\Entity\Article $articleWish)
    {
        $this->articleWishes[] = $articleWish;

        return $this;
    }

    /**
     * Remove articleWish
     *
     * @param \AppBundle\Entity\Article $articleWish
     */
    public function removeArticleWish(\AppBundle\Entity\Article $articleWish)
    {
        $this->articleWishes->removeElement($articleWish);
    }

    /**
     * Get articleWishes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticleWishes()
    {
        return $this->articleWishes;
    }
}
