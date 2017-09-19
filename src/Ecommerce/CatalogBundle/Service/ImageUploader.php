<?php
/**
 * Created by PhpStorm.
 * User: fkato
 * Date: 19.09.17
 * Time: 19:08
 */

namespace Ecommerce\CatalogBundle\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ImageUploader
 * @package Ecommerce\CatalogBundle\Service
 * Image uploader class
 */
class ImageUploader
{
    private $targetDir;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
    }

    public function upload(UploadedFile $file)
    {
        $fileName = md5(uniqid()) . '.'. $file->guessExtension();
        $file->move($this->targetDir, $fileName);
        return $fileName;
    }



}