<?php

namespace estar\rda\RdaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sistematica
 *
 * @ORM\Table(name="sistematica")
 * @ORM\Entity
 */
class Sistematica
{
    /**
     * @var string
     * @ORM\Column(name="user", type="string", length=255, nullable=false)
     */
    private $user;

    /**
     * @var string
     * @ORM\Column(name="psw", type="string", length=255, nullable=false)
     */
    private $psw;

    /**
     * @var string
     * @ORM\Column(name="wsdl", type="string", length=255, nullable=false)
     */
    private $wsdl;

    /**
     * @var string
     * @ORM\Column(name="storyboardcode", type="string", length=255, nullable=false)
     */
    private $storyboardcode;

    /**
     * @var string
     * @ORM\Column(name="setmetaviewname", type="string", length=255, nullable=false)
     */
    private $setmetaviewname;

    /**
     * @var string
     * @ORM\Column(name="setdirection", type="string", length=255, nullable=false)
     */
    private $setdirection;

    /**
     * @var string
     * @ORM\Column(name="contactSettype1", type="string", length=255, nullable=false)
     */
    private $contactSettype1;

    /**
     * @var string
     * @ORM\Column(name="contactReferencetype1", type="string", length=255, nullable=false)
     */
    private $contactReferencetype1;

    /**
     * @var string
     * @ORM\Column(name="contactReferencecode1", type="string", length=255, nullable=false)
     */
    private $contactReferencecode1;

    /**
     * @var string
     * @ORM\Column(name="contactSettype2", type="string", length=255, nullable=false)
     */
    private $contactSettype2;

    /**
     * @var string
     * @ORM\Column(name="contactReferencetype2", type="string", length=255, nullable=false)
     */
    private $contactReferencetype2;

    /**
     * @var string
     * @ORM\Column(name="contactReferencecode2", type="string", length=255, nullable=false)
     */
    private $contactReferencecode2;

    /**
     * @var string
     * @ORM\Column(name="contactSettype3", type="string", length=255, nullable=false)
     */
    private $contactSettype3;

    /**
     * @var string
     * @ORM\Column(name="contactReferencetype3", type="string", length=255, nullable=false)
     */
    private $contactReferencetype3;

    /**
     * @var string
     * @ORM\Column(name="contactReferencecode3", type="string", length=255, nullable=false)
     */
    private $contactReferencecode3;

    /**
     * @var string
     * @ORM\Column(name="variableSetkey1", type="string", length=255, nullable=false)
     */
    private $variableSetkey1;

    /**
     * @var string
     * @ORM\Column(name="variableSettype1", type="string", length=255, nullable=false)
     */
    private $variableSettype1;

    /**
     * @var string
     * @ORM\Column(name="variableSetvaluestring1", type="string", length=255, nullable=false)
     */
    private $variableSetvaluestring1;

    /**
     * @var string
     * @ORM\Column(name="attachmentSetfileset1", type="string", length=255, nullable=false)
     */
    private $attachmentSetfileset1;

    /**
     * @var string
     * @ORM\Column(name="attachmentSetcontenttype1", type="string", length=255, nullable=false)
     */
    private $attachmentSetcontenttype1;

    /**
     * @var string
     * @ORM\Column(name="requestSetinstanceoperation", type="string", length=255, nullable=false)
     */
    private $requestSetinstanceoperation;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * Set user
     *
     * @param string $user
     *
     * @return Sistematica
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set psw
     *
     * @param string $psw
     *
     * @return Sistematica
     */
    public function setPsw($psw)
    {
        $this->psw = $psw;

        return $this;
    }

    /**
     * Get psw
     *
     * @return string
     */
    public function getPsw()
    {
        return $this->psw;
    }

    /**
     * Set wsdl
     *
     * @param string $wsdl
     *
     * @return Sistematica
     */
    public function setWsdl($wsdl)
    {
        $this->wsdl = $wsdl;

        return $this;
    }

