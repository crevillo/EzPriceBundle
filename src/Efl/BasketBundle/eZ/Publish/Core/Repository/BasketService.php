<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 23/09/14
 * Time: 12:34
 */

namespace Efl\BasketBundle\eZ\Publish\Core\Repository;

use Efl\BasketBundle\eZ\Publish\Core\Persistence\Legacy\Basket\Handler as BasketHandler;
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Basket;
use Efl\BasketBundle\eZ\Publish\Core\Repository\Values\BasketItem;
use eZ\Publish\API\Repository\ContentService;

class BasketService
{
    /**
     * @var BasketHandler
     */
    protected $basketHandler;

    protected $contentService;

    private $basket = null;

    public function __construct(
        BasketHandler $basketHandler,
        ContentService $contentService
    )
    {
        $this->basketHandler = $basketHandler;
        $this->contentService = $contentService;
    }

    public function getRelatedPurchasedListForContentIds( $contentIds, $limit )
    {
        return $this->basketHandler->getRelatedPurchasedListForContentIds( $contentIds, $limit );
    }

    /**
     * Obtiene la cesta actual.
     *
     * @param $byOrderId
     *
     * @return \Efl\BasketBundle\eZ\Publish\Core\Repository\Values\Basket
     */
    public function getCurrentBasket( $byOrderId = -1 )
    {
        if ( $this->basket != null )
        {
            return $this->basket;
        }

        $data = $this->basketHandler->currentBasket( $byOrderId );

        $basketItems = $this->basketHandler->getItemsByProductCollectionId( $data['productCollectionId'] );

        $items = array();

        foreach( $basketItems as $basketItem )
        {
            print_r( $basketItem );
            $items[] = new BasketItem( $basketItem );
        }

        $basket = new Basket( $data );
        $basket->setItems( $items );

        return $basket;

    }

    /**
     * Añadir producto a la cesta
     *
     * @param $contentId
     * @param array $optionList
     * @param int $quantity
     *
     * @return \Efl\BasketBundle\eZ\Publish\Core\Repository\Values\BasketItem
     */
    public function addProductToBasket( $contentId, array $optionList = array(), $quantity = 1 )
    {
        $basketItem = $this->basketHandler->addProductToBasket( $contentId, $optionList, $quantity );
        return new BasketItem(
            $basketItem
        );
    }

    /**
     * Determinar si el producto ya está o no en la cesta
     *
     * @param $contentId
     *
     * @return bool
     */
    public function isProductInBasket( $contentId )
    {
        $items = $this->getCurrentBasket()->getItems();

        foreach ( $items as $item )
        {
            if ( $item->getContent()->id == $contentId )
            {
                return true;
            }
        }

        return false;
    }

    /**
     * Quita el producto de la cesta
     *
     * @param $contentId
     */
    public function removeProductFromBasket( $contentId )
    {
        $this->basketHandler->removeProductFromBasket( $contentId );
    }
}
