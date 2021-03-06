<?php namespace PhilipBrown\Basket\MetaData;

use Money\Money;
use Money\Currency;
use PhilipBrown\Basket\Basket;
use PhilipBrown\Basket\MetaData;
use PhilipBrown\Basket\Reconciler;

class DeliveryMetaData implements MetaData
{
    /**
     * @var Reconciler
     */
    private $reconciler;

    /**
     * Create a new Delivery MetaData
     *
     * @param Reconciler $reconciler
     * @return void
     */
    public function __construct(Reconciler $reconciler)
    {
        $this->reconciler = $reconciler;
    }

    /**
     * Generate the Meta Data
     *
     * @param Basket $basket
     * @return mixed
     */
    public function generate(Basket $basket)
    {
        $total = new Money(0, $basket->currency());

        foreach ($basket->products() as $product) {
            $total = $total->add($this->reconciler->delivery($product));
        }

        return $total;
    }

    /**
     * Return the name of the Meta Data
     *
     * @return string
     */
    public function name()
    {
        return 'delivery';
    }
}