    /**
     * Get wsdl
     *
     * @return string
     */
    public function getWsdl()
    {
        return $this->wsdl;
    }

    /**
     * Set storyboardcode
     *
     * @param string $storyboardcode
     *
     * @return Sistematica
     */
    public function setStoryboardcode($storyboardcode)
    {
        $this->storyboardcode = $storyboardcode;

        return $this;
    }

    /**
     * Get storyboardcode
     *
     * @return string
     */
    public function getStoryboardcode()
    {
        return $this->storyboardcode;
    }

    /**
     * Set setmetaviewname
     *
     * @param string $setmetaviewname
     *
     * @return Sistematica
     */
    public function setSetmetaviewname($setmetaviewname)
    {
        $this->setmetaviewname = $setmetaviewname;

        return $this;
    }

    /**
     * Get setmetaviewname
     *
     * @return string
     */
    public function getSetmetaviewname()
    {
        return $this->setmetaviewname;
    }

    /**
     * Set setdirection
     *
     * @param string $setdirection
     *
     * @return Sistematica
     */
    public function setSetdirection($setdirection)
    {
        $this->setdirection = $setdirection;

        return $this;
    }

    /**
     * Get setdirection
     *
     * @return string
     */
    public function getSetdirection()
    {
        return $this->setdirection;
    }

    /**
     * Set contactSettype1
     *
     * @param string $contactSettype1
     *
     * @return Sistematica
     */
    public function setContactSettype1($contactSettype1)
    {
        $this->contactSettype1 = $contactSettype1;

        return $this;
    }

    /**
     * Get contactSettype1
     *
     * @return string
     */
    public function getContactSettype1()
    {
        return $this->contactSettype1;
    }

    /**
     * Set contactReferencetype1
     *
     * @param string $contactReferencetype1
     *
     * @return Sistematica
     */
    public function setContactReferencetype1($contactReferencetype1)
    {
        $this->contactReferencetype1 = $contactReferencetype1;

        return $this;
    }

    /**
     * Get contactReferencetype1
     *
     * @return string
     */
    public function getContactReferencetype1()
    {
        return $this->contactReferencetype1;
    }

    /**
     * Set contactReferencecode1
     *
     * @param string $contactReferencecode1
     *
     * @return Sistematica
     */
    public function setContactReferencecode1($contactReferencecode1)
    {
        $this->contactReferencecode1 = $contactReferencecode1;

        return $this;
    }

    /**
     * Get contactReferencecode1
     *
     * @return string
     */
    public function getContactReferencecode1()
    {
        return $this->contactReferencecode1;
    }

    /**
     * Set contactSettype2
     *
     * @param string $contactSettype2
     *
     * @return Sistematica
     */
    public function setContactSettype2($contactSettype2)
    {
        $this->contactSettype2 = $contactSettype2;

        return $this;
    }

    /**
     * Get contactSettype2
     *
     * @return string
     */
    public function getContactSettype2()
    {
        return $this->contactSettype2;
    }

    /**
     * Set contactReferencetype2
     *
     * @param string $contactReferencetype2
     *
     * @return Sistematica
     */
    public function setContactReferencetype2($contactReferencetype2)
    {
        $this->contactReferencetype2 = $contactReferencetype2;

        return $this;
    }

    /**
     * Get contactReferencetype2
     *
     * @return string
     */
    public function getContactReferencetype2()
    {
        return $this->contactReferencetype2;
    }

    /**
     * Set contactReferencecode2
     *
     * @param string $contactReferencecode2
     *
     * @return Sistematica
     */
    public function setContactReferencecode2($contactReferencecode2)
    {
        $this->contactReferencecode2 = $contactReferencecode2;

        return $this;
    }

    /**
     * Get contactReferencecode2
     *
     * @return string
     */
    public function getContactReferencecode2()
    {
        return $this->contactReferencecode2;
    }

    /**
     * Set contactSettype3
     *
     * @param string $contactSettype3
     *
     * @return Sistematica
     */
    public function setContactSettype3($contactSettype3)
    {
        $this->contactSettype3 = $contactSettype3;

        return $this;
    }

