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
    private $id_category;
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
    public function getIdCategory()
    {
        return $this->id_category;
    }

    /**
     * @param mixed $id_category
     */
    public function setIdCategory($id_category)
    {
        $this->id_category = $id_category;
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
     * @param $id_category
     * @param $measure
     */
    public function __construct($name, $amount, $datayt, $id_product, $id_category, $measure)
    {
        $this->name = $name;
        $this->amount = $amount;
        $this->datayt = $datayt;
        $this->id_product = $id_product;
        $this->id_category = $id_category;
        $this->measure = $measure;
    }

}