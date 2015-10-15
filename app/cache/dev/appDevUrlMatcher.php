<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher.
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
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

        if (0 === strpos($pathinfo, '/css/bootstrap')) {
            // _assetic_bootstrap_css
            if ($pathinfo === '/css/bootstrap.css') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_css',  'pos' => NULL,  '_format' => 'css',  '_route' => '_assetic_bootstrap_css',);
            }

            if (0 === strpos($pathinfo, '/css/bootstrap_')) {
                // _assetic_bootstrap_css_0
                if ($pathinfo === '/css/bootstrap_bootstrap_1.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_css',  'pos' => 0,  '_format' => 'css',  '_route' => '_assetic_bootstrap_css_0',);
                }

                // _assetic_bootstrap_css_1
                if ($pathinfo === '/css/bootstrap_form_2.css') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_css',  'pos' => 1,  '_format' => 'css',  '_route' => '_assetic_bootstrap_css_1',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/js')) {
            if (0 === strpos($pathinfo, '/js/bootstrap')) {
                // _assetic_bootstrap_js
                if ($pathinfo === '/js/bootstrap.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js',);
                }

                if (0 === strpos($pathinfo, '/js/bootstrap_')) {
                    // _assetic_bootstrap_js_0
                    if ($pathinfo === '/js/bootstrap_transition_1.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_0',);
                    }

                    // _assetic_bootstrap_js_1
                    if ($pathinfo === '/js/bootstrap_alert_2.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 1,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_1',);
                    }

                    // _assetic_bootstrap_js_2
                    if ($pathinfo === '/js/bootstrap_button_3.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 2,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_2',);
                    }

                    if (0 === strpos($pathinfo, '/js/bootstrap_c')) {
                        // _assetic_bootstrap_js_3
                        if ($pathinfo === '/js/bootstrap_carousel_4.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 3,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_3',);
                        }

                        // _assetic_bootstrap_js_4
                        if ($pathinfo === '/js/bootstrap_collapse_5.js') {
                            return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 4,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_4',);
                        }

                    }

                    // _assetic_bootstrap_js_5
                    if ($pathinfo === '/js/bootstrap_dropdown_6.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 5,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_5',);
                    }

                    // _assetic_bootstrap_js_6
                    if ($pathinfo === '/js/bootstrap_modal_7.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 6,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_6',);
                    }

                    // _assetic_bootstrap_js_7
                    if ($pathinfo === '/js/bootstrap_tooltip_8.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 7,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_7',);
                    }

                    // _assetic_bootstrap_js_8
                    if ($pathinfo === '/js/bootstrap_popover_9.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 8,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_8',);
                    }

                    // _assetic_bootstrap_js_9
                    if ($pathinfo === '/js/bootstrap_scrollspy_10.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 9,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_9',);
                    }

                    // _assetic_bootstrap_js_10
                    if ($pathinfo === '/js/bootstrap_tab_11.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 10,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_10',);
                    }

                    // _assetic_bootstrap_js_11
                    if ($pathinfo === '/js/bootstrap_affix_12.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 11,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_11',);
                    }

                    // _assetic_bootstrap_js_12
                    if ($pathinfo === '/js/bootstrap_bc-bootstrap-collection_13.js') {
                        return array (  '_controller' => 'assetic.controller:render',  'name' => 'bootstrap_js',  'pos' => 12,  '_format' => 'js',  '_route' => '_assetic_bootstrap_js_12',);
                    }

                }

            }

            if (0 === strpos($pathinfo, '/js/jquery')) {
                // _assetic_jquery
                if ($pathinfo === '/js/jquery.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'jquery',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_jquery',);
                }

                // _assetic_jquery_0
                if ($pathinfo === '/js/jquery_jquery-1.11.1_1.js') {
                    return array (  '_controller' => 'assetic.controller:render',  'name' => 'jquery',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_jquery_0',);
                }

            }

        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                // _profiler_info
                if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

            // _twig_error_test
            if (0 === strpos($pathinfo, '/_error') && preg_match('#^/_error/(?P<code>\\d+)(?:\\.(?P<_format>[^/]++))?$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_twig_error_test')), array (  '_controller' => 'twig.controller.preview_error:previewErrorPageAction',  '_format' => 'html',));
            }

        }

        if (0 === strpos($pathinfo, '/campodocumento')) {
            // campodocumento
            if (rtrim($pathinfo, '/') === '/campodocumento') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', 'campodocumento');
                }

                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CampodocumentoController::indexAction',  '_route' => 'campodocumento',);
            }

            // campodocumento_show
            if (preg_match('#^/campodocumento/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'campodocumento_show')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CampodocumentoController::showAction',));
            }

            // campodocumento_new
            if ($pathinfo === '/campodocumento/new') {
                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CampodocumentoController::newAction',  '_route' => 'campodocumento_new',);
            }

            // campodocumento_create
            if ($pathinfo === '/campodocumento/create') {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_campodocumento_create;
                }

                return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CampodocumentoController::createAction',  '_route' => 'campodocumento_create',);
            }
            not_campodocumento_create:

            // campodocumento_edit
            if (preg_match('#^/campodocumento/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'campodocumento_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CampodocumentoController::editAction',));
            }

            // campodocumento_update
            if (preg_match('#^/campodocumento/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                    $allow = array_merge($allow, array('POST', 'PUT'));
                    goto not_campodocumento_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'campodocumento_update')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CampodocumentoController::updateAction',));
            }
            not_campodocumento_update:

            // campodocumento_delete
            if (preg_match('#^/campodocumento/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                    $allow = array_merge($allow, array('POST', 'DELETE'));
                    goto not_campodocumento_delete;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'campodocumento_delete')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\CampodocumentoController::deleteAction',));
            }
            not_campodocumento_delete:

        }

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
                if (preg_match('#^/richiestadocumento/(?P<idCategoria>[^/]++)/(?P<idRichiesta>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'richiestadocumento')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestadocumentoController::indexAction',));
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
                if (0 === strpos($pathinfo, '/richiestadocumento/edit') && preg_match('#^/richiestadocumento/edit/(?P<idCategoria>[^/]++)/(?P<idRichiesta>[^/]++)/(?P<idDocumento>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'richiestadocumento_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestadocumentoController::editAction',));
                }

                // richiestadocumento_update
                if (0 === strpos($pathinfo, '/richiestadocumento/update') && preg_match('#^/richiestadocumento/update/(?P<mode>[^/]++)$#s', $pathinfo, $matches)) {
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

                // richiestadocumento_upload
                if (0 === strpos($pathinfo, '/richiestadocumento/upload') && preg_match('#^/richiestadocumento/upload/(?P<idRichiesta>[^/]++)/(?P<idDocumento>[^/]++)$#s', $pathinfo, $matches)) {
                    if ($this->context->getMethod() != 'POST') {
                        $allow[] = 'POST';
                        goto not_richiestadocumento_upload;
                    }

                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'richiestadocumento_upload')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestadocumentoController::uploadAction',));
                }
                not_richiestadocumento_upload:

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

            // richiesta_valida
            if (preg_match('#^/richiesta/(?P<id>[^/]++)/valida/(?P<transizione>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_richiesta_valida;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'richiesta_valida')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\RichiestaController::validaAction',));
            }
            not_richiesta_valida:

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

            // documento_byCategoria
            if (0 === strpos($pathinfo, '/documento/byCategoria') && preg_match('#^/documento/byCategoria/(?P<idCategoria>[^/]++)/(?P<idRichiesta>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'documento_byCategoria')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\DocumentoController::indexByCategoriaRichiestaAction',));
            }

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

        if (0 === strpos($pathinfo, '/formtemplate')) {
            if (0 === strpos($pathinfo, '/formtemplate/show')) {
                // formtemplate_show
                if (preg_match('#^/formtemplate/show/(?P<idCategoria>[^/]++)/(?P<idRichiesta>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'formtemplate_show')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\FormTemplateController::showAction',));
                }

                // formtempate_showpdf
                if (0 === strpos($pathinfo, '/formtemplate/showpdf') && preg_match('#^/formtemplate/showpdf/(?P<idCategoria>[^/]++)/(?P<idRichiesta>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => 'formtempate_showpdf')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\FormTemplateController::showpdfAction',));
                }

            }

            // formtemplate_new
            if (preg_match('#^/formtemplate/(?P<idCategoria>[^/]++)/new$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'formtemplate_new')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\FormTemplateController::newAction',));
            }

            // formtemplate_create
            if (0 === strpos($pathinfo, '/formtemplate/create') && preg_match('#^/formtemplate/create/(?P<idCategoria>[^/]++)$#s', $pathinfo, $matches)) {
                if ($this->context->getMethod() != 'POST') {
                    $allow[] = 'POST';
                    goto not_formtemplate_create;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'formtemplate_create')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\FormTemplateController::createAction',));
            }
            not_formtemplate_create:

            // formtemplate_edit
            if (0 === strpos($pathinfo, '/formtemplate/edit') && preg_match('#^/formtemplate/edit/(?P<idCategoria>[^/]++)/(?P<idRichiesta>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'formtemplate_edit')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\FormTemplateController::editAction',));
            }

            // formtemplate_update
            if (0 === strpos($pathinfo, '/formtemplate/update') && preg_match('#^/formtemplate/update/(?P<idCategoria>[^/]++)/(?P<idRichiesta>[^/]++)$#s', $pathinfo, $matches)) {
                if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                    $allow = array_merge($allow, array('POST', 'PUT'));
                    goto not_formtemplate_update;
                }

                return $this->mergeDefaults(array_replace($matches, array('_route' => 'formtemplate_update')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\FormTemplateController::updateAction',));
            }
            not_formtemplate_update:

            // formtemplate_print
            if (0 === strpos($pathinfo, '/formtemplate/print') && preg_match('#^/formtemplate/print/(?P<idCategoria>[^/]++)/(?P<idRichiesta>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => 'formtemplate_print')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\FormTemplateController::printAction',));
            }

        }

        // pdf
        if (rtrim($pathinfo, '/') === '/pdf') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'pdf');
            }

            return array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\PdfController::indexAction',  '_route' => 'pdf',);
        }

        // soapEsempio
        if (0 === strpos($pathinfo, '/soapesempio') && preg_match('#^/soapesempio/(?P<city>[^/]++)/(?P<country>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'soapEsempio')), array (  '_controller' => 'estar\\rda\\RdaBundle\\Controller\\SoapEsempioController::indexAction',));
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
