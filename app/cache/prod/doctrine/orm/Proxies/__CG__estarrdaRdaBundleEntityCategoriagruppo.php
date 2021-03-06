<?php

namespace Proxies\__CG__\estar\rda\RdaBundle\Entity;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Categoriagruppo extends \estar\rda\RdaBundle\Entity\Categoriagruppo implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', '' . "\0" . 'estar\\rda\\RdaBundle\\Entity\\Categoriagruppo' . "\0" . 'abilitatoinserimentorichieste', '' . "\0" . 'estar\\rda\\RdaBundle\\Entity\\Categoriagruppo' . "\0" . 'validatoretecnico', '' . "\0" . 'estar\\rda\\RdaBundle\\Entity\\Categoriagruppo' . "\0" . 'validatoreamministrativo', '' . "\0" . 'estar\\rda\\RdaBundle\\Entity\\Categoriagruppo' . "\0" . 'referenteabs', '' . "\0" . 'estar\\rda\\RdaBundle\\Entity\\Categoriagruppo' . "\0" . 'id', '' . "\0" . 'estar\\rda\\RdaBundle\\Entity\\Categoriagruppo' . "\0" . 'idgruppoutente', '' . "\0" . 'estar\\rda\\RdaBundle\\Entity\\Categoriagruppo' . "\0" . 'idcategoria');
        }

        return array('__isInitialized__', '' . "\0" . 'estar\\rda\\RdaBundle\\Entity\\Categoriagruppo' . "\0" . 'abilitatoinserimentorichieste', '' . "\0" . 'estar\\rda\\RdaBundle\\Entity\\Categoriagruppo' . "\0" . 'validatoretecnico', '' . "\0" . 'estar\\rda\\RdaBundle\\Entity\\Categoriagruppo' . "\0" . 'validatoreamministrativo', '' . "\0" . 'estar\\rda\\RdaBundle\\Entity\\Categoriagruppo' . "\0" . 'referenteabs', '' . "\0" . 'estar\\rda\\RdaBundle\\Entity\\Categoriagruppo' . "\0" . 'id', '' . "\0" . 'estar\\rda\\RdaBundle\\Entity\\Categoriagruppo' . "\0" . 'idgruppoutente', '' . "\0" . 'estar\\rda\\RdaBundle\\Entity\\Categoriagruppo' . "\0" . 'idcategoria');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Categoriagruppo $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function setAbilitatoinserimentorichieste($abilitatoinserimentorichieste)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAbilitatoinserimentorichieste', array($abilitatoinserimentorichieste));

        return parent::setAbilitatoinserimentorichieste($abilitatoinserimentorichieste);
    }

    /**
     * {@inheritDoc}
     */
    public function getAbilitatoinserimentorichieste()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAbilitatoinserimentorichieste', array());

        return parent::getAbilitatoinserimentorichieste();
    }

    /**
     * {@inheritDoc}
     */
    public function setValidatoretecnico($validatoretecnico)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setValidatoretecnico', array($validatoretecnico));

        return parent::setValidatoretecnico($validatoretecnico);
    }

    /**
     * {@inheritDoc}
     */
    public function getValidatoretecnico()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getValidatoretecnico', array());

        return parent::getValidatoretecnico();
    }

    /**
     * {@inheritDoc}
     */
    public function setValidatoreamministrativo($validatoreamministrativo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setValidatoreamministrativo', array($validatoreamministrativo));

        return parent::setValidatoreamministrativo($validatoreamministrativo);
    }

    /**
     * {@inheritDoc}
     */
    public function getValidatoreamministrativo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getValidatoreamministrativo', array());

        return parent::getValidatoreamministrativo();
    }

    /**
     * {@inheritDoc}
     */
    public function setReferenteabs($referenteabs)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setReferenteabs', array($referenteabs));

        return parent::setReferenteabs($referenteabs);
    }

    /**
     * {@inheritDoc}
     */
    public function getReferenteabs()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReferenteabs', array());

        return parent::getReferenteabs();
    }

    /**
     * {@inheritDoc}
     */
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int)  parent::getId();
        }


        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', array());

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdgruppoutente(\estar\rda\RdaBundle\Entity\Gruppoutente $idgruppoutente = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdgruppoutente', array($idgruppoutente));

        return parent::setIdgruppoutente($idgruppoutente);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdgruppoutente()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdgruppoutente', array());

        return parent::getIdgruppoutente();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdcategoria(\estar\rda\RdaBundle\Entity\Categoria $idcategoria = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdcategoria', array($idcategoria));

        return parent::setIdcategoria($idcategoria);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdcategoria()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdcategoria', array());

        return parent::getIdcategoria();
    }

}
