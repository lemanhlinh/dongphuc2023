<div class="main-img">
    <a id="Zoomer" href="{{ asset(str_replace('/original/', '/original/', $image_data)) }}" class="MagicZoomPlus" rel="pan-zoom: false; rightClick: true; hint: false;zoom-position: right;show-loading:false;zoom-distance:0;zoom-width:400px; zoom-height:400px;" data-options="rightClick: true">
        <img class="img-fluid" src="{{ asset(str_replace('/original/', '/original/', $image_data)) }}" >
    </a>
</div>
<div class="thumb-pro">
    <ul id="thumb-pro">
        <li class="item">
            <a href="{{ asset(str_replace('/original/', '/original/', $image_data)) }}" class="Selector"  rel="zoom-id:Zoomer" rev="{{ asset(str_replace('/original/', '/original/', $image_data)) }}">
                <img src="{{ asset(str_replace('/original/', '/original/', $image_data)) }}" class="img-fluid" >
            </a>
        </li>
        @forelse($product_images as $item)
        <li class="item">
            <a href="{{ asset(str_replace('/original/', '/original/', $item->image)) }}" class="Selector"  rel="zoom-id:Zoomer" rev="{{ asset(str_replace('/original/', '/original/', $item->image)) }}">
                <img src="{{ asset(str_replace('/original/', '/original/', $item->image)) }}" class="img-fluid" >
            </a>
        </li>
        @empty
        @endforelse
    </ul>
</div>
