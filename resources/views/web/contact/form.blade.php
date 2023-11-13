<div class="contact_form row-item">
    <form method="post" action="{{ route('detailContactStore') }}" name="contact" class="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12">
                <input type="text" maxlength="255"  name="full_name" placeholder='Họ và tên' id="full_name" value="" class="form_control" required/>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <input type="text" maxlength="255"   name="phone" id="phone" placeholder="Số điện thoại" value="" class="form_control" required/>
            </div>
            <div class="col-6">
                <input type="email" maxlength="255"  placeholder="Email" name="email" id="email" value="" class="form_control" required/>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <textarea rows="6" cols="30" name='content' id='content' placeholder="Nội dung" required></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <input type="submit" value="Gửi liên hệ">
            </div>
        </div>
        <input type="text" name="contact_me_by_fax_only" style="opacity: 0 !important" tabindex="-1" autocomplete="off">
    </form>
    <!--	end FORM				-->
    <div class="clear"></div>
</div>
