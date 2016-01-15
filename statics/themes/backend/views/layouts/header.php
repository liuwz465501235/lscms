<div class="navbar navbar-inverse navbar-fixed-top bs-docs-nav">
    <div class="container bs-docs-container clear">
        <div class="navbar-header">
            <?php echo CHtml::link(Yii::app()->name, array('/admin/main/index'), array('class' => 'navbar-brand')); ?>            
        </div>
        <?php
        echo $this->getTopMenus();
        ?>                
        <ul class="nav navbar-nav navbar-right">
            <?php if (!Yii::app()->user->isGuest) { ?>
                <li class="dropdown">
                    <?php
                    Yii::app()->loadHelper('translate');
                    $languages = setSystemLanguages();
                    $kL = Yii::app()->session['system_curr_language'] ? Yii::app()->session['system_curr_language'] : 'zh';
                    echo CHtml::link("{$languages[$kL]} <b class='caret'></b>", '#', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'));
                    ?>
                    <ul class="dropdown-menu">
                    <?php
                        foreach ($languages as $key => $value) {
                            echo '<li>';
                            echo CHtml::link($value, array('/admin/main/setLanguageSession', 'language' => $key , 'url' => urlencode(Yii::app()->request->url)), array());
                            echo '</li>';
                        }
                    ?>
                    </ul>
                </li>
                <li class=""></li>
                <li class="dropdown">
                <?php echo CHtml::link(Yii::app()->user->name . ' <b class="caret"></b>', '#', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown')); ?>
                    <ul class="dropdown-menu">
                        <li><?php echo CHtml::link('<span class="glyphicon glyphicon-user"></span> '.Yii::gT('个人资料'), array('/admin/main/profile')); ?></li>
                        <li><?php echo CHtml::link('<span class="glyphicon glyphicon-pencil"></span> '.Yii::gT('修改密码'), array('/admin/main/modifyPwd')); ?></li>
                    </ul>
                </li>
                <li><?php echo CHtml::link(Yii::gT('退出登录'), array('/admin/home/logout')); ?></li>
            <?php } ?>
        </ul>
    </div>
</div>