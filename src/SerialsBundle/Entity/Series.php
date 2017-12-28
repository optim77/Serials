<?php
/**
 * Created by PhpStorm.
 * User: NASA
 * Date: 2017-12-28
 * Time: 13:53
 */

namespace SerialsBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Imagine\Imagick\Imagine;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Imagine\Gd\Image;
use Imagine\Image\Box;
use Imagine\Image\Point;

/**
 * @ORM\Table(name="series")
 * @ORM\Entity(repositoryClass="SerialsBundle\Repository\SeriesRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Series
{


    const UPLOAD_DIR = 'uploads/series';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue=(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *     min=5,
     *     max=50
     *     )
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=120, unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=80)
     * @Assert\NotBlank
     */
    private $mainImage;

    /**
     * @var UploadedFile;
     *
     * @Assert\Image(
     *     minWidth=50,
     *     maxWidth=15000,
     *     minHeight=50,
     *     maxHeight=1500,
     *     maxSize="15M"
     * )
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $secondImage = null;

    /**
     * @var UploadedFile;
     *
     * @Assert\Image(
     *     minWidth=50,
     *     maxWidth=15000,
     *     minHeight=50,
     *     maxHeight=1500,
     *     maxSize="15M"
     * )
     */
    private $secondFile;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $thirdImage = null;

    /**
     * @var UploadedFile;
     *
     * @Assert\Image(
     *     minWidth=50,
     *     maxWidth=15000,
     *     minHeight=50,
     *     maxHeight=1500,
     *     maxSize="15M"
     * )
     */
    private $thirdFile;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $fourthImage = null;

    /**
     * @var UploadedFile;
     *
     * @Assert\Image(
     *     minWidth=50,
     *     maxWidth=15000,
     *     minHeight=50,
     *     maxHeight=1500,
     *     maxSize="15M"
     * )
     */
    private $fourthFile;

    /**
     * @ORM\Column(type="string", length=80, nullable=true)
     */
    private $fiveImage = null;

    /**
     * @var UploadedFile;
     *
     * @Assert\Image(
     *     minWidth=50,
     *     maxWidth=15000,
     *     minHeight=50,
     *     maxHeight=1500,
     *     maxSize="15M"
     * )
     */
    private $fiveFile;

    /**
     * @ORM\Column(type="integer", length=3)
     * @Assert\NotBlank
     */
    private $amountSeries;

    private $awards;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     */
    private $dateStart;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateEnd = null;

    private $actors;

    private $rate;

    private $mainTmp;

    private $secondTmp;

    private $thirdTmp;

    private $fourthTmp;

    private $fiveTmp;


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
     * Get title
     *
     * @return \String
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Series
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Series
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
     * Set mainImage
     *
     * @param string $mainImage
     *
     * @return Series
     */
    public function setMainImage($mainImage)
    {
        $this->mainImage = $mainImage;

        return $this;
    }

    /**
     * Get mainImage
     *
     * @return string
     */
    public function getMainImage()
    {
        return $this->mainImage;
    }

    /**
     * Set secondImage
     *
     * @param string $secondImage
     *
     * @return Series
     */
    public function setSecondImage($secondImage)
    {
        $this->secondImage = $secondImage;

        return $this;
    }

    /**
     * Get secondImage
     *
     * @return string
     */
    public function getSecondImage()
    {
        return $this->secondImage;
    }

    /**
     * Set thirdImage
     *
     * @param string $thirdImage
     *
     * @return Series
     */
    public function setThirdImage($thirdImage)
    {
        $this->thirdImage = $thirdImage;

        return $this;
    }

    /**
     * Get thirdImage
     *
     * @return string
     */
    public function getThirdImage()
    {
        return $this->thirdImage;
    }

    /**
     * Set fourthImage
     *
     * @param string $fourthImage
     *
     * @return Series
     */
    public function setFourthImage($fourthImage)
    {
        $this->fourthImage = $fourthImage;

        return $this;
    }

    /**
     * Get fourthImage
     *
     * @return string
     */
    public function getFourthImage()
    {
        return $this->fourthImage;
    }

    /**
     * Set fiveImage
     *
     * @param string $fiveImage
     *
     * @return Series
     */
    public function setFiveImage($fiveImage)
    {
        $this->fiveImage = $fiveImage;

        return $this;
    }

    /**
     * Get fiveImage
     *
     * @return string
     */
    public function getFiveImage()
    {
        return $this->fiveImage;
    }

    /**
     * Set amountSeries
     *
     * @param integer $amountSeries
     *
     * @return Series
     */
    public function setAmountSeries($amountSeries)
    {
        $this->amountSeries = $amountSeries;

        return $this;
    }

    /**
     * Get amountSeries
     *
     * @return integer
     */
    public function getAmountSeries()
    {
        return $this->amountSeries;
    }

    /**
     * Set dateStart
     *
     * @param \DateTime $dateStart
     *
     * @return Series
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return \DateTime
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     *
     * @return Series
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Series
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @ORM\PreSave
     * @ORM\PreUpdate
     */
    public function preSave(){

        if (null !== $this->getMainImage()){
            if (null !== $this->mainImage){
                $this->mainTmp = $this->mainImage;
            }
            $imageName = sha1(uniqid(null,true));
            $this->mainImage = $imageName.'.'.$this->getMainImage()->guessExtension();
        }

        if (null !== $this->getSecondImage()){
            if (null !== $this->secondImage){
                $this->secondTmp = $this->secondImage;
            }
            $imageName = sha1(uniqid(null,true));
            $this->secondImage = $imageName.'.'.$this->getSecondImage()->guessExtension();
        }

        if (null !== $this->getThirdImage()){
            if (null !== $this->thirdImage){
                $this->thirdTmp = $this->thirdImage;
            }
            $imageName = sha1(uniqid(null,true));
            $this->thirdImage = $imageName.'.'.$this->getThirdImage()->guessExtension();
        }

        if (null !== $this->getFourthImage()){
            if (null !== $this->fourthImage){
                $this->fourthTmp = $this->fourthImage;
            }
            $imageName = sha1(uniqid(null,true));
            $this->fourthImage = $imageName.'.'.$this->getFourthImage()->guessExtension();
        }

        if (null !== $this->getFiveImage()){
            if (null !== $this->fiveImage){
                $this->fiveTmp = $this->fiveImage;
            }
            $imageName = sha1(uniqid(null,true));
            $this->fiveImage = $imageName.'.'.$this->getFiveImage()->guessExtension();
        }

    }

    /**
     * @ORM\PostPersist
     * @ORM\PostUpdate
     */
    public function postSave(){
        if(null !== $this->getMainImage()){
            $this->getMainImage()->move($this->getUploadRootDir(),$this->mainImage);
            unset($this->mainImage);

            if (null !==  $this->mainTmp){
                unlink($this->getUploadRootDir().$this->mainTmp);
                unset($this->mainTmp);
            }
        }

        if(null !== $this->getSecondImage()){
            $this->getSecondImage()->move($this->getUploadRootDir(),$this->secondImage);
            unset($this->secondImage);

            if (null !==  $this->secondTmp){
                unlink($this->getUploadRootDir().$this->secondTmp);
                unset($this->secondTmp);
            }
        }

        if(null !== $this->getThirdImage()){
            $this->getThirdImage()->move($this->getUploadRootDir(),$this->thirdImage);
            unset($this->thirdImage);

            if (null !==  $this->thirdTmp){
                unlink($this->getUploadRootDir().$this->thirdTmp);
                unset($this->thirdTmp);
            }
        }

        if(null !== $this->getFourthImage()){
            $this->getFourthImage()->move($this->getUploadRootDir(),$this->fourthImage);
            unset($this->fourthTmp);

            if (null !==  $this->fourthTmp){
                unlink($this->getUploadRootDir().$this->fourthTmp);
                unset($this->fourthTmp);
            }
        }

        if(null !== $this->getFiveImage()){
            $this->getFiveImage()->move($this->getUploadRootDir(),$this->fiveImage);
            unset($this->fiveTmp);

            if (null !==  $this->fiveImage){
                unlink($this->getUploadRootDir().$this->fiveTmp);
                unset($this->fiveTmp);
            }
        }
    }

    protected function getUploadRootDir(){
        return __DIR__.'/../../../web/'.Products::UPLOAD_DIR;
    }
}
