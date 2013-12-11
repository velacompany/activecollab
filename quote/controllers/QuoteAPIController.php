<?php

AngieApplication::useController('backend', ENVIRONMENT_FRAMEWORK_INJECT_INTO);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuoteAPIController
 *
 * @author MrHung
 */
class QuoteAPIController extends BackendController {
    function __construct() {
        parent::__construct;
    }

    //put your code here

    function api() {
        
        switch ($_SERVER['REQUEST_METHOD']) {
            case "GET":
                //die;
                $html = $this->getForm();
                echo $html;
                die;
                break;
            case "POST":
                echo 1;
                die;
                $array_data = array(
                    'fullname' => $this->request->post('si_contact_name'),
                    'email_address' => $this->request->post('si_contact_email'),
                    'name_of_your_project' => $this->request->post('si_contact_subject'),
                    'project_type' => $this->request->post('si_contact_ex_field1'),
                    'company_name' => $this->request->post('si_contact_ex_field2'),
                    'address' => $this->request->post('si_contact_ex_field3'),
                    'city_state_zip' => $this->request->post('si_contact_ex_field4'),
                    'phone' => $this->request->post('si_contact_ex_field5'),
                    'website_url' => $this->request->post('si_contact_ex_field6'),
                    'type_of_website' => $this->request->post('si_contact_ex_field7'),
                    'project_budget' => $this->request->post('si_contact_ex_field10'),
                    'website_example' => $this->request->post('si_contact_ex_field11'),
                    'note_or_comment' => $this->request->post('si_contact_ex_field12'),
                    'time_contactf' => $this->request->post('si_contact_ex_field14'),
                    'how_did_youhear' => $this->request->post('si_contact_ex_field15'),
                );
                $table_name = 'quote';
                $quote_model = new Quote();
                $quote_model->addQuote($array_data, $table_name);
                break;
            case "DELETE":
                echo 'del';
                break;
            case "PUT":
                echo 'put';
                break;
        }
        die;
    }

