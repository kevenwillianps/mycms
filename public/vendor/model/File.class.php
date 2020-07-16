<?php
/**
 * Created by PhpStorm.
 * User: KEVEN
 * Date: 08/07/2020
 * Time: 21:26
 */

/** Declaro o local que a minha classe pertence **/
namespace vendor\model;

class File
{

    /** Variaveis da Classes **/
    private $path = null;
    private $name = null;
    private $wideImage = null;

    public function __construct()
    {

        /** Instanciamento do manipulador da imagem **/
        $this->wideImage = new \WideImage();
    }

    public function handling($path, $name)
    {

        /** Parâmetros de entrada **/
        $this->path = (string)$path;
        $this->name = (string)$name;

        /** Coloco a imagem em preto e branco **/
        $this->wideImage = \WideImage::load($this->path.'/'.$this->name);
        $this->wideImage = $this->wideImage->resize(1280);
        $this->wideImage = $this->wideImage->applyFilter(IMG_FILTER_GRAYSCALE);
        $this->wideImage = $this->wideImage->saveToFile($path.'/filter_gray_scale/'.$name, 60);

        /** Recorto a Imagem **/
        $this->wideImage = \WideImage::load($path.'/'.$name);
        $this->wideImage = $this->wideImage->crop('center', 'center', 720, 1280);
        $this->wideImage = $this->wideImage->saveToFile($path.'/crop/'.$name, 60);

        /** Redimensiono a Imagem **/
        $this->wideImage = \WideImage::load($path.'/'.$name);
        $this->wideImage = $this->wideImage->resize(1920);
        $this->wideImage = $this->wideImage->saveToFile($path.'/resize/'.$name, 60);

        /** Corto a imagem para icone **/
        $this->wideImage = \WideImage::load($path.'/'.$name);
        $this->wideImage = $this->wideImage->resize(2000, 2000, 'outside');
        $this->wideImage = $this->wideImage->crop('center', 'center', 2000, 2000);
        $this->wideImage = $this->wideImage->saveToFile($path.'/thumbnail/'.$name, 55);

        if (is_file($this->path.'/filter_gray_scale/'.$this->name) && is_file($this->path.'/crop/'.$this->name) && is_file($this->path.'/resize/'.$this->name) && is_file($this->path.'/thumbnail/'.$this->name)) {

            return true;

        } else {

            return false;

        }

    }

    public function __destruct()
    {

        /** Finalizo o instanciamento do manipulador da imagem **/
        $this->wideImage = null;
    }
}
