<?php

namespace PortWallet\Services;

/**
 * Services factory class for API resources in the root namespace.
 *
 * @property InvoiceService $invoice
 * @property RecurringService $recurring
 */
class CoreServiceFactory extends AbstractServiceFactory
{
    /**
     * @var array<string, string>
     */
    private static $classMap = [
        'invoice' => InvoiceService::class,
        'recurring' => RecurringService::class
    ];

    protected function getServiceClass($name)
    {
        return \array_key_exists($name, self::$classMap) ? self::$classMap[$name] : null;
    }
}
