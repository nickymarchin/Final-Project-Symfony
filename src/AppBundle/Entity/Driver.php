<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Driver
 *
 * @ORM\Table(name="drivers")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DriverRepository")
 */
class Driver
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
     * @ORM\Column(name="fullName", type="string", length=255)
     */
    private $fullName;

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer")
     */
    private $age;

    /**
     * @var string
     *
     * @ORM\Column(name="quote", type="string", length=255)
     */
    private $quote;

    /**
     * @var UploadedFile
     *
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    private $image;

    /**
     * @var ArrayCollection|Rating[]
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Rating", mappedBy="driver")
     *
     */
    private $ratings;

    /**
     * @var int
     *
     * @ORM\Column(name="ratingsCount", type="integer")
     */
    private $ratingsCount;

    public function __construct()
    {
        $this->ratings = new ArrayCollection();
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
     * Set fullName
     *
     * @param string $fullName
     *
     * @return Driver
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
     * Set age
     *
     * @param integer $age
     *
     * @return Driver
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set quote
     *
     * @param string $quote
     *
     * @return Driver
     */
    public function setQuote($quote)
    {
        $this->quote = $quote;

        return $this;
    }

    /**
     * Get quote
     *
     * @return string
     */
    public function getQuote()
    {
        return $this->quote;
    }

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
     * @return ArrayCollection|Rating[]
     */
    public function getRatings()
    {
        return $this->ratings;
    }

    /**
     * @param Rating $rating
     *
     * @return Driver
     */
    public function addRating(Rating $rating = null)
    {
        $this->ratings[] = $rating;
        return $this;
    }

    /**
     * @return int
     */
    public function getRatingsCount(): int
    {
        return $this->ratingsCount;
    }

    /**
     * @param int $ratingsCount
     */
    public function setRatingsCount(int $ratingsCount): void
    {
        $this->ratingsCount = $ratingsCount;
    }
}

