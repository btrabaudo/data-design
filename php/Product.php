<?php
/**
 * Product Class for Data Design
 * author OED prop1@qed.net
 */

class Product {
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
     * @var string $productDate
     */
    private $productDate;

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

    public function setProductId(int $newProductId) : void {
        //enforce that product id is not null
        if ($newProductId === null) {
            $this->productId = null;
            return;

        }
        //enforce that product id is a positive int
        if ($newProductId <=0) {
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
    public function setProductContent(string $newProductContent) : void {
        //enforce that product content is not null
        if ($newProductContent === null) {
            $this->productContent = null;
            return;
        }
        //enforce alphanumeric in product content
        if (!ctype_alnum($newProductContent)){
            throw(new \InvalidArgumentException("product content must be alphanumeric"));
        }
        //enforce 128 characters in product content
        if (strlen($newProductContent) !== 128) {
            throw(new RangeException("product content must be 128 characters"));
        }
    /**
     * accessor for product price
     * @return
     */



    }




}