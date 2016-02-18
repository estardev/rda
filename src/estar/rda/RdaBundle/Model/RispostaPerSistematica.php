<?php
/**
 * Created by PhpStorm.
 * User: francesco.galli
 * Date: 18/02/2016
 * Time: 14.03
 */

namespace estar\rda\RdaBundle\Model;


class RispostaPerSistematica
{

    const codiceRispostaErrore = 'KO';

    const codiceRispostaOk = 'OK';

    /**
     * @var DateTime
     */
    private $dataRisposta;

    /**
     * @var string
     */
    private $codiceRisposta;

    /** @var  string
     *
     */
    private $descrizioneErrore;

    /**
     * @var string
     */
    private $codiceErrore;

    /**
     * RispostaPerSistematica constructor.
     */
    public function __construct()
    {
        $dateTime = new \DateTime();
        $dateTime->setTimeZone(new \DateTimeZone('Europe/Rome'));
        $this->dataRisposta =  $dateTime->format(\DateTime::W3C);

    }

    /**
     * @return DateTime
     */
    public function getDataRisposta()
    {
        return $this->dataRisposta;
    }

    /**
     * @param DateTime $dataRisposta
     */
    public function setDataRisposta($dataRisposta)
    {
        $this->dataRisposta = $dataRisposta;
    }

    /**
     * @return string
     */
    public function getCodiceRisposta()
    {
        return $this->codiceRisposta;
    }

    /**
     * @param RispostaPerSistematica $codiceRisposta
     */
    public function setCodiceRisposta($codiceRisposta)
    {
        $this->codiceRisposta = $codiceRisposta;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescrizioneErrore()
    {
        return $this->descrizioneErrore;
    }

    /**
     * @param string $descrizioneErrore
     */
    public function setDescrizioneErrore($descrizioneErrore)
    {
        $this->descrizioneErrore = $descrizioneErrore;
    }

    /**
     * @return string
     */
    public function getCodiceErrore()
    {
        return $this->codiceErrore;
    }

    /**
     * @param string $codiceErrore
     */
    public function setCodiceErrore($codiceErrore)
    {
        $this->codiceErrore = $codiceErrore;
    }


}