    private function getForm() {
        $html = '<form enctype="multipart/form-data" action="" id="si_contact_form1" method="post">
                <div style="padding-left:0px; text-align:left;">
                <span class="required"> *</span>Required
                   </div>

                <div>
                      <input type="hidden" name="si_contact_CID" value="1">
               </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                       <label for="si_contact_name1">Full Name<span class="required"> *</span></label>
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                       <input style="text-align:left; float:left; padding:2px; margin:0; width:200px; height:20px;" type="text" id="si_contact_name1" name="si_contact_name" value="" size="39">
               </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                       <label for="si_contact_email1">E-Mail Address:<span class="required"> *</span></label>
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                       <input style="text-align:left; float:left; padding:2px; margin:0; width:200px; height:20px;" type="email" id="si_contact_email1" name="si_contact_email" value="" size="39">
               </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                       <label for="si_contact_subject1">Name of your project<span class="required"> *</span></label>
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                       <input style="text-align:left; float:left; padding:2px; margin:0; width:200px; height:20px;" type="text" id="si_contact_subject1" name="si_contact_subject" value="" size="39">
               </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                       <label for="si_contact_ex_field1_1">Project Type<span class="required"> *</span></label>
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                      <select style="text-align:left; float:left; padding:2px; margin:0; width:200px; height:20px;" id="si_contact_ex_field1_1" name="si_contact_ex_field1">
                         <option value="Please Select" selected="selected">Please Select</option>
                 <option value="Website">Website</option>
                 <option value="Graphics Design">Graphics Design</option>
                 <option value="Iphone/Droid App">Iphone/Droid App</option>
                 <option value="ASP/.NET Programming">ASP/.NET Programming</option>
                 <option value="PHP Programming">PHP Programming</option>
                 <option value="Search Engine Optimization">Search Engine Optimization</option>
                 <option value="Monthly Maintenance">Monthly Maintenance</option>
                 <option value="Social Media">Social Media</option>
                  </select>
               </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                       <label for="si_contact_ex_field1_2">Company Name</label>
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                       <input style="text-align:left; float:left; padding:2px; margin:0; width:200px; height:20px;" type="text" id="si_contact_ex_field1_2" name="si_contact_ex_field2" value="" size="39">
               </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                       <label for="si_contact_ex_field1_3">Address</label>
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                       <input style="text-align:left; float:left; padding:2px; margin:0; width:200px; height:20px;" type="text" id="si_contact_ex_field1_3" name="si_contact_ex_field3" value="" maxlength="50" size="39">
               </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                       <label for="si_contact_ex_field1_4">City, State &amp; Zip<span class="required"> *</span></label>
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                       <input style="text-align:left; float:left; padding:2px; margin:0; width:200px; height:20px;" type="text" id="si_contact_ex_field1_4" name="si_contact_ex_field4" value="" maxlength="50" size="39">
               </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                       <label for="si_contact_ex_field1_5">Phone #<span class="required"> *</span></label>
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                       <input style="text-align:left; float:left; padding:2px; margin:0; width:200px; height:20px;" type="text" id="si_contact_ex_field1_5" name="si_contact_ex_field5" value="" maxlength="12" size="39">
               </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                       <label for="si_contact_ex_field1_6">Website URL or Domain Name</label>
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                       <input style="text-align:left; float:left; padding:2px; margin:0; width:200px; height:20px;" type="text" id="si_contact_ex_field1_6" name="si_contact_ex_field6" value="" maxlength="50" size="39">
               </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                       <label for="si_contact_ex_field1_7">If web related, what type of website would you need?</label>
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                      <select style="text-align:left; float:left; padding:2px; margin:0; width:200px; height:20px;" id="si_contact_ex_field1_7" name="si_contact_ex_field7">
                         <option value="please select">please select</option>
                 <option value="Personal">Personal</option>
                 <option value="Small Business">Small Business</option>
                 <option value="E-commerce">E-commerce</option>
                 <option value="Professional">Professional</option>
                 <option value="Corporate">Corporate</option>
                 <option value="Intranet">Intranet</option>
                 <option value="Social Media">Social Media</option>
                  </select>
               </div>

               <div style="text-align:left;">
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                       <input type="checkbox" style="width:13px;" id="si_contact_ex_field1_8" name="si_contact_ex_field8" value="selected" checked="checked">
                       <label style="display:inline;" for="si_contact_ex_field1_8">Do you need SEO?</label>
               </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                       <input type="checkbox" style="width:13px;" id="si_contact_ex_field1_9" name="si_contact_ex_field9" value="selected" checked="checked">
                       <label style="display:inline;" for="si_contact_ex_field1_9">Do you need hosting?</label>
               </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                       <label for="si_contact_ex_field1_10">Your Project Budget (optional)</label>
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                       <input style="text-align:left; float:left; padding:2px; margin:0; width:200px; height:20px;" type="text" id="si_contact_ex_field1_10" name="si_contact_ex_field10" value="" size="39">
               </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                       <label for="si_contact_ex_field1_11">Please enter up to 3 example websites you are basing your project on. (200 chars max)</label>
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                       <textarea style="width:250px; height:100px;" id="si_contact_ex_field1_11" name="si_contact_ex_field11" cols="30" rows="10"></textarea>
               </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                       <label for="si_contact_ex_field1_12">Any additional notes or comments that describe your project? (2000 chars max)<span class="required"> *</span></label>
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                       <textarea style="width:250px; height:150px;" id="si_contact_ex_field1_12" name="si_contact_ex_field12" cols="30" rows="10"></textarea>
               </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                       <label for="si_contact_ex_field1_13">Please upload any design documents related to your project?</label>
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                       <input style="text-align:left; float:left; padding:2px; margin:0; width:200px; height:20px;" type="file" id="si_contact_ex_field1_13" name="si_contact_ex_field13" value="" size="20"><br><span style="font-size:x-small;">Acceptable file types: doc,xls,xlsx,pdf,txt,gif,jpg,jpeg,png.<br>Maximum file size: 1mb.</span>        </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                       <label for="si_contact_ex_field1_14">Best time of the day to contact you?<span class="required"> *</span></label>
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                      <select style="text-align:left; float:left; padding:2px; margin:0; width:200px; height:20px;" id="si_contact_ex_field1_14" name="si_contact_ex_field14">
                         <option value="please select">please select</option>
                 <option value="morning">morning</option>
                 <option value="noon">noon</option>
                 <option value="evening">evening</option>
                 <option value="after 6pm">after 6pm</option>
                 <option value="before 9pm">before 9pm</option>
                  </select>
               </div>

               <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                       <label for="si_contact_ex_field1_15">How did you hear about Lucent One?<span class="required"> *</span></label>
               </div>
               <div style="text-align:left; float:left; padding-top:10px;">
                       <input style="text-align:left; float:left; padding:2px; margin:0; width:200px; height:20px;" type="text" id="si_contact_ex_field1_15" name="si_contact_ex_field15" value="" size="39">
               </div>

                <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;"> </div>


        <div style="width:300px; text-align:left; float:left; clear:left; padding-top:8px; padding-right:10px;">
                  <label for="si_contact_captcha_code1">Enter above security code in this field<span class="required"> *</span></label>
          </div>
          <div style="text-align:left; float:left; padding-top:10px;">
                  <input style="text-align:left; float:right; padding:2px; margin:0; width:100px;" type="text" value="" id="si_contact_captcha_code1" name="si_contact_captcha_code" size="6">
         </div>
          <div style="padding-left:310px; text-align:left; float:left; clear:left; padding-top:8px;">
          <input type="hidden" name="si_contact_action" value="send">
          <input type="hidden" name="si_contact_form_id" value="1">
          <input type="button" id="fsc-submit-1" style="float:right; cursor:pointer; margin:0; width:100px;" name="fsc-submit-1" value="Submit">
        </div>
        </form>';
        return $html;
    }

}

