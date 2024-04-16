<div class="list_products">
    <div class="head-block-product clearfix">
        <h3>
            <a href="">
                <span class="not-bgr">Sản phẩm cùng danh mục</span>
                <span>Xem tất cả<i class="fal fa-angle-right" ></i></span>
            </a>
        </h3>
    </div>
    <div class="sider-slick-add owl-carousel">
        @forelse($product_related as $item)
        <div class="image-check">
            <figure class="imghvr-flip-vert">
                <img src="{{ asset(replace_image_to_webp($item->image)) }}" class="img-fluid" >
                <figcaption>
                    @if($item->image_after)
                    <img src="{{ asset(replace_image_to_webp($item->image_after)) }}" alt="{{ $item->name }}" class="img-fluid" >
                    @else
                    <img src="{{ asset(replace_image_to_webp($item->image)) }}" class="img-fluid">
                    @endif
                </figcaption><a href="{{ route('detailProduct', ['cat_slug' => $cat_slug, 'slug' => $item->alias])  }}"></a>
            </figure>

            <a href="{{ route('detailProduct', ['cat_slug' => $cat_slug, 'slug' => $item->alias])  }}">
                <div class="title-book">{{ $item->name }}</div>
            </a>
        </div>
        @empty
        @endforelse
    </div>
</div>
