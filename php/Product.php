<?php
namespace Edu\Cnm\DataDesign;
require_once ("autoload.php");

/**
 * Product Class for Data Design
 * author OED prop1@qed.net
 */
class Product implements \jsonSerialize{
    /**
     * Id for product Id
     * @var int $productId
     */
    private $productId;
    /**
     * @var string $productContent
     */
    private $productContent;
    /**
     * @var float $productPrice
     */
    private $productPrice;
    /**
     * @var \DateTime $productDate
     */
    private $productDate;

    /**
     * constructor for this product
     *
     * @param int|null $newProductId
     * @param string $newProductContent
     * @param float $newProductPrice
     * @param \DateTime|string|null $newProductDate
     *
     * @throws \InvalidArgumentException
     * @throws \RangeException
     * @throws \TypeError
     * @throws \Exception
     */

    public function __construct(?int $newProductId, string $newProductContent, float $newProductPrice, $newProductDate = null) {
        try{
            $this->setProductId($newProductId);
            $this->setProductContent($newProductContent);
            $this->setProductPrice($newProductPrice);
            $this->setProductDate($newProductDate);
        }
        //determine the type of exception
        catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
            $exceptionType = get_class($exception);
                throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }
    }


    /**
     * accessor for product id
     * @return int|null $productId
     */
    public function getProductId(): ?int {
        return ($this->productId);
    }

    /**
     * mutator for product id
     * @param int|null for product id
     * @throws \RangeException if product id is not positive
     * @throws \InvalidArgumentException if product id is not an integer
     */

    public function setProductId(int $newProductId): void {
        //if product id is null return it
        if ($newProductId === null) {
            $this->productId = null;
            return;
        }
        //enforce that product id is a positive int
        if ($newProductId <= 0) {
            throw(new \RangeException("product id is not positive"));
        }
        //store this product id

        $this->productId = $newProductId;
    }

    /**
     * accessor for product content
     * @return string for product content
     */
    public function getProductContent(): string {
        return $this->productContent;
    }

    /**
     * mutator for product content
     * @param string $newProductContent
     * @throws \InvalidArgumentException if content is not alphanumeric
     * @throws \RangeException if product content is more than 128 characters
     */
    public function setProductContent(string $newProductContent): void {
        $newProductContent = filter_var($newProductContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        //enforce alphanumeric in product content
        if (!ctype_alnum($newProductContent)) {
            throw(new \InvalidArgumentException("product content must be alphanumeric"));
        }

        //enforce 128 characters in product content
        if (strlen($newProductContent) !== 128) {
            throw(new \RangeException("product content must be 128 characters"));
        }

        $this->productContent = $newProductContent;
    }

    /**
     * accessor for product price
     * @return float for product price
     */
    public
    function getProductPrice(): float {
        return $this->productPrice;
    }

    /**
     * mutator for product price
     * @param float $newProductPrice
     * @throw \RangeException if content is not positive
     */
    public function setProductPrice(float $newProductPrice): void {
        //enforce product price as a positive integer
        if ($newProductPrice < 0) {
            throw(new \InvalidArgumentException("product price must be positive"));
        }

        //store product price
        $this->productPrice = $newProductPrice;
    }

    /**
     * accessor method for product date
     * @return \DateTime value of product date
     */
    public function getProductDate(): \DateTime {
        return $this->productDate;
    }

    /**
     * @param \DateTime $productDate
     */
    public function setProductDate($newProductDate = null): void {
        if($newProductDate === null) {
            $this->productDate = new \DateTime();
            return;
        }
        try {
            $newProductDate = self::validateDateTime($newProductDate);
        } catch (\InvalidArgumentException | \RangeException  $exception) {
            $exceptionType = get_class($exception);
            throw(new $exceptionType($exception->getMessage(), 0, $exception));
        }
        $this->productDate = $newProductDate;
    }


/**
 * formats the state variables for JSON serialization
 *
 * @return array resulting state variables to serialize
 **/

    public function jsonSerialize() {
        $fields = get_object_vars($this);
        //format the sate so that the front end can consume it
        $fields["productDate"] = round(floatval($this->productDate->format("U.u")) * 1000);
        return($fields);
    }

}