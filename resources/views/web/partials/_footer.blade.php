<footer class="row-content" id="footer">
    <div class="container">
        <div class="info-footer">
            <div class="row">
                <div class="col-md-2 col-sm-12 col-xs-12">
                    <div class='menu-menufocal row-item'>
                        <div class="first_item row-item" id="mn-focus">
                            Về chúng tôi
                        </div>
                        <ul class="menu-focal row-item">
                            <li class="itemitem1">
                                <a class="item-detail" href="https://dongphuccati.com/trang-tinh/chinh-sach-bao-hanh.html">
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i><span> Chính sách Bảo hành</span>
                                </a>
                            </li>
                            <li class="itemitem2">
                                <a class="item-detail" href="https://dongphuccati.com/trang-tinh/chinh-sach-chat-luong.html">
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i><span> Chính sách Chất lượng</span>
                                </a>
                            </li>
                            <li class="itemitem3">
                                <a class="item-detail" href="https://dongphuccati.com/trang-tinh/khieu-nai---boi-thuong.html">
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i><span> Khiếu nại - Bồi thường</span>
                                </a>
                            </li>
                            <li class="itemitem4">
                                <a class="item-detail" href="https://dongphuccati.com/trang-tinh/chinh-sach-van-chuyen.html">
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i><span> Chính sách Vận chuyển</span>
                                </a>
                            </li>
                            <li class="itemitem5">
                                <a class="item-detail" href="https://dongphuccati.com/trang-tinh/giao-nhan-va-kiem-hang.html">
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i><span> Giao nhận và Kiểm hàng</span>
                                </a>
                            </li>
                            <li class="itemlast-item item6">
                                <a class="item-detail" href="https://dongphuccati.com/trang-tinh/chinh-sach-bao-mat.html">
                                    <i class="fas fa-angle-double-right" aria-hidden="true"></i><span> Chính sách Bảo mật</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="list-connect">
                        <div class="title-footer">Kết nối với chúng tôi</div>
                        <p class="connect-social">
                            <a href="{{ $setting['facebook'] }}" target="_blank" class="facebook">
                                <i class="fab fa-facebook"></i>
                            </a>
                            <a href="{{ $setting['twitter'] }}" target="_blank" class="twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="{{ $setting['youtube'] }}" target="_blank" class="youtube">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="{{ $setting['instagram'] }}" target="_blank" class="instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </p>
                    </div>
                    <div class="list-connect chung-nhan mt-5">
                        <div class="title-footer">Chứng nhận</div>
                        <img data-src="{{ asset('images/NoPath.png') }}" loading="lazy" class="lazy img-fluid d-none" alt="" >
                        <a href="{{ $setting['nopath']}}" target="_blank">
                            <img src="{{ asset('images/NoPath.png') }}" loading="lazy" alt="" class="lazy img-fluid" width="200px" height="75px">
                        </a>
                    </div>
                    <a href="//www.dmca.com/Protection/Status.aspx?ID=11584654-1c05-4fe1-bdc8-04ef11f3005d" title="DMCA.com Protection Status" class="dmca-badge"> <img src ="https://images.dmca.com/Badges/_dmca_premi_badge_5.png?ID=11584654-1c05-4fe1-bdc8-04ef11f3005d" width="135px" height="28px" alt="DMCA.com Protection Status" /></a>  <script src="https://images.dmca.com/Badges/DMCABadgeHelper.min.js"> </script>
                </div>
                <div class="col-md-4 col-sm-12 col-xs-12">
                    <div class="list-connect">
                        <div class="title-footer">CATI UNIFORM</div>
                        {!! $setting['info_footer'] !!}
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-xs-12">
                    {!! $setting['link_fanpage'] !!}
                </div>
            </div>
        </div>
    </div>
</footer><!-- END: footer -->
