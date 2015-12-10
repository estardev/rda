<?php

namespace estar\rda\RdaBundle\Namer;

use Vich\UploaderBundle\Naming\DirectoryNamerInterface;
use Vich\UploaderBundle\Mapping\PropertyMapping;
/**
 * DirectoryNamer class.
 */
class DirectoryNamer implements DirectoryNamerInterface
{
    public function directoryName($obj, PropertyMapping  $field) {
        $idRich = $obj->getIdrichiesta();
        $idDoc = $obj->getIddocumento();
        return $upload = 'Richiesta_'.$idRich;
    }
}