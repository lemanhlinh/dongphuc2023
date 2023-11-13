<div id="alert-error"></div><!-- END: .alert-error -->
<div id="dialogoverlay" onclick="Alert.ok()"></div>
<div id="dialogbox">
    <div>
        <div id="dialogboxhead"></div>
        <div id="dialogboxbody"></div>
        <div id="dialogboxfoot"></div>
    </div>
</div>
<div class="scrollToTop"></div><!-- END: .scrollToTop -->
<!--popup-->
<div class="content-pop">
    <div class="wrapper-popup" id="wrapper-popup"></div>
    <div class="wrapper-popup-2" id="wrapper-popup-2"></div>
</div>
<div class="full"></div>
<div id="fs-popup-home" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="    background: transparent;    box-shadow: none;
    border: none;">

            <button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close">
                <img src="{{ asset('images/close-modal.png') }}">
            </button>
            <div class="form-bao-gia">
                <img class="img-responsive logo-cati-popup" src="{{ asset('images/logo-mk.png') }}" alt="{{ $setting['site_name'] }}" />
                <div class="text-center">Báo giá trong 5 phút</div>
                <form method="post" action="{{ route('saveQuote') }}" name="contact_home" class="form">
                    <input type="text" name="phone_contact" id="phone_contact" placeholder="Số điện thoại" class="form-control" required >
                    <input type="text" name="number_contact" id="number_contact" placeholder="Số lượng dự kiến" class="form-control" required >
                    <input type="submit" value="Nhận báo giá" class="btn btn-success buttom-contact">
                    <input type="text" name="contact_me_by_fax_only" style="opacity: 0 !important" tabindex="-1" autocomplete="off">
                </form>
            </div>
        </div><!--end: .modal-content-->
    </div><!--end: .modal-dialog-->
</div><!--end: #fs-alert-->
