<?php


namespace Edu\Cnm\DataDesign;
require_once("autoload.php");

class Favorite implements \JsonSerializable {
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
            $this->setFavortieProfileId($newFavoriteProductId);
            $this->setFavoriteDate($newFavoriteDate);
        }

        catch (\InvalidArgumentException | \RangeException |\Exception | \TypeError $exception) {
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }
    }


}