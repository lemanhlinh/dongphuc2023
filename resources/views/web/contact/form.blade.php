<div class="contact_form row-item">
    <form method="post" action="#" name="contact" class="form" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12">
                <input type="text" maxlength="255"  name="contact_name" placeholder='Họ và tên' id="contact_name" value="" class="form_control" required/>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <input type="text" maxlength="255"   name="contact_phone" id="contact_phone" placeholder="Số điện thoại" value="" class="form_control" required/>
            </div>
            <div class="col-6">
                <input type="email" maxlength="255"  placeholder="Email" name="contact_email" id="contact_email" value="" class="form_control" required/>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <textarea rows="6" cols="30" name='message' id='message' placeholder="Nội dung" required></textarea>
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
