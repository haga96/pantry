<?php
/**
 * Created by PhpStorm.
 * User: hania
 * Date: 2018-02-13
 * Time: 14:04
 */

class Product
{
    private $name;
    private $amount;
    private $datayt;
    private $id_product;
    private $category_name;
    private $measure;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getDatayt()
    {
        return $this->datayt;
    }

    /**
     * @param mixed $datayt
     */
    public function setDatayt($datayt)
    {
        $this->datayt = $datayt;
    }

    /**
     * @return mixed
     */
    public function getIdProduct()
    {
        return $this->id_product;
    }

    /**
     * @param mixed $id_product
     */
    public function setIdProduct($id_product)
    {
        $this->id_product = $id_product;
    }

    /**
     * @return mixed
     */
    public function getCategoryName()
    {
        return $this->category_name;
    }

    /**
     * @param mixed $id_category
     */
    public function setCategoryName($category_name)
    {
        $this->category_name = $category_name;
    }

    /**
     * @return mixed
     */
    public function getMeasure()
    {
        return $this->measure;
    }

    /**
     * @param mixed $measure
     */
    public function setMeasure($measure)
    {
        $this->measure = $measure;
    }

    /**
     * Product constructor.
     * @param $name
     * @param $amount
     * @param $datayt
     * @param $id_product
     * @param $category_name
     * @param $measure
     */
    public function __construct($name, $amount, $datayt, $id_product, $category_name, $measure)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->datayt = $datayt;
        $this->id_product = $id_product;
        $this->category_name = $category_name;
        $this->measure = $measure;
    }

}