    /**
     * Get contactSettype3
     *
     * @return string
     */
    public function getContactSettype3()
    {
        return $this->contactSettype3;
    }

    /**
     * Set contactReferencetype3
     *
     * @param string $contactReferencetype3
     *
     * @return Sistematica
     */
    public function setContactReferencetype3($contactReferencetype3)
    {
        $this->contactReferencetype3 = $contactReferencetype3;

        return $this;
    }

    /**
     * Get contactReferencetype3
     *
     * @return string
     */
    public function getContactReferencetype3()
    {
        return $this->contactReferencetype3;
    }

    /**
     * Set contactReferencecode3
     *
     * @param string $contactReferencecode3
     *
     * @return Sistematica
     */
    public function setContactReferencecode3($contactReferencecode3)
    {
        $this->contactReferencecode3 = $contactReferencecode3;

        return $this;
    }

    /**
     * Get contactReferencecode3
     *
     * @return string
     */
    public function getContactReferencecode3()
    {
        return $this->contactReferencecode3;
    }

    /**
     * Set variableSetkey1
     *
     * @param string $variableSetkey1
     *
     * @return Sistematica
     */
    public function setVariableSetkey1($variableSetkey1)
    {
        $this->variableSetkey1 = $variableSetkey1;

        return $this;
    }

    /**
     * Get variableSetkey1
     *
     * @return string
     */
    public function getVariableSetkey1()
    {
        return $this->variableSetkey1;
    }

    /**
     * Set variableSettype1
     *
     * @param string $variableSettype1
     *
     * @return Sistematica
     */
    public function setVariableSettype1($variableSettype1)
    {
        $this->variableSettype1 = $variableSettype1;

        return $this;
    }

    /**
     * Get variableSettype1
     *
     * @return string
     */
    public function getVariableSettype1()
    {
        return $this->variableSettype1;
    }

    /**
     * Set variableSetvaluestring1
     *
     * @param string $variableSetvaluestring1
     *
     * @return Sistematica
     */
    public function setVariableSetvaluestring1($variableSetvaluestring1)
    {
        $this->variableSetvaluestring1 = $variableSetvaluestring1;

        return $this;
    }

    /**
     * Get variableSetvaluestring1
     *
     * @return string
     */
    public function getVariableSetvaluestring1()
    {
        return $this->variableSetvaluestring1;
    }

    /**
     * Set attachmentSetfileset1
     *
     * @param string $attachmentSetfileset1
     *
     * @return Sistematica
     */
    public function setAttachmentSetfileset1($attachmentSetfileset1)
    {
        $this->attachmentSetfileset1 = $attachmentSetfileset1;

        return $this;
    }

    /**
     * Get attachmentSetfileset1
     *
     * @return string
     */
    public function getAttachmentSetfileset1()
    {
        return $this->attachmentSetfileset1;
    }

    /**
     * Set attachmentSetcontenttype1
     *
     * @param string $attachmentSetcontenttype1
     *
     * @return Sistematica
     */
    public function setAttachmentSetcontenttype1($attachmentSetcontenttype1)
    {
        $this->attachmentSetcontenttype1 = $attachmentSetcontenttype1;

        return $this;
    }

    /**
     * Get attachmentSetcontenttype1
     *
     * @return string
     */
    public function getAttachmentSetcontenttype1()
    {
        return $this->attachmentSetcontenttype1;
    }

    /**
     * Set requestSetinstanceoperation
     *
     * @param string $requestSetinstanceoperation
     *
     * @return Sistematica
     */
    public function setRequestSetinstanceoperation($requestSetinstanceoperation)
    {
        $this->requestSetinstanceoperation = $requestSetinstanceoperation;

        return $this;
    }

    /**
     * Get requestSetinstanceoperation
     *
     * @return string
     */
    public function getRequestSetinstanceoperation()
    {
        return $this->requestSetinstanceoperation;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function __toString(){return strval($this->getId());}
}

