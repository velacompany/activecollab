{title}New Quote{/title}
<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
<div >

    <div class="object_title">New Quote</div>
    <form action="" id="add-quote" name="add-quote" method="post"  enctype="multipart/form-data">
        <div class="colspan5">

            <div class="control-group">
                <div class="label"><label for="fullname">Full name *  </label></div>
                <input class="input-lg" required type="text" placeholder="Full name ................Required" name="fullname" id="fullname"/>
            </div>

            <div class="control-group">
                <div class="label"><label for="email_address">Email address: * </label></div>
                <input class="input-lg" required type="text" placeholder=" Email address ..........Required " name="email_address" id="email_address"/>
            </div>

            <div class="control-group">
                <div class="label"><label for="name_of_your_project">Name of project: </label></div>
                <input class="input-lg" required type="text" placeholder=" Name of your project ..........Required " name="project_name" id="project_name"/>
            </div>

            <div class="control-group">
                <div class="label"><label for="project_type">Project type *</label></div>
                <select required name="project_type" id="project_type">
                    <option value="" >Please select</option>
                    <option value="Website">Website</option>
                    <option value="Graphic Design">Graphic Design</option>
                    <option value="Iphone/Droid App">Iphone/Droid App</option>
                    <option value="ASP/.NET Programming">ASP/.NET Programming</option>
                    <option value="PHP programming">PHP programming</option>
                    <option value="Search Engine Optimization">Search Engine Optimization</option>
                    <option value="Monthly Maintance">Monthly Maintance</option>
                    <option value="Social Media">Social Media</option>
                </select>
            </div>

            <div class="control-group">
                <div class="label"><label for="company_name">Company name: </label></div>
                <input class="input-lg" type="text" placeholder=" Company name " name="company_name" id="company_name"/>
            </div>

            <div class="control-group">
                <div class="label"><label for="address">Address : </label></div>
                <input class="input-lg" type="text" placeholder=" Address" name="address" id="address"/>
            </div>

            <div class="control-group">
                <div class="label"><label for="city_state_zip">City, State.. </label></div>
                <input class="input-lg" required type="text" placeholder="City , State & Zip ........ Required" name="city_state_zip" id="city_state_zip"/>
            </div>

            <div class="control-group">
                <label for="website_example">Please enter up to 3 example websites you are basing your project on. (200 chars max): </label></br></br>
                <textarea name="website_example"></textarea>
            </div>

        </div><!-- end span5 -->

        <div class="colspan5">


            <div class="control-group">
                <div class="label"><label for="phone">Phone # * </label></div>
                <input class="input-lg" required type="text" placeholder="Phone ..... Require" name="phone" id="phone"/>
            </div>

            <div class="control-group">
                <div class="label"><label for="website_url">Website URL : </label></div>
                <input class="input-lg" type="text" placeholder="Website url or Domain name..." name="website_url" id="website_url"/>
            </div>

            <div class="control-group">
                <div class="label"><label for="type_of_website">Type of website </label></div>
                <select name="type_of_website" id="type_of_website">
                    <option value="">If web related, what type of website would you need?</option>
                    <option value="personal">Personal</option>
                    <option value="small_Business">Small Business</option>
                    <option value="Ecommerce">E-commerce</option>
                    <option value="professional">Professional</option>
                    <option value="corporate">Corporate</option>
                    <option value="intranet">Intranet</option>
                    <option value="socialMedia">Social media</option>

                </select>

            </div>

            <div class="control-group">
                <div class="label"><label for="project_budget">Project Budget: </label></div>
                <input class="input-lg" type="text" placeholder="Your project budget" name="project_budget" id="project_budget"/>
            </div>

            <div class="control-group">
                <div class="label"><label for="design_document">File  Document : </label></div>
                <input class="input-lg" type="file" name="design_document" id="design_document"/>
            </div>
            <div class="control-group">
                <div class="label"><label for="time_contact">Time to contact ?   </label></div>
                <select required name="time_contactf" id="time_contactf">
                    <option value="">Select Best time of the day to contact you </option>
                    <option value="Morning">Morning</option>
                    <option value="Noon">Noon</option>
                    <option value="Small Business">Small Business</option>
                    <option value="Evening">Evening</option>
                    <option value="After 6pm">After 6pm</option>
                    <option value="Before 9pm">Before 9pm</option>

                </select>
            </div>
            <div class="control-group">
                <div class="label"><label for="how_did_youhear">How did you ..?   </label></div>
                <input class="input-lg" required type="text" placeholder="How did you hear about Lucent One? .. Require" name="how_did_youhear" id="time_contact"/>
            </div>
            <div class="control-group">
                <label for="note_or_comment">Any additional notes or comments that describe your project? (2000 chars max) : </label></br></br>
                <textarea name="note_or_comment" required placeholder="Note or comment ..... Require" ></textarea>
            </div>


        </div><!-- end span5-->
        <div class="clear_fix"></div>

        <table  >
            <thead>
                <tr>
                    <th class="order-num">#</th>
                    <th>Description</th>
                    <th>Service date</th>
                    <th>Time/rate</th>
                    <th>Total</th>
                    <th></th>
                </tr>
            </thead><!-- end head-->
            <tbody id="tablebody">
            <tr class="num-1">
                <td class="order-num"  >1</td>
                <td> <input type="text" class="input-sm" required id="description_1" name="description_1" /> </td>
                <td> <input type="text" class="input-sm" name="service_date_1"  /> </td>
                <td> <input type="text" class="input-sm" name="time_rate_1"  /> </td>
                <td> <input type="text" class="input-sm" name="total_1" id="description" /> </td>
                <td></td>
            </tr>


            </tbody><!-- end body-->

        </table>
        <input name="max" id="max" type="hidden" value="1" />
        <div><button class="btn-new-item" type="button" id="add-new">Add new item</button></div>


        <button type="submit" class="btn-green create"    name="submit" id="submit">Create Quote</button>

    </form>
</div>
<script>
    $(document).ready(function(){
$("#add-quote").validate();
        $("#add-new").click(function(){
            var max = $("#max").val();
            max++;
            $('<tr><td class="order-num"  ><i>'+max+'<i></td>' +
                '<td> <input type="text" required class="input-sm" name="description_'+max+'" id="description" /> </td>' +
                '<td> <input type="text" class="input-sm" name="service_date_'+max+'" id="description" /> </td>' +
                '<td> <input type="text" class="input-sm" name="time_rate_'+max+'" id="description" /> </td>' +
                '<td> <input type="text" class="input-sm" name="total_'+max+'" id="description" /> </td>' +
                '<td class="order-num"> <i id="del" title="Click to Delete item">x<i> </td>' +
                '</tr>').insertAfter('#tablebody tr:last');
            $("#max").attr('value',max);
        });

    });
    $('#del').live('click',function(){
        var dem=$('#max').val();

        tr=$(this).parent().parent();
        tr.remove();
        dem--;
        $('#max').attr('value',dem);

    });
</script>