<?php

declare(strict_types=1);

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LocaleRedirectListener
{
    private $defaultLocale;
    private $supportedLocales;

    public function __construct($defaultLocale, $supportedLocales)
    {
        $this->defaultLocale =  $defaultLocale;
        $this->supportedLocales = $supportedLocales;
    }

    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();
        $path = $request->getPathInfo();

        if (0 === strpos($path, '/_')) {
            return;
        }

        $localePattern = sprintf('/^\/(%s)\b/', implode('|', $this->supportedLocales));

        // Проверяем, начинается ли путь с одной из поддерживаемых локалей
        if (!preg_match($localePattern, $path)) {
            // Редирект на URL с локалью по умолчанию
            $newPath = '/' . $this->defaultLocale . $path;
            $response = new RedirectResponse($newPath, 301);
            $event->setResponse($response);
        }
    }
}
