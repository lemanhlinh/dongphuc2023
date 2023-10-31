@extends('web.layouts.web')

@section('content')
    <div class="container">
        <div class="main row-content" id="main">
            <div class="clearfix"></div>
            <section id="main-breadcrumbs" class="main-breadcrumbs">
                <div class="breadcrumbs row-item">
                    <ol class="breadcrumb row-item">
                        <li class="breadcrumb-item breadcumbs-first">
                            <a title="Đồng Phục Cati - Công Ty May In Đồng Phục Uy Tín Chất Lượng"
                               href="https://dongphuccati.com/" rel="nofollow">
                                Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item ">
                            <a href="javascript: void(0)" title="Giới thiệu">
                                Giới thiệu</a>
                        </li>
                        <li class="breadcrumb-item active">
                            ĐỒNG PHỤC CATI
                        </li>
                    </ol><!-- END: .breadcrumb-content -->
                </div><!-- END: .breadcrumb -->
                <div class="clear"></div>
            </section>
            <div class="clearfix"></div>
            <div class="main-content row-item ">
                <div class="row">
                    <div class="main-column-content col-lg-9 col-md-9 col-sm-12 col-xs-12 order-md-2">
                        <div class="content-wp clearfix">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="news_detail row-content">
                                    <div id="DivIdToPrint">
                                        <h1 class="news-title">{{ $article->title }}</h1>
                                        <time class="clearfix">
                                            <i class="fa fa-calendar-check-o"></i>
                                            {{ date('d/m/Y',strtotime($article->created_at)) }}
                                            <span class="fl-right">
                                                <div class='share_bottom row-item' >
                                                    <div class="addthis_inline_share_toolbox_ouhp"></div>
                                                </div><!--end: .hit_share-->
                                            </span>
                                        </time>
                                        <div class="toc-content" id="left1">
                                            <div class="title-toc-list">
                                                <h3 class="title-toc">Mục lục nội dung</h3>
                                                <span class="button-select"><i class="fas fa-plus"></i><i class="fas fa-minus"></i></span>
                                            </div>
                                            <div class="list-toc">
                                                <ol id="toc"></ol>
                                            </div>
                                        </div>
                                        <div class='description row-item'>
                                            {!! $article->content !!}
                                        </div><!-- END: .news-detail-content -->
                                        <div class="row clearfix">
                                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                <div id="fb-root"></div>
                                                <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v5.0&appId=261705784465814&autoLogAppEvents=1"></script>
                                                <div class="fb-comments" data-href="http://<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" data-width="100%" data-num-posts="4"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mtl">
                                        @if(count($relate_news_list) > 0)
                                        <h2 class="title-module-related">
                                            <span>
                                               Tin tức liên quan
                                            </span>
                                        </h2>
                                        <div class="new-related">
                                            <div class="row">
                                                @forelse($relate_news_list as $item)
                                                <div class="image-info-plus col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                    <a href="{{ route('detailArticle',['cat_slug' => $cat_slug,'slug'=>$item->alias]) }}" title="{{ $item->title }}">
                                                        <img src="{{ asset($item->image) }}" class="img-fluid">
                                                        <div class="detail-new">
                                                            <div class="title-product">{{ $item->title }}</div>
                                                        </div>
                                                    </a>
                                                </div>
                                                @empty
                                                @endforelse
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div><!-- END: .news_detail -->
                            </div>
                        </div>
                    </div>
                    <div class="main-column-left col-lg-3 col-md-3 col-sm-12 col-xs-12 order-md-1">
                        <div class="menu_right clearfix hidden-xs">
                            <div class="title-menu-pro">
                                <i class="fas fa-bars"></i>Menu danh mục
                            </div>
                            <div id="cssmenu_content">
                                <ul class="product_menuproduct_menu_default">
                                    @forelse($cat_product_home as $item)
                                        <li class="level_0 first-item" >
                                            <a href="">{{ $item->name }}<i class="fas fa-angle-right"></i></a>
                                            @if(count($item->children) > 0)
                                                <ul class="wrapper_children_level0">
                                                    @forelse($item->children as $val)
                                                        <li class="level_1 first-item">
                                                            <a href="">{{ $val->name }}</a>
                                                        </li>
                                                    @empty
                                                    @endforelse
                                                </ul>
                                            @endif
                                        </li>
                                    @empty
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        @forelse($banners as $item)
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="banner-list">

                                    <div class="banner_item_0 banner_item" >
                                        <p style="text-align: center;"><a
                                                href="{{ $item->link }}"><img
                                                    alt="{{ $item->name }}"
                                                    src="{{ asset($item->image) }}"></a></p>
                                    </div>

                                </div>
                            </div>
                            <div class="clearfix"></div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>
        </div><!-- END: main -->
        <div class="clearfix"></div>
    </div>
@endsection

@section('link')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/web/article-detail.css') }}">
    <style>
        .stacktable { width: 100%; }
        .st-head-row { padding-top: 1em; font-weight: normal;}
        .st-head-row.st-head-row-main { font-size: 1.5em; padding-top: 0; }
        /*.st-key { width: 100%; text-align: right; padding-right: 1%; }*/
        .st-val { width: 100%; padding-left: 0%; }



        /* RESPONSIVE EXAMPLE */

        .stacktable.large-only { display: table; }
        .stacktable.small-only { display: none; }

        @media (max-width: 800px) {
            .stacktable.large-only { display: none; }
            .stacktable.small-only { display: table; }
        }
    </style>
@endsection

@section('script')
    @parent
    <script src="{{ asset('/js/web/jquery.toc.js') }}"></script>
    <script src="{{ asset('/js/web/responsivetables.js') }}"></script>
    <script src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-561e00468cbfda8e"></script>
    <script>
        function goBack() {
            window.history.back();
        }
        $('.responsive').stacktable();
        $("#toc").toc({content: ".news_detail .description", headings: "h1,h2,h3,h4"});
        $(".button-select").click(function() {
            $('.fa-minus').toggle(  );
            $('.fa-plus').toggle(  );
            $('.list-toc').toggle("slow");
        });
    </script>
    <script>
        function printDiv(id)
        {

            var html="<html>";
            html += "<body><title>" + document.title  + "</title>";
            html+= document.getElementById(id).innerHTML;
            html+="</body></html>";

            var printWin = window.open('','','left=0,top=0,fullscreen=yes,toolbar=0,scrollbars=0,status  =0');
            printWin.document.write(html);
            printWin.document.close();
            printWin.focus();
            printWin.print();
            printWin.close();

        }
    </script>
@endsection
