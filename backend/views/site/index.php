<?php

/* @var $this yii\web\View */

$this->title = 'Яблочки';
?>
<div class="site-index">

    <div class="jumbotron">

        <p class="lead" style=" background:#9999cc; padding: 10px;">Дропнуть яблочко</p>

    </div>

    <div class="row">
        <?foreach ($apples as $apple){
            $quality = round(((time() - $apple->appearance_date) / 18000)*100);
            ?>
            <div class="col-lg-3 col-md-3" style="background: <? echo $quality <= 99 ? 'white':'silver'?>;">
                <input type="text" hidden name="apple_id" value="<?= $apple->id?>">
                <p style="color: rgb(<?= $apple->color?>)">цвет яблока</p>
                <p>тухлое на  : <?= $quality; ?>%</p>
                <p>Дата падения : <? echo date('d.m.Y H:i:s', $apple->appearance_date); ?></p>
                <p>доля яблочка : <span class="apple_eat"><?= $apple->size?></span></p>
                <?if($quality <= 99){ ?>
                    <button class="eat_apple">Надкусить</button>
                <?}else{
                    echo '<p>СТУХЛО</p>';
                }?>
                <hr>
            </div>

        <?}?>
    </div>
</div>

<?php

$js = <<<JS
    $('.lead').on('click', function(){
        $.ajax({
            url: '/backend/web/index.php',
            type: 'POST',
            data: { 'form' : 'create'},
            success: function(res){
                location.reload();
            },
            error: function(){
                alert('Error!');
            }
        });
        return false;
    });
    $('.eat_apple').on('click', function(){
        var apple_eat = $(this).parent().find('.apple_eat');
        //изменение размера яблочка
        if(Number($(apple_eat).text()) > 25) { 
            $(apple_eat).text(Number($(apple_eat).text()) - 25)
        }
        else {
            //удаление яблочка
            $(this).parent().remove();
        };
        //беру id яблочка
        var apple_id = $(this).parent().find('input').val();
        
        $.ajax({
            url: '/backend/web/index.php',
            type: 'POST',
            data: { 'apple_id' : apple_id, 'form' : 'eat'},
            success: function(res){
                console.log(res);
            },
            error: function(){
                alert('Error!');
            }
        });
        return false;
    });
JS;
$this->registerJs($js);
?>