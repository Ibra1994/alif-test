<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?= \cebe\gravatar\Gravatar::widget([
                    'email' => Yii::$app->user->identity->email,
                    'defaultImage' => 'monsterid',
                    'options' => [
                        'class' => 'img-circle',
                        'alt' => "User Image",
                    ]
                ]);
                ?>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->user->identity->email ?></p>

            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => '', 'options' => ['class' => 'header']],
                    ['label' => 'Lock', 'icon' => 'fas fa-lock', 'url' => ['/lock']],
                    ['label' => 'Key', 'icon' => 'far fa-key', 'url' => ['/key']],
                ],
            ]
        ) ?>

    </section>

</aside>
