<?php

namespace AppBundle\Services;


use AppBundle\Entity\Product;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use AppBundle\Services\PricesCalculatorInterface;
use AppBundle\Services\SiteParameters;

/**
 * Class PricesCalculator
 * @package AppBundle\Services
 */
class PricesCalculator implements PricesCalculatorInterface
{

    /**
     * @var SiteParameters
     */
    private $siteParameters;

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var AuthorizationChecker
     */
    private $authorizationChecker;

    /**
     * @param SiteParameters $siteParameters
     * @param EntityManager $em
     */
    public function __construct(
        SiteParameters $siteParameters,
        AuthorizationChecker $authorizationChecker,
        EntityManager $em
    ) {
        $this->siteParameters = $siteParameters;
        $this->authorizationChecker = $authorizationChecker;
        $this->em = $em;
    }

    /**
     * @param Product $product
     * @return float
     */
    public function getPrice(Product $product)
    {
        return $product->getPrice() * $this->siteParameters->get('price_coefficient', 1);
    }

    /**
     * @param Product $product
     * @return float
     */
    public function getDiscountedPrice(Product $product)
    {
        if ($this->authorizationChecker->isGranted('ROLE_WHOLESALER')) {
            return $product->getWholesalePrice() ?: $product->getPrice();
        }

        return $this->getProductPrice($product);
    }
}
