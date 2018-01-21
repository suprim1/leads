<?php

namespace app\modules\user;

class UserAsset extends \yii\web\AssetBundle {

    public $sourcePath = '@app/modules/user/assets';
    public $js = [
        'js/user.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
    ];

}
