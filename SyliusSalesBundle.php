<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\SalesBundle;

use Sylius\Bundle\ResourceBundle\DependencyInjection\Compiler\ResolveDoctrineTargetEntitiesPass;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Bundle of sales system.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class SyliusSalesBundle extends Bundle
{
    /**
     * Return array of currently supported drivers.
     *
     * @return array
     */
    public static function getSupportedDrivers()
    {
        return array(
            SyliusResourceBundle::DRIVER_DOCTRINE_ORM
        );
    }

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $interfaces = array(
            'Sylius\Bundle\SalesBundle\Model\SellableInterface'   => 'sylius.model.sellable.class',
            'Sylius\Bundle\SalesBundle\Model\OrderInterface'      => 'sylius.model.order.class',
            'Sylius\Bundle\SalesBundle\Model\OrderItemInterface'  => 'sylius.model.order_item.class',
            'Sylius\Bundle\SalesBundle\Model\AdjustmentInterface' => 'sylius.model.adjustment.class',
        );

        $container->addCompilerPass(new ResolveDoctrineTargetEntitiesPass('sylius_sales', $interfaces));
    }
}
