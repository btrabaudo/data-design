<?php


namespace Edu\Cnm\DataDesign;
require_once("autoload.php");

class Favorite {
    use ValidateDate;
    /**
     * id for favorite product id
     * @var int $favoriteProductId
     **/
      private $favoriteProductId;
    /**
     * id for favorite profile id
     * @var int $favoriteProfileId
     **/

      private $favoriteProfileId;

    /**
     * date for favorite date
     * @var \DateTime $favoriteDate
     **/

      private $favoriteDate;

    /**
     * constructor for favorite
     *
     * @param int|null $newFavoriteProductId
     * @param int|null $newFavoriteProfileId
     * @param \DateTime $favoriteDate
     *
     * @throws \InvalidArgumentException
     * @throws \RangeException
     * @throws \TypeError
     * @throws \Exception
     **/

    public function __construct(?int $newFavoriteProductId, ?int $newFavoriteProfileId, $newFavoriteDate = null){
        try {
            $this->setFavoriteProductId($newFavoriteProductId);
            $this->setFavoriteProfileId($newFavoriteProductId);
            $this->setFavoriteDate($newFavoriteDate);
        }

        catch (\InvalidArgumentException | \RangeException |\Exception | \TypeError $exception) {
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }
    }

    /**
     * acessor for favorite product id
     * @return int
     */
    public function getFavoriteProductId(): ?int {
        return ($this->favoriteProductId);
    }

    /**
     * @param int $newFavoriteProduct
     */
    public function setFavoriteProductId(?int $newFavoriteProductId) : void {

        if ($newFavoriteProductId === null) {
            $this->$newFavoriteProductId = null;
            return;
        }
        if ($newFavoriteProductId <= 0) {
            throw (new \RangeException("favorite product id is not positive"));
        }
        //Store this favorite product id

        $this->favoriteProductId = $newFavoriteProductId;
    }

    /**
     * @return int
     */
    public function getFavoriteProfileId(): ?int {
        return ($this->favoriteProfileId);
    }

    /**
     * @param int $favoriteProfileId
     */
    public function setFavoriteProfileId(?int $newFavoriteProfileId) {

        if ($newFavoriteProfileId === null) {
            $this->$newFavoriteProfileId = null;
            return;
        }

        if ($newFavoriteProfileId <= 0) {
            throw (new \RangeException("Favorite profile id is not positive"));
        }
        //Store this profile id
        $this->favoriteProfileId = $newFavoriteProfileId;
    }

    /**
     * @return \DateTime
     */
    public function getFavoriteDate(): \DateTime {
        return ($this->favoriteDate);
    }

    public function setFavoriteDate($newFavoriteDate = null) : void {
        if($newFavoriteDate === null) {
            $this->favoriteDate = new \DateTime();
            return;
        }

        try {
            $newFavoriteDate = self::validateDate($newFavoriteDate);
        } catch(\InvalidArgumentException | \RangeException $exception) {
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }
        $this->favoriteDate = $newFavoriteDate;
    }

}