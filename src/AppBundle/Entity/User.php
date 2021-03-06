<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="fullName", type="string", length=255)
     */
    private $fullName;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 255,
     *      minMessage = "Password must be at least {{ limit }} characters long",
     *      maxMessage = "Password cannot be longer than {{ limit }} characters"
     * )
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Article", mappedBy="author")
     */
    private $articles;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Role")
     * @ORM\JoinTable(name="users_roles",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *     )
     *
     */
    private $roles;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Article", cascade={"persist","remove"})
     * @ORM\JoinTable(name="users_likes",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id", onDelete="CASCADE")}
     *     )
     */
    private $likedArticles;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Article", cascade={"persist","remove"})
     * @ORM\JoinTable(name="users_dislikes",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="article_id", referencedColumnName="id", onDelete="CASCADE")}
     *     )
     */
    private $dislikedArticles;

    /**
     * @var ArrayCollection|Comment[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="author")
     */
    private $comments;

    /**
     * @var ArrayCollection|Rating[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rating", mappedBy="author")
     */
    private $driverRatings;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->roles = new ArrayCollection();
        $this->likedArticles = new ArrayCollection();
        $this->dislikedArticles = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->driverRatings = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
     * Set fullName
     *
     * @param string $fullName
     *
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
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
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getRoles()
    {
        $stringRoles = [];
        foreach ($this->roles as $role) {

            /** @var $role Role */
            $stringRoles[] = $role->getRole();

        }

        return $stringRoles;
    }

    /**
     * @param Role $role
     *
     * @return User
     *
     */
    public function addRole(Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param \AppBundle\Entity\Article $article
     *
     * @return User
     */
    public function addPost(Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * @return bool
     */
    public function isAdmin()
    {
        return in_array("ROLE_ADMIN", $this->getRoles());
    }

    /**
     * @param Article $article
     *
     * @return bool
     *
     */
    public function isAuthor(Article $article)
    {
        return $article->getAuthorId() == $this->getId();
    }

    public function getLikedArticles()
    {
        $liked = [];
        foreach ($this->likedArticles as $article) {

            /** @var Article $article */
            $liked[] = $article->getId();

        }

        return $liked;
    }

    /**
     * @param Article $article
     *
     * @return User
     */
    public function addLike(Article $article)
    {
        $this->likedArticles[] = $article;

        return $this;
    }

    public function getDislikedArticles()
    {
        $disliked = [];
        foreach ($this->dislikedArticles as $article) {

            /** @var Article $article */
            $disliked[] = $article->getId();

        }

        return $disliked;
    }

    /**
     * @param Article $article
     *
     * @return User
     */
    public function addDislike(Article $article)
    {
        $this->dislikedArticles[] = $article;

        return $this;
    }

    /**
     * @return ArrayCollection|Comment[]
     */
    public function getComments(): ArrayCollection
    {
        return $this->comments;
    }

    /**
     * @param Comment $comment
     *
     * @return User
     */
    public function addComment(Comment $comment = null)
    {
        $this->comments[] = $comment;
        return $this;
    }

    /**
     * @return ArrayCollection|Rating[]
     */
    public function getDriverRatings()
    {
        return $this->driverRatings;
    }

    /**
     * @param Rating $rating
     *
     * @return User
     */
    public function addDriverRating(Rating $rating = null)
    {
        $this->driverRatings[] = $rating;
        return $this;
    }

    public function removeLikedArticle(Article $article){
        $this->likedArticles->removeElement($article);
    }

    public function removeDislikedArticle(Article $article){
        $this->dislikedArticles->removeElement($article);
    }

    function __toString()
    {
        return $this->fullName;
    }
}

