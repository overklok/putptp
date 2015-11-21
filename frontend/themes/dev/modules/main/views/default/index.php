<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="main-default-index">

    <div class="jumbotron" style="padding-bottom: 0">
        <h1>WELCOME TO YOUR LIBRARY</h1>

        <p class="lead">Create your unique books and become an Indispensable reader.</p>

        <?= Html::tag('p', Html::tag('a', 'How it works', ['class' => 'btn btn-lg btn-success', 'href' => Url::to('help')])) ?>
    </div>

    <div class="row">
        <div class="col-lg-3 col-lg-offset-3 text-center">
            <?= Html::tag('p', Html::tag('a', 'Start Writing', ['class' => 'btn btn-lg btn-danger', 'href' => Url::to('help')])) ?>
        </div>
        <div class="col-lg-3 text-center">
            <?= Html::tag('p', Html::tag('a', 'Start Reading', ['class' => 'btn btn-lg btn-danger', 'href' => Url::to('help')])) ?>
        </div>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-10 col-lg-offset-1 text-center">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc et imperdiet leo, id tristique purus. Donec vel velit vitae est rutrum maximus sit amet non orci. Sed sodales nulla in mauris aliquet dictum. Nunc gravida mattis magna, sed condimentum nisi aliquet in. Nulla finibus pretium arcu. Aenean tincidunt arcu ac purus consectetur sagittis. Aliquam pellentesque justo sem. Praesent eleifend arcu posuere, egestas nunc vel, euismod lorem. Suspendisse volutpat fringilla varius. Duis imperdiet nunc ante. Aenean porttitor faucibus posuere. Integer pharetra, ligula a consequat congue, libero urna consequat ante, id aliquam felis nunc dignissim enim. Duis luctus commodo lectus, vitae ornare enim tempor vel. Suspendisse viverra arcu nisi, non consequat velit ornare at.
                    Donec placerat pharetra nunc, quis dictum dolor. Praesent interdum et sapien eget consequat. Vestibulum id magna et lacus semper hendrerit a non quam. Donec vitae ante ut sapien facilisis mattis. Nulla eget volutpat magna, eget imperdiet est. Etiam tincidunt placerat volutpat. Suspendisse vestibulum, dolor id scelerisque consequat, libero libero semper ante, in porttitor felis neque quis magna. Vestibulum ipsum nisl, semper a laoreet at, tempus sed odio.
                    Donec egestas sodales erat lacinia eleifend. Phasellus iaculis lectus tristique neque condimentum lacinia. Phasellus nisi dolor, dapibus non sapien sed, fringilla dictum mi. Sed dui mauris, gravida quis maximus non, scelerisque et justo. Proin tempor, sapien in vestibulum egestas, justo leo viverra felis, nec malesuada tellus eros ac ipsum. Sed pretium luctus libero a pharetra. Ut mattis aliquet tortor, quis facilisis dolor interdum sit amet. Fusce a sapien non ligula maximus suscipit sit amet vel augue. Fusce eleifend sapien enim, eget tempus libero condimentum eu.
            </div>
        </div>

    </div>
</div>
