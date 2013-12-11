<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>
{title}Edit Quote{/title}
<div>

    <div class="object_title">Edit Quote</div>
    <form action="" id="edit-quote" name="add-quote" method="post" onsubmit="return validateForm()"
          enctype="multipart/form-data">
        <div class="colspan5">

            <div class="control-group">
                <div class="label"><label for="fullname">Full name * </label></div>
                <input class="input-lg" type="text" required placeholder="Full name ................Required" name="fullname"
                   required    id="fullname" value="{$dataEdit.fullname}"/>
            </div>

            <div class="control-group">
                <div class="label"><label for="email_address">Email address: * </label></div>
                <input class="input-lg" type="text" placeholder=" Email address ..........Required "
                      required name="email_address" id="email_address" required value="{$dataEdit.email_address}"/>
            </div>

            <div class="control-group">
                <div class="label"><label for="name_of_your_project">Name of project: </label></div>
                <input class="input-lg" type="text" required placeholder=" Name of your project ..........Required "
                     required  name="project_name" value="{$dataEdit.project_name}" id="project_name"/>
            </div>

            <div class="control-group">
                <div class="label"><label for="project_type">Project type *</label></div>
                <select  required name="project_type" id="project_type">
                    <option value="">Please select</option>
                    <option
                    {if {$dataEdit.project_type =='Website'} }selected="selected" {/if} value="Website">Website</option>
                    <option
                    {if {$dataEdit.project_type =='Graphic Design'} }selected="selected" {/if} value="Graphic
                    Design">Graphic Design</option>
                    <option
                    {if {$dataEdit.project_type =='Iphone/Droid App'} }selected="selected" {/if} value="Iphone/Droid
                    App">Iphone/Droid App</option>
                    <option
                    {if {$dataEdit.project_type =='ASP/.NET Programming'} }selected="selected" {/if}value="ASP/.NET
                    Programming">ASP/.NET Programming</option>
                    <option
                    {if {$dataEdit.project_type =='PHP programming'} }selected="selected" {/if} value="PHP
                    programming">PHP programming</option>
                    <option
                    {if {$dataEdit.project_type =='Search Engine Optimization'} }selected="selected" {/if}value="Search
                    Engine Optimization">Search Engine Optimization</option>
                    <option
                    {if {$dataEdit.project_type =='Monthly Maintance'} }selected="selected" {/if}value="Monthly
                    Maintance">Monthly Maintance</option>
                    <option
                    {if {$dataEdit.project_type =='Social Media'} }selected="selected" {/if} value="Social Media">Social
                    Media</option>
                </select>
            </div>

            <div class="control-group">
                <div class="label"><label for="company_name">Company name: </label></div>
                <input class="input-lg" required type="text" placeholder=" Company name " value="{$dataEdit.company_name}"
                       name="company_name" id="company_name"/>
            </div>

            <div class="control-group">
                <div class="label"><label for="address">Address : </label></div>
                <input class="input-lg" required type="text" placeholder=" Address" value="{$dataEdit.address}" name="address"
                       id="address"/>
            </div>

            <div class="control-group">
                <div class="label"><label for="city_state_zip">City, State.. </label></div>
                <input class="input-lg" type="text" placeholder="City , State & Zip ........ Required"
                    required   name="city_state_zip" value="{$dataEdit.address}" id="city_state_zip"/>
            </div>

            <div class="control-group">
                <label for="website_example">Please enter up to 3 example websites you are basing your project on. (200
                    chars max): </label></br></br>
                <textarea name="website_example">{$dataEdit.website_example}</textarea>
            </div>

        </div>
        <!-- end span5 -->

        <div class="colspan5">
            <div class="control-group">
                <div class="label"><label for="phone">Phone # * </label></div>
                <input class="input-lg" type="text" placeholder="Phone ..... Require" name="phone" id="phone"
                    required   value="{$dataEdit.phone}"/>
            </div>

            <div class="control-group">
                <div class="label"><label for="website_url">Website URL : </label></div>
                <input class="input-lg" type="text" placeholder="Website url or Domain name..." name="website_url"
                       value="{$dataEdit.website_url}" id="website_url"/>
            </div>

            <div class="control-group">
                <div class="label"><label for="type_of_website">Type of website </label></div>
                <select name="type_of_website" id="type_of_website">
                    <option value="">If web related, what type of website would you need?</option>
                    <option
                    {if {$dataEdit.type_of_website =='personal'} }selected="selected" {/if}
                    value="personal">Personal</option>
                    <option
                    {if {$dataEdit.type_of_website =='small_Business'} }selected="selected" {/if}
                    value="small_Business">Small Business</option>
                    <option
                    {if {$dataEdit.type_of_website =='Ecommerce'} }selected="selected" {/if}
                    value="Ecommerce">E-commerce</option>
                    <option
                    {if {$dataEdit.type_of_website =='professional'} }selected="selected"
                    {/if}value="professional">Professional</option>
                    <option
                    {if {$dataEdit.type_of_website =='corporate'} }selected="selected"
                    {/if}value="corporate">Corporate</option>
                    <option
                    {if {$dataEdit.type_of_website =='intranet'} }selected="selected"
                    {/if}value="intranet">Intranet</option>
                    <option
                    {if {$dataEdit.type_of_website =='socialMedia'} }selected="selected" {/if}value="socialMedia">Social
                    media</option>

                </select>

            </div>

            <div class="control-group">
                <div class="label"><label for="project_budget">Project Budget: </label></div>
                <input class="input-lg" type="text" placeholder="Your project budget" name="project_budget"
                       value="{$dataEdit.project_budget}" id="project_budget" value="{$dataEdit.project_budget}"/>
            </div>

            <div class="control-group">
                <div class="label"><label for="design_document">File Document : </label></div>
                <a>{$dataEdit.design_document}</a>
                <input class="" type="file" name="design_document" id="design_document" value=""/>
                <input type="hidden" name="file_old" value="{$dataEdit.design_document}"/>
            </div>
            <div class="control-group">
                <div class="label"><label for="time_contact">Time to contact ? </label></div>
                <select required name="time_contactf" id="time_contactf">
                    <option value="">Select Best time of the day to contact you</option>
                    <option
                    {if {$dataEdit.time_contactf =='Morning'} }selected="selected" {/if}
                    value="Morning">Morning</option>
                    <option
                    {if {$dataEdit.time_contactf =='Noon'} }selected="selected" {/if} value="Noon">Noon</option>
                    <option
                    {if {$dataEdit.time_contactf =='Evening'} }selected="selected" {/if}
                    value="Evening">Evening</option>
                    <option
                    {if {$dataEdit.time_contactf =='After 6pm'} }selected="selected" {/if} value="After 6pm">After
                    6pm</option>
                    <option
                    {if {$dataEdit.time_contactf =='Before 9pm'} }selected="selected" {/if} value="Before 9pm">Before
                    9pm</option>
                </select>
            </div>
            <div class="control-group">
                <div class="label"><label for="how_did_youhear">How did you ..? </label></div>
                <input class="input-lg" type="text" placeholder="How did you hear about Lucent One? .. Require"
                       required value="{$dataEdit.how_did_youhear}" name="how_did_youhear" id="time_contact"/>
            </div>
            <div class="control-group">
                <label for="note_or_comment">Any additional notes or comments that describe your project? (2000 chars
                    max) : </label></br></br>
                <textarea name="note_or_comment"
                         required placeholder="Note or comment ..... Require">{$dataEdit.note_or_comment}</textarea>
            </div>

        </div>
        <!-- end span5-->
        <div class="clear_fix"></div>

        <table>
            <thead>
            <tr>
                <th class="order-num">#</th>
                <th>Description</th>
                <th>Service date</th>
                <th>Time/rate</th>
                <th>Total</th>
                <th></th>
            </tr>
            </thead>
            <!-- end head-->
            <tbody id="tablebody">
            {foreach from=$quoteItem key=id item=row }
            <tr class="num-1">
                <td class="order-num">{$i++}</td>
                <td><input type="text" class="input-sm" required name="description_{$row.id}" value="{$row.description}"/></td>
                <td><input type="text" class="input-sm" name="service_date_{$row.id}" value="{$row.service_date}"/></td>
                <td><input type="text" class="input-sm" name="time_rate_{$row.id}" value="{$row.time_rate}"/></td>
                <td><input type="text" class="input-sm" name="total_{$row.id}" id="description" value="{$row.total}"/></td>
                <td><input type="hidden" name="id-{$row.id}"value="{$row.id}" /></td>
            </tr>
            {/foreach}
            </tbody>
            <!-- end body-->

        </table>
        <input name="max" id="max" type="hidden" value="1"/>

        <button type="submit" value="save" class="btn-green create" name="submit" id="submit">Save Change </button>
        {if {$dataEdit.email_notify == 0} }
        <button type="submit" value="mail" class="btn-danger create" name="submit" title="Click for send" id="submit">Send mail</button>
        {/if}
        {if {$dataEdit.email_notify == 1} }
        <button type="submit" value="mail" class="btn-warning create" title="Click for resend" name="submit" id="submit">Email was sent</button>
        {/if}


    </form>
</div>
<script>
    jQuery(document).ready(function(){
    $("#edit").validate();
});
</script>
