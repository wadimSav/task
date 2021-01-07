<?php 

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;


/**
 *  model for loading images
 */
class UploadForm extends Model
{

    public $file;
    
    public function rules()
    {
        return [
            // [['file'], 'safe'],
            ['file', 'required', 'message' => 'Пожалуйста, будьте открытым, загрузите Ваше фото'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg']
        ];
    }

    /**
     * Загрузка изображения
     */
    public function upload()
    {
        if($this->validate('file')){
            var_dump($this->file);
            $this->file->saveAs('images/faker-images/' . $this->file->name);
            return true;
        } else {
            return false;
        }
    }
}