<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/valorizzazionecampo')) {
            if (0 === strpos($pathinfo, '/valorizzazionecamporichiesta')) {
                // valorizzazionecamporichiesta
                if (rtrim($pathinfo, '/') === '/valorizzazionecamporichiesta') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'valorizzazionecamporichiesta');
                    }

                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\ValorizzazionecamporichiestaController::indexAction',  '_route' => 'valorizzazionecamporichiesta',);
                }

                // valorizzazionecamporichiesta_show
                if (preg_match('#^/valorizzazionecamporichiesta/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'valorizzazionecamporichiesta_show')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\ValorizzazionecamporichiestaController::showAction',));
                }

                // valorizzazionecamporichiesta_new
                if ($pathinfo === '/valorizzazionecamporichiesta/new') {
                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\ValorizzazionecamporichiestaController::newAction',  '_route' => 'valorizzazionecamporichiesta_new',);
                }

                // valorizzazionecamporichiesta_create
                if ($pathinfo === '/valorizzazionecamporichiesta/create') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_valorizzazionecamporichiesta_create;
                    }

                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\ValorizzazionecamporichiestaController::createAction',  '_route' => 'valorizzazionecamporichiesta_create',);
                }
                not_valorizzazionecamporichiesta_create:

                // valorizzazionecamporichiesta_edit
                if (preg_match('#^/valorizzazionecamporichiesta/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'valorizzazionecamporichiesta_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\ValorizzazionecamporichiestaController::editAction',));
                }

                // valorizzazionecamporichiesta_update
                if (preg_match('#^/valorizzazionecamporichiesta/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                        $allow = array_merge($allow, array('POST', 'PUT'));
                        goto not_valorizzazionecamporichiesta_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'valorizzazionecamporichiesta_update')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\ValorizzazionecamporichiestaController::updateAction',));
                }
                not_valorizzazionecamporichiesta_update:

                // valorizzazionecamporichiesta_delete
                if (preg_match('#^/valorizzazionecamporichiesta/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                        $allow = array_merge($allow, array('POST', 'DELETE'));
                        goto not_valorizzazionecamporichiesta_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'valorizzazionecamporichiesta_delete')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\ValorizzazionecamporichiestaController::deleteAction',));
                }
                not_valorizzazionecamporichiesta_delete:

            }

            if (0 === strpos($pathinfo, '/valorizzazionecampodocumento')) {
                // valorizzazionecampodocumento
                if (rtrim($pathinfo, '/') === '/valorizzazionecampodocumento') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'valorizzazionecampodocumento');
                    }

                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\ValorizzazionecampodocumentoController::indexAction',  '_route' => 'valorizzazionecampodocumento',);
                }

                // valorizzazionecampodocumento_show
                if (preg_match('#^/valorizzazionecampodocumento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'valorizzazionecampodocumento_show')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\ValorizzazionecampodocumentoController::showAction',));
                }

                // valorizzazionecampodocumento_new
                if ($pathinfo === '/valorizzazionecampodocumento/new') {
                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\ValorizzazionecampodocumentoController::newAction',  '_route' => 'valorizzazionecampodocumento_new',);
                }

                // valorizzazionecampodocumento_create
                if ($pathinfo === '/valorizzazionecampodocumento/create') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_valorizzazionecampodocumento_create;
                    }

                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\ValorizzazionecampodocumentoController::createAction',  '_route' => 'valorizzazionecampodocumento_create',);
                }
                not_valorizzazionecampodocumento_create:

                // valorizzazionecampodocumento_edit
                if (preg_match('#^/valorizzazionecampodocumento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'valorizzazionecampodocumento_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\ValorizzazionecampodocumentoController::editAction',));
                }

                // valorizzazionecampodocumento_update
                if (preg_match('#^/valorizzazionecampodocumento/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                        $allow = array_merge($allow, array('POST', 'PUT'));
                        goto not_valorizzazionecampodocumento_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'valorizzazionecampodocumento_update')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\ValorizzazionecampodocumentoController::updateAction',));
                }
                not_valorizzazionecampodocumento_update:

                // valorizzazionecampodocumento_delete
                if (preg_match('#^/valorizzazionecampodocumento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                        $allow = array_merge($allow, array('POST', 'DELETE'));
                        goto not_valorizzazionecampodocumento_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'valorizzazionecampodocumento_delete')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\ValorizzazionecampodocumentoController::deleteAction',));
                }
                not_valorizzazionecampodocumento_delete:

            }

        }

        if (0 === strpos($pathinfo, '/utente')) {
            if (0 === strpos($pathinfo, '/utentegruppoutente')) {
                // utentegruppoutente
                if (rtrim($pathinfo, '/') === '/utentegruppoutente') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'utentegruppoutente');
                    }

                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\UtentegruppoutenteController::indexAction',  '_route' => 'utentegruppoutente',);
                }

                // utentegruppoutente_show
                if (preg_match('#^/utentegruppoutente/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'utentegruppoutente_show')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\UtentegruppoutenteController::showAction',));
                }

                // utentegruppoutente_new
                if ($pathinfo === '/utentegruppoutente/new') {
                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\UtentegruppoutenteController::newAction',  '_route' => 'utentegruppoutente_new',);
                }

                // utentegruppoutente_create
                if ($pathinfo === '/utentegruppoutente/create') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_utentegruppoutente_create;
                    }

                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\UtentegruppoutenteController::createAction',  '_route' => 'utentegruppoutente_create',);
                }
                not_utentegruppoutente_create:

                // utentegruppoutente_edit
                if (preg_match('#^/utentegruppoutente/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'utentegruppoutente_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\UtentegruppoutenteController::editAction',));
                }

                // utentegruppoutente_update
                if (preg_match('#^/utentegruppoutente/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                        $allow = array_merge($allow, array('POST', 'PUT'));
                        goto not_utentegruppoutente_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'utentegruppoutente_update')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\UtentegruppoutenteController::updateAction',));
                }
                not_utentegruppoutente_update:

                // utentegruppoutente_delete
                if (preg_match('#^/utentegruppoutente/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                        $allow = array_merge($allow, array('POST', 'DELETE'));
                        goto not_utentegruppoutente_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'utentegruppoutente_delete')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\UtentegruppoutenteController::deleteAction',));
                }
                not_utentegruppoutente_delete:

            }

            // utente
            if (rtrim($pathinfo, '/') === '/utente') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'utente');
                }

                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\UtenteController::indexAction',  '_route' => 'utente',);
            }

            // utente_show
            if (preg_match('#^/utente/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'utente_show')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\UtenteController::showAction',));
            }

            // utente_new
            if ($pathinfo === '/utente/new') {
                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\UtenteController::newAction',  '_route' => 'utente_new',);
            }

            // utente_create
            if ($pathinfo === '/utente/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_utente_create;
                }

                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\UtenteController::createAction',  '_route' => 'utente_create',);
            }
            not_utente_create:

            // utente_edit
            if (preg_match('#^/utente/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'utente_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\UtenteController::editAction',));
            }

            // utente_update
            if (preg_match('#^/utente/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                    $allow = array_merge($allow, array('POST', 'PUT'));
                    goto not_utente_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'utente_update')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\UtenteController::updateAction',));
            }
            not_utente_update:

            // utente_delete
            if (preg_match('#^/utente/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                    $allow = array_merge($allow, array('POST', 'DELETE'));
                    goto not_utente_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'utente_delete')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\UtenteController::deleteAction',));
            }
            not_utente_delete:

        }

        if (0 === strpos($pathinfo, '/richiesta')) {
            if (0 === strpos($pathinfo, '/richiestautente')) {
                // richiestautente
                if (rtrim($pathinfo, '/') === '/richiestautente') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'richiestautente');
                    }

                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestautenteController::indexAction',  '_route' => 'richiestautente',);
                }

                // richiestautente_show
                if (preg_match('#^/richiestautente/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'richiestautente_show')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestautenteController::showAction',));
                }

                // richiestautente_new
                if ($pathinfo === '/richiestautente/new') {
                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestautenteController::newAction',  '_route' => 'richiestautente_new',);
                }

                // richiestautente_create
                if ($pathinfo === '/richiestautente/create') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_richiestautente_create;
                    }

                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestautenteController::createAction',  '_route' => 'richiestautente_create',);
                }
                not_richiestautente_create:

                // richiestautente_edit
                if (preg_match('#^/richiestautente/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'richiestautente_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestautenteController::editAction',));
                }

                // richiestautente_update
                if (preg_match('#^/richiestautente/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                        $allow = array_merge($allow, array('POST', 'PUT'));
                        goto not_richiestautente_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'richiestautente_update')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestautenteController::updateAction',));
                }
                not_richiestautente_update:

                // richiestautente_delete
                if (preg_match('#^/richiestautente/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                        $allow = array_merge($allow, array('POST', 'DELETE'));
                        goto not_richiestautente_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'richiestautente_delete')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestautenteController::deleteAction',));
                }
                not_richiestautente_delete:

            }

            if (0 === strpos($pathinfo, '/richiestadocumento')) {
                // richiestadocumento
                if (rtrim($pathinfo, '/') === '/richiestadocumento') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'richiestadocumento');
                    }

                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestadocumentoController::indexAction',  '_route' => 'richiestadocumento',);
                }

                // richiestadocumento_show
                if (preg_match('#^/richiestadocumento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'richiestadocumento_show')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestadocumentoController::showAction',));
                }

                // richiestadocumento_new
                if ($pathinfo === '/richiestadocumento/new') {
                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestadocumentoController::newAction',  '_route' => 'richiestadocumento_new',);
                }

                // richiestadocumento_create
                if ($pathinfo === '/richiestadocumento/create') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_richiestadocumento_create;
                    }

                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestadocumentoController::createAction',  '_route' => 'richiestadocumento_create',);
                }
                not_richiestadocumento_create:

                // richiestadocumento_edit
                if (preg_match('#^/richiestadocumento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'richiestadocumento_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestadocumentoController::editAction',));
                }

                // richiestadocumento_update
                if (preg_match('#^/richiestadocumento/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                        $allow = array_merge($allow, array('POST', 'PUT'));
                        goto not_richiestadocumento_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'richiestadocumento_update')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestadocumentoController::updateAction',));
                }
                not_richiestadocumento_update:

                // richiestadocumento_delete
                if (preg_match('#^/richiestadocumento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                        $allow = array_merge($allow, array('POST', 'DELETE'));
                        goto not_richiestadocumento_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'richiestadocumento_delete')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestadocumentoController::deleteAction',));
                }
                not_richiestadocumento_delete:

            }

            // richiesta
            if (rtrim($pathinfo, '/') === '/richiesta') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'richiesta');
                }

                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestaController::indexAction',  '_route' => 'richiesta',);
            }

            // richiesta_show
            if (preg_match('#^/richiesta/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'richiesta_show')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestaController::showAction',));
            }

            // richiesta_new
            if ($pathinfo === '/richiesta/new') {
                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestaController::newAction',  '_route' => 'richiesta_new',);
            }

            // richiesta_create
            if ($pathinfo === '/richiesta/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_richiesta_create;
                }

                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestaController::createAction',  '_route' => 'richiesta_create',);
            }
            not_richiesta_create:

            // richiesta_edit
            if (preg_match('#^/richiesta/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'richiesta_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestaController::editAction',));
            }

            // richiesta_update
            if (preg_match('#^/richiesta/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                    $allow = array_merge($allow, array('POST', 'PUT'));
                    goto not_richiesta_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'richiesta_update')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestaController::updateAction',));
            }
            not_richiesta_update:

            // richiesta_delete
            if (preg_match('#^/richiesta/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                    $allow = array_merge($allow, array('POST', 'DELETE'));
                    goto not_richiesta_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'richiesta_delete')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestaController::deleteAction',));
            }
            not_richiesta_delete:

        }

        if (0 === strpos($pathinfo, '/gruppoutente')) {
            // gruppoutente
            if (rtrim($pathinfo, '/') === '/gruppoutente') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'gruppoutente');
                }

                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\GruppoutenteController::indexAction',  '_route' => 'gruppoutente',);
            }

            // gruppoutente_show
            if (preg_match('#^/gruppoutente/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'gruppoutente_show')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\GruppoutenteController::showAction',));
            }

            // gruppoutente_new
            if ($pathinfo === '/gruppoutente/new') {
                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\GruppoutenteController::newAction',  '_route' => 'gruppoutente_new',);
            }

            // gruppoutente_create
            if ($pathinfo === '/gruppoutente/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_gruppoutente_create;
                }

                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\GruppoutenteController::createAction',  '_route' => 'gruppoutente_create',);
            }
            not_gruppoutente_create:

            // gruppoutente_edit
            if (preg_match('#^/gruppoutente/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'gruppoutente_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\GruppoutenteController::editAction',));
            }

            // gruppoutente_update
            if (preg_match('#^/gruppoutente/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                    $allow = array_merge($allow, array('POST', 'PUT'));
                    goto not_gruppoutente_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'gruppoutente_update')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\GruppoutenteController::updateAction',));
            }
            not_gruppoutente_update:

            // gruppoutente_delete
            if (preg_match('#^/gruppoutente/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                    $allow = array_merge($allow, array('POST', 'DELETE'));
                    goto not_gruppoutente_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'gruppoutente_delete')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\GruppoutenteController::deleteAction',));
            }
            not_gruppoutente_delete:

        }

        if (0 === strpos($pathinfo, '/documento')) {
            // documento
            if (rtrim($pathinfo, '/') === '/documento') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'documento');
                }

                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\DocumentoController::indexAction',  '_route' => 'documento',);
            }

            // documento_show
            if (preg_match('#^/documento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'documento_show')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\DocumentoController::showAction',));
            }

            // documento_new
            if ($pathinfo === '/documento/new') {
                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\DocumentoController::newAction',  '_route' => 'documento_new',);
            }

            // documento_create
            if ($pathinfo === '/documento/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_documento_create;
                }

                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\DocumentoController::createAction',  '_route' => 'documento_create',);
            }
            not_documento_create:

            // documento_edit
            if (preg_match('#^/documento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'documento_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\DocumentoController::editAction',));
            }

            // documento_update
            if (preg_match('#^/documento/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                    $allow = array_merge($allow, array('POST', 'PUT'));
                    goto not_documento_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'documento_update')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\DocumentoController::updateAction',));
            }
            not_documento_update:

            // documento_delete
            if (preg_match('#^/documento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                    $allow = array_merge($allow, array('POST', 'DELETE'));
                    goto not_documento_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'documento_delete')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\DocumentoController::deleteAction',));
            }
            not_documento_delete:

        }

        if (0 === strpos($pathinfo, '/ca')) {
            if (0 === strpos($pathinfo, '/categoria')) {
                if (0 === strpos($pathinfo, '/categoriagruppo')) {
                    // categoriagruppo
                    if (rtrim($pathinfo, '/') === '/categoriagruppo') {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'categoriagruppo');
                        }

                        return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriagruppoController::indexAction',  '_route' => 'categoriagruppo',);
                    }

                    // categoriagruppo_show
                    if (preg_match('#^/categoriagruppo/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'categoriagruppo_show')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriagruppoController::showAction',));
                    }

                    // categoriagruppo_new
                    if ($pathinfo === '/categoriagruppo/new') {
                        return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriagruppoController::newAction',  '_route' => 'categoriagruppo_new',);
                    }

                    // categoriagruppo_create
                    if ($pathinfo === '/categoriagruppo/create') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_categoriagruppo_create;
                        }

                        return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriagruppoController::createAction',  '_route' => 'categoriagruppo_create',);
                    }
                    not_categoriagruppo_create:

                    // categoriagruppo_edit
                    if (preg_match('#^/categoriagruppo/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'categoriagruppo_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriagruppoController::editAction',));
                    }

                    // categoriagruppo_update
                    if (preg_match('#^/categoriagruppo/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                            $allow = array_merge($allow, array('POST', 'PUT'));
                            goto not_categoriagruppo_update;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'categoriagruppo_update')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriagruppoController::updateAction',));
                    }
                    not_categoriagruppo_update:

                    // categoriagruppo_delete
                    if (preg_match('#^/categoriagruppo/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                            $allow = array_merge($allow, array('POST', 'DELETE'));
                            goto not_categoriagruppo_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'categoriagruppo_delete')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriagruppoController::deleteAction',));
                    }
                    not_categoriagruppo_delete:

                }

                if (0 === strpos($pathinfo, '/categoriadocumento')) {
                    // categoriadocumento
                    if (rtrim($pathinfo, '/') === '/categoriadocumento') {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'categoriadocumento');
                        }

                        return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriadocumentoController::indexAction',  '_route' => 'categoriadocumento',);
                    }

                    // categoriadocumento_show
                    if (preg_match('#^/categoriadocumento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'categoriadocumento_show')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriadocumentoController::showAction',));
                    }

                    // categoriadocumento_new
                    if ($pathinfo === '/categoriadocumento/new') {
                        return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriadocumentoController::newAction',  '_route' => 'categoriadocumento_new',);
                    }

                    // categoriadocumento_create
                    if ($pathinfo === '/categoriadocumento/create') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_categoriadocumento_create;
                        }

                        return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriadocumentoController::createAction',  '_route' => 'categoriadocumento_create',);
                    }
                    not_categoriadocumento_create:

                    // categoriadocumento_edit
                    if (preg_match('#^/categoriadocumento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'categoriadocumento_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriadocumentoController::editAction',));
                    }

                    // categoriadocumento_update
                    if (preg_match('#^/categoriadocumento/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                            $allow = array_merge($allow, array('POST', 'PUT'));
                            goto not_categoriadocumento_update;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'categoriadocumento_update')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriadocumentoController::updateAction',));
                    }
                    not_categoriadocumento_update:

                    // categoriadocumento_delete
                    if (preg_match('#^/categoriadocumento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                            $allow = array_merge($allow, array('POST', 'DELETE'));
                            goto not_categoriadocumento_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'categoriadocumento_delete')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriadocumentoController::deleteAction',));
                    }
                    not_categoriadocumento_delete:

                }

                // categoria
                if (rtrim($pathinfo, '/') === '/categoria') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'categoria');
                    }

                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriaController::indexAction',  '_route' => 'categoria',);
                }

                // categoria_show
                if (preg_match('#^/categoria/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'categoria_show')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriaController::showAction',));
                }

                // categoria_new
                if ($pathinfo === '/categoria/new') {
                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriaController::newAction',  '_route' => 'categoria_new',);
                }

                // categoria_create
                if ($pathinfo === '/categoria/create') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_categoria_create;
                    }

                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriaController::createAction',  '_route' => 'categoria_create',);
                }
                not_categoria_create:

                // categoria_edit
                if (preg_match('#^/categoria/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'categoria_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriaController::editAction',));
                }

                // categoria_update
                if (preg_match('#^/categoria/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                        $allow = array_merge($allow, array('POST', 'PUT'));
                        goto not_categoria_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'categoria_update')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriaController::updateAction',));
                }
                not_categoria_update:

                // categoria_delete
                if (preg_match('#^/categoria/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                        $allow = array_merge($allow, array('POST', 'DELETE'));
                        goto not_categoria_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'categoria_delete')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CategoriaController::deleteAction',));
                }
                not_categoria_delete:

            }

            if (0 === strpos($pathinfo, '/campo')) {
                // campo
                if (rtrim($pathinfo, '/') === '/campo') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'campo');
                    }

                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CampoController::indexAction',  '_route' => 'campo',);
                }

                // campo_show
                if (preg_match('#^/campo/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'campo_show')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CampoController::showAction',));
                }

                // campo_new
                if ($pathinfo === '/campo/new') {
                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CampoController::newAction',  '_route' => 'campo_new',);
                }

                // campo_create
                if ($pathinfo === '/campo/create') {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_campo_create;
                    }

                    return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CampoController::createAction',  '_route' => 'campo_create',);
                }
                not_campo_create:

                // campo_edit
                if (preg_match('#^/campo/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'campo_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CampoController::editAction',));
                }

                // campo_update
                if (preg_match('#^/campo/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                        $allow = array_merge($allow, array('POST', 'PUT'));
                        goto not_campo_update;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'campo_update')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CampoController::updateAction',));
                }
                not_campo_update:

                // campo_delete
                if (preg_match('#^/campo/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                    if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                        $allow = array_merge($allow, array('POST', 'DELETE'));
                        goto not_campo_delete;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'campo_delete')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CampoController::deleteAction',));
                }
                not_campo_delete:

            }

        }

        if (0 === strpos($pathinfo, '/azienda')) {
            // azienda
            if (rtrim($pathinfo, '/') === '/azienda') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'azienda');
                }

                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\AziendaController::indexAction',  '_route' => 'azienda',);
            }

            // azienda_show
            if (preg_match('#^/azienda/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'azienda_show')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\AziendaController::showAction',));
            }

            // azienda_new
            if ($pathinfo === '/azienda/new') {
                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\AziendaController::newAction',  '_route' => 'azienda_new',);
            }

            // azienda_create
            if ($pathinfo === '/azienda/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_azienda_create;
                }

                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\AziendaController::createAction',  '_route' => 'azienda_create',);
            }
            not_azienda_create:

            // azienda_edit
            if (preg_match('#^/azienda/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'azienda_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\AziendaController::editAction',));
            }

            // azienda_update
            if (preg_match('#^/azienda/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                    $allow = array_merge($allow, array('POST', 'PUT'));
                    goto not_azienda_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'azienda_update')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\AziendaController::updateAction',));
            }
            not_azienda_update:

            // azienda_delete
            if (preg_match('#^/azienda/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                    $allow = array_merge($allow, array('POST', 'DELETE'));
                    goto not_azienda_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'azienda_delete')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\AziendaController::deleteAction',));
            }
            not_azienda_delete:

        }

        // estar_rda_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'estar_rda_homepage')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\DefaultController::indexAction',));
        }

        // homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'homepage');
            }

            return array (  '_controller' => 'AppBundle\\Controller\\DefaultController::indexAction',  '_route' => 'homepage',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
