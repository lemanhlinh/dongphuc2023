<div class="main-img">
    <a id="Zoomer" href="<?php echo URL_ROOT . str_replace('/original/', '/original/', $data->image); ?>" class="MagicZoomPlus" rel="pan-zoom: false; rightClick: true; hint: false;zoom-position: right;show-loading:false;zoom-distance:0;zoom-width:400px; zoom-height:400px;" data-options="rightClick: true">
        <img class="img-fluid" src="<?php echo URL_ROOT . str_replace('/original/', '/original/', $data->image); ?>" >
    </a>
</div>
<div class="thumb-pro">
    <ul id="thumb-pro">
        <?php foreach ($result as $item) { ?>
        <li class="item">
            <a href="<?php echo URL_ROOT . str_replace('/original/', '/original/', $item->image); ?>" class="Selector"  rel="zoom-id:Zoomer" rev="<?php echo URL_ROOT . str_replace('/original/', '/original/', $item->image); ?>">
                <img src="<?php echo URL_ROOT . str_replace('/original/', '/resized/', $item->image); ?>" class="img-fluid" >
            </a>
        </li>
        <?php } ?>
    </ul>
</div>
