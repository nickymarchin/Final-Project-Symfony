<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Article
 *
 * @ORM\Table(name="articles")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 */
class Article
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAdded", type="datetime")
     */
    private $dateAdded;

    /**
     * @var string
     */
    private $summary;

    /**
     * @var int
     *
     * @ORM\Column(name="authorId", type="integer")
     */
    private $authorId;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="articles")
     * @ORM\JoinColumn(name="authorId", referencedColumnName="id")
     */
    private $author;

    /**
     * @var UploadedFile
     *
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    private $image;

    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="viewCount", type="integer")
     */
    private $viewCount;

    /**
     * @var int
     *
     * @ORM\Column(name="likesCount", type="integer")
     */
    private $likesCount;


    /**
     * @var int
     *
     * @ORM\Column(name="dislikesCount", type="integer")
     */
    private $dislikesCount;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", mappedBy="likedArticles")
     *
     */
    private $usersLiked;

    /**
     * @var Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", mappedBy="dislikedArticles")
     *
     */
    private $usersDisliked;

    /**
     * @var ArrayCollection|Comment[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment", mappedBy="article")
     *
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", inversedBy="articles")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category_id;

//    /**
//     * @var int
//     *
//     *@ORM\Column(name="categoryId", type="integer")
//     */
//    private $categoryId;

    /**
     * @return integer
     */
    public function getViewCount()
    {
        return $this->viewCount;
    }

    /**
     * @param integer $viewCount
     */
    public function setViewCount($viewCount)
    {
        $this->viewCount = $viewCount;
    }

    public function __construct()
    {
        $this->dateAdded = new \DateTime('now');
        $this->usersLiked = new ArrayCollection();
        $this->usersDisliked = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    /**
     * @param \AppBundle\Entity\User $author
     *
     * @return Article
     */
    public function setAuthor(User $author = null)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return \AppBundle\Entity\User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param integer $authorId
     *
     * @return Article
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * @return int
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }


    /**
     * @param string
     */
    private function setSummary()
    {
        if (strlen($this->getContent()) < 200) {
            $this->summary = $this->getContent();
        } else {
            $this->summary = substr($this->getContent(), 0, strlen($this->getContent()) / 3) . "...";
        }

    }

    /**
     * @return string
     */
    public function getSummary()
    {
        if ($this->summary == null) {
            $this->setSummary();
        }

        return $this->summary;
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
     * Set title
     *
     * @param string $title
     *
     * @return Article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Article
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return Article
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * @return int
     */
    public function getLikesCount(): int
    {
        return $this->likesCount;
    }

    /**
     * @param int $likesCount
     */
    public function setLikesCount(int $likesCount): void
    {
        $this->likesCount = $likesCount;
    }

    /**
     * @param User $user
     *
     * @return Article
     */
    public function addUserLiked(User $user)
    {
        $this->usersLiked[] = $user;

        return $this;
    }

    /**
     * @param User $user
     *
     * @return Article
     */
    public function removeUserLiked(User $user)
    {
        $array = $this->getUsersLiked();
        unset($user, $array);

        return $this;
    }

    /**
     * @param User $user
     *
     * @return Article
     */
    public function addUserDisliked(User $user)
    {
        $this->usersDisliked[] = $user;

        return $this;
    }

    /**
     * @param User $user
     *
     * @return Article
     */
    public function removeUserDisliked(User $user)
    {
        $array = $this->getUsersDisliked();
        unset($user, $array);

        return $this;
    }

    /**
     * @return ArrayCollection|Comment[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param Comment $comment
     *
     * @return Article
     */
    public function addComment(Comment $comment = null)
    {
        $this->comments[] = $comment;
        return $this;
    }

    public function getCategory()
    {
        return $this->category_id;
    }

    /**
     * @param Category $category
     *
     * @return Article
     */
    public function setCategory(Category $category = null)
    {
        $this->category_id = $category;
        return $this;
    }

    /**
     * @return int
     */
    public function getDislikesCount(): int
    {
        return $this->dislikesCount;
    }

    /**
     * @param int $dislikesCount
     */
    public function setDislikesCount(int $dislikesCount): void
    {
        $this->dislikesCount = $dislikesCount;
    }

    public function getUsersLiked()
    {
        $liked = [];
        foreach ($this->usersLiked as $like) {

            /** @var Article $article */
            $liked[] = $like->getId();

        }

        return $liked;
    }

    public function getUsersDisliked()
    {
        $disliked = [];
        foreach ($this->usersLiked as $dislike) {

            /** @var Article $article */
            $disliked[] = $dislike->getId();

        }

        return $disliked;
    }
}

