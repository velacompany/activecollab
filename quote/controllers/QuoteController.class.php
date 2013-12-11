<?php

// Build on top of backend controller
AngieApplication::useController('backend', ENVIRONMENT_FRAMEWORK_INJECT_INTO);

/**
 * System level calendar
 *
 * @package activeCollab.modules.calendar
 * @subpackage controllers
 */
class QuoteController extends BackendController {

    /**
     * Active module
     *
     * @var string
     */
    protected $active_module = QUOTE_MODULE;

    /* file */
    protected $active_file;

    /* email */
    protected $email;

    /**
     * Prepare controller
     */
    function __before() {
        parent::__before();

        $this->wireframe->tabs->clear();
        $this->wireframe->tabs->add('quote', lang('Quote'), Router::assemble('dashboard_quote'), null, true);

        EventsManager::trigger('on_quote_tabs', array(&$this->wireframe->tabs, &$this->logged_user));

        $this->wireframe->breadcrumbs->add('quote', lang('Quote '), Router::assemble('dashboard_quote'));
        $this->wireframe->setCurrentMenuItem('quote');

        // create Flyout form
        if ($this->request->isWebBrowser() && (in_array($this->request->getAction(), array('index', 'view')))) {
            $this->wireframe->actions->add('add_quote', lang('New Quote'), Router::assemble('add_quote'), array(
                'icon' => AngieApplication::getImageUrl('layout/button-add.png', ENVIRONMENT_FRAMEWORK, AngieApplication::getPreferedInterface()),
            ));
        } // if
    }

    /**

     */
    function index() {
        $data = array();
        $quote = new Quote();
        $data = $quote->getData();
        $this->smarty->assign(array(
            'title' => 'Quote ',
            'image' => AngieApplication::getImageUrl('main-menu/quote.png', QUOTE_MODULE),
            'action_url' => Router::assemble('dashboard_quote'),
            'url_load' => MY_PATH,
            'url_image_del' => AngieApplication::getImageUrl('icons/16x16/del.png', QUOTE_MODULE),
            'url_image_edit' => AngieApplication::getImageUrl('icons/16x16/edit.png', QUOTE_MODULE),
            'url_image_cv' => AngieApplication::getImageUrl('icons/16x16/convert.png', QUOTE_MODULE),
            'url_image_loading' => AngieApplication::getImageUrl('icons/16x16/ajax-loader.gif', QUOTE_MODULE),
            'url_image_sc' => AngieApplication::getImageUrl('icons/16x16/success-icon.png', QUOTE_MODULE),
            'data' => $data,
            'i' => 1,
            'url_' => 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?path_info=',
        ));
        if ($this->request->isSubmitted()) {
            echo 'success';
            exit();
        }
    }

// quote

    function add() {
        $this->wireframe->breadcrumbs->add('quote', lang('Quote '), Router::assemble('dashboard_quote'));
        if ($this->request->post()) {
            $data = array();
            $data['fullname'] = $this->request->post('fullname');
            $data['email_address'] = $this->request->post('email_address');
            $data['project_name'] = $this->request->post('project_name');
            $data['project_type'] = $this->request->post('project_type');
            $data['company_name'] = $this->request->post('company_name');
            $data['address'] = $this->request->post('address');
            $data['city_state_zip'] = $this->request->post('city_state_zip');
            $data['website_example'] = $this->request->post('website_example');
            $data['phone'] = $this->request->post('phone');
            $data['website_url'] = $this->request->post('website_url');
            $data['type_of_website'] = $this->request->post('type_of_website');
            $data['project_budget'] = $this->request->post('project_budget');
            $data['time_contactf'] = $this->request->post('time_contactf');
            $data['how_did_youhear'] = $this->request->post('how_did_youhear');
            $data['note_or_comment'] = $this->request->post('note_or_comment');
            $data['time_reg'] = time();

            $Quote = new Quote();
            /* add data to quote */

            /* upload file */
            if (isset($_FILES['design_document'])) {
                if ($_FILES['design_document']['name'] != '') {
                    $this->active_file = new MyQuoteFile($_FILES['design_document']);
                    $q = $this->active_file->Upload();
                    $data['design_document'] = $q['file_name'];
                }
                //if
            }
            //if
            $Quote->addQuote($data);
            /* add data to quote_item */
            $receiveId = $Quote->getQuoteLateId();
            $quoteId = $receiveId['id'];
            $max = $this->request->post('max');
            for ($i = 1; $i <= $max; $i++) {
                $dataItem['quote_id'] = $quoteId;
                $dataItem['description'] = $this->request->post('description_' . $i);
                $dataItem['service_date'] = $this->request->post('service_date_' . $i);
                $dataItem['time_rate'] = $this->request->post('time_rate_' . $i);
                $dataItem['total'] = $this->request->post('total_' . $i);
                if ($dataItem['description'] != '' && $dataItem['service_date'] != '') {
                    $Quote->addQuote($dataItem, $table = 'quote_item');
                }
            }

            $curUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?path_info=dashboard/quote';
            header("Location: {$curUrl}");
            exit();
        }
    }

    function edit() {
        $quote = new Quote();
        $id = explode('/', $_GET['path_info']);
        $dataTrans = $quote->getById($id[1]);
        $dataQuoteId = $quote->get_where('quote_item', array('quote_id' => $id[1]));
        $this->smarty->assign(array(
            'dataEdit' => $dataTrans,
            'quoteItem' => $dataQuoteId,
            'i' => 1,
        ));
        if ($this->request->post('submit') == 'save') {
            $dataReceive['fullname'] = $this->request->post('fullname');
            $dataReceive['email_address'] = $this->request->post('email_address');
            $dataReceive['project_name'] = $this->request->post('project_name');
            $dataReceive['project_type'] = $this->request->post('project_type');
            $dataReceive['company_name'] = $this->request->post('company_name');
            $dataReceive['address'] = $this->request->post('address');
            $dataReceive['city_state_zip'] = $this->request->post('city_state_zip');
            $dataReceive['website_example'] = $this->request->post('website_example');
            $dataReceive['phone'] = $this->request->post('phone');
            $dataReceive['website_url'] = $this->request->post('website_url');
            $dataReceive['type_of_website'] = $this->request->post('type_of_website');
            $dataReceive['project_budget'] = $this->request->post('project_budget');
            $dataReceive['time_contactf'] = $this->request->post('time_contactf');
            $dataReceive['how_did_youhear'] = $this->request->post('how_did_youhear');
            $dataReceive['note_or_comment'] = $this->request->post('note_or_comment');
            $dataReceive['time_modify'] = time();

            // request file
            if (isset($_FILES['design_document'])) {
                if ($_FILES['design_document']['name'] != '' && $_FILES['design_document']['name'] != $this->request->post('file_old')) {
                    $this->active_file = new MyQuoteFile($_FILES['design_document']);
                    $q = $this->active_file->Upload();
                    $file_old = $this->request->post('file_old');
                    $dataReceive['design_document'] = $q['file_name'];
                    @unlink($_SERVER['DOCUMENT_ROOT'] . '/upload/' . $file_old);
                }
                //if
            }//if


            $rsEdit = $quote->update($dataReceive, array('id' => $id[1]), 'quote');
            foreach ($_POST as $key => $value) {
                if (substr($key, 0, 3) == 'id-') {
                    $dataI['description'] = $this->request->post('description_' . $value);
                    $dataI['service_date'] = $this->request->post('service_date_' . $value);
                    $dataI['time_rate'] = $this->request->post('time_rate_' . $value);
                    $dataI['total'] = $this->request->post('total_' . $value);
                    $id = $value;
                    if ($dataI['description'] != '' && $dataI['service_date'] != '') {
                        $quote->update($dataI, array('id' => $id), 'quote_item');
                    }
                }//if
            }//foreach


            $curUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?path_info=dashboard/quote';
            header("Location: {$curUrl}");
            exit();
        }
        //end if save change

        if ($this->request->post('submit') == 'mail') {

            $subject = 'LUCENONE';

            $content = 'Lucenone Quote Form Infomation';
            $data = $_POST;

            $tcpdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $tcpdf->AddPage('p', 'A4');
            $html = $this->createHtmlPDF($data, $dataQuoteId);
            //echo $html;
            //die;
            // output the HTML content
            $tcpdf->writeHTML($html, true, false, true, false, '');
            $tcpdf->lastPage();
            $tcpdf->Output(UPLOAD_PATH . '/' . $data['fullname'] . '.pdf', 'F');
            $attachment = UPLOAD_PATH . '/' . $data['fullname'] . '.pdf';
            $this->email = $this->Email($this->request->post('email_address'), $subject, $content, $attachment);
            $quote->update(array('time_modify' => time(), 'email_notify' => 1), array('id' => $id[1]), 'quote');
            $curUrl = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?path_info=dashboard/quote';
            echo "<script>window.alert('Email was sent');window.location.href='" . $curUrl . "'</script>";
        }
        //end if send mail
    }

// end function edit

    /* delete function */

    function delete() {

        $quote = new Quote();
        $id = explode('/', $_GET['path_info']);
        $quote->delete(array('id' => $id[1]), 'quote');
        $status = array(
            'status' => 1
        );
        echo json_encode($status);
        exit;
        /*
          $curUrl = $_SERVER['HTTP_REFERER'];
          header('Location: ' . $curUrl);
          exit; */
    }

    /*
     * download file with this function
     *
     *
     *  */

    function download() {

        if ($this->$active_file->getType() == 'file') {
            $this->response->respondWithFileDownload($this->$active_file->get, $this->$active_file->getMimeType(), $this->$active_file->getName(), $this->request->get('force'));
        } else {
            $this->response->badRequest();
        } // if
        // if
    }

// download

    /**
     * Create html pdf
     *
     *
     */
    function createHtmlPDF($post = array(), $data = array()) {
        $loop = '';
        $total = 0;
        foreach ($data as $value) {
            $loop .= '<tr>
            <td width="360" colspan="2" valign="top"><p> ' . $value['description'] . ' </p></td>
            <td width="60"><p align="center"> ' . $value['service_date'] . '</p></td>
            <td width="60" colspan="2"><p align="center">' . $value['time_rate'] . '</p></td>
            <td width="60"><p>' . number_format($value['total'], 2) . '</p></td>
            </tr>';
            $total += $value['total'];
        }
        $html = '<table border="1" cellspacing="0" cellpadding="0" width=""  cellpadding="100%">

      <tbody><tr>
        <td width="180" rowspan="3" valign="top"><h2 style="font-size: +10"><strong>For:</strong></h2>
           ' . $_POST['company_name'] . ' <br>
           ' . $_POST['fullname'] . ' <br>
           ' . $_POST['address'] . ' </td>
        <td width="180" rowspan="2" valign="top"><p><strong style="font-size: +10">Contact:</strong> 
           ' . $_POST['fullname'] . '<br>
          <a href="mailto: ' . $_POST['email_address'] . '"> ' . $_POST['email_address'] . ' </a><br>
    <strong style="font-size: +10">Phone:</strong><br>
    Ph:  ' . $_POST['phone'] . ' <br>
    Fax:  ' . $_POST['phone'] . ' <strong style="font-size: +10"> </strong></p></td>
    <td width="180" colspan="4"><p align="center"><strong style="font-size: +10">Proposal Date: </strong>
            ' . date("M-dd-Y", time()) . ' </p></td>
    </tr>
    <tr>
        <td width="180" colspan="4" valign="top"><p align="center">www.lucentone.com<br>
                <strong style="font-size: +10">Ph: </strong>210.775.2495<strong style="font-size: +10"></strong><br>
                <strong style="font-size: +10">Email: </strong>sales@lucentone.com<strong
                    style="font-size: +10"></strong><br>
                <strong style="font-size: +10">Support</strong>:<strong style="font-size: +10"> </strong>support@crucialnic.com<strong
                    style="font-size: +10"></strong></p></td>
    </tr>
    <tr>
        <td width="180" valign="top"><h2 style="font-size: +10">&nbsp;</h2></td>
        <td width="180" colspan="4" valign="top"><h2 style="font-size: +10">Project Manager/Designers:</h2>

            <p>Tracy Stewart</p></td>
    </tr>
    <tr>
        <td width="360" colspan="2" rowspan="5" valign="top"><h2 style="font-size: +10">Project Notes:</h2>

            <p>All project details outlined below.</p></td>
        <td width="180" colspan="4" valign="top"><h2 style="font-size: +10">Support technician: </h2>Tracy Stewart</td>
    </tr>
    <tr>
        <td width="180" colspan="4" valign="top"><h2 style="font-size: +10">Hosting support provided by:</h2> Crucial NIC
        </td>
    </tr>
    <tr>
        <td width="180" colspan="4" valign="top"><h2 style="font-size: +10">Domain: domain.com </h2></td>
    </tr>
    <tr>
        <td width="180" colspan="4" valign="top"><h2 style="font-size: +10">Project Provisions: </h2>N/A</td>
    </tr>
    <tr>
        <td width="180" colspan="4" valign="top"><h2 style="font-size: +10">Server Hosting:</h2> Server Hosting Provided by
            Crucial NIC
        </td>
    </tr>
    <tr style="text-align: center">

        <td width="360" colspan="2"><p>Description of Services</p></td>
        <td width="60"><p>Service Dates</p></td>
        <td width="60" colspan="2"><p>Time/Rate</p></td>
        <td width="60"><p>Total</p></td>
    </tr>

    <!--loop here --->
   
        ' . $loop . '
      
    <!--end loop here -->
    <tr>
        <td width="360" colspan="2" rowspan="7" valign="top"><p><strong style="font-size: +10">Payments:</strong><br>
                 Server and hosting payments are due in advance of monthly services.<br>
                 Projects Require a 50% Deposit before work can begin.<br>
                 Project balance is due upon completion of services unless extension is agreed upon by client and Lucent One for further work.<br>
                 Project consultation fees will be acknowledged and billed at the hourly rate for any project research and/or consultation provided before project begins.<br>
                 Monthly maintenance plans include any website updates, image or content changes, bug fixes or programming. Does not include graphics work.<br>
                 Balances past due 30+ days are subject to $25 late fee and 12% interest.<br>
                 Make all checks payable to:<br>
                 Lucent One, 11334 Victory Cavern, San Antonio, TX 78254<br>

                <strong style="font-size: +10">Lucent One, 11334 Victory Cavern, San Antonio, TX 78254</strong></p></td>
        <td width="90" colspan="3"><p>Project/Web Total Amount</p></td>
        <td width="90" valign="top"><p>' . number_format($total, 2) . '</p></td>
    </tr>
    <tr>
        <td width="90" colspan="3"><p>Credits</p></td>
        <td width="90" valign="top"><p>0.00</p></td>
    </tr>
    <tr>
        <td width="90" colspan="3"><p>Hosting / Server Fees </p></td>
        <td width="90" valign="top"><p>0.00</p></td>
    </tr>
    <tr>
        <td width="90" colspan="3"><p>TOTAL Amount</p></td>
        <td width="90"><p>' . number_format($total, 2) . '</p></td>
    </tr>
    <tr>
        <td width="90" colspan="3"><p>1/2 Deposit plus ANY Monthly Maintenance Fees</p></td>
        <td width="90"><p>180.00</p></td>
    </tr>
    <tr>
        <td width="90" colspan="3"><p>Balance</p></td>
        <td width="90"><p>$180.00</p></td>
    </tr>
    <tr>
        <td width="90" colspan="3"><p>Date Due</p></td>
        <td width="90"><p align="center">Upon Acceptance</p></td>
    </tr>
    </tbody></table>';
        return $html;
    }

    /*
     * create email
     * $Recipients mail
     * $subject : title of email
     * $content : content of email
     * $attachment: file attachment
     *  */

    function Email($Recipients, $subject, $content, $attachment) {

        $mail = new PHPMailer(); // defaults to using php "mail()"

        $mail->IsSendmail(); // telling the class to use SendMail transport

        $body = $content;
        //$body = preg_replace("[\]", '', $body);

        $mail->SetFrom(ADMIN_EMAIL, 'LUCENONE'); // SENDER

        $mail->AddReplyTo(ADMIN_EMAIL); //Reply to this email

        $address = $Recipients; // Recipients  Emai

        $mail->AddAddress($address, "Lucenone");

        $mail->IsHTML(true);

        $mail->Subject = $subject;

        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

        $mail->MsgHTML($body);
        // attachment
        $mail->AddAttachment($attachment);

        if (!$mail->Send()) {
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            
        }
    }

    function convert() {
        $quote = new Quote();
        $id = explode('/', $_GET['path_info']);
        $rs_row = $quote->getById($id[1]); // get info quote

        $company = array(
            'name' => $rs_row['company_name'],
            'created_on' => date("Y-m-d H:i:s"),
            'created_by_id' => '1',
            'created_by_name' => null,
            'created_by_email' => null,
        );
        $quote->addQuote($company, 'companies');

        // end insert companies

        $lastData = $quote->InsertLastId('companies');
        $dataInvoice = array(
            'company_id' => $lastData['id'],
            'currency_id' => 2,
            'language_id' => 0,
            'company_address' => $rs_row['address'],
            'comment' => null,
            'note' => $rs_row['note_or_comment'],
            'created_on' => date("Y-m-d H:i:s"),
        );
        $quote->addQuote($dataInvoice, 'invoices');
        // end insert invoices

        $dataInvoiceItem = $quote->get_where('quote_item', array('quote_id' => $rs_row['id']));
        $lastInvoice = $quote->InsertLastId('invoices');
        foreach ($dataInvoiceItem as $invoiceItem) {
            $invItem['invoice_id'] = $lastInvoice['id'];
            $invItem['position'] = 1;
            $invItem['tax_rate_id'] = 0;
            $invItem['description'] = $invoiceItem['description'];
            $invItem['quantity'] = 1;
            $invItem['unit_cost'] = null;
            $quote->addQuote($invItem, 'invoice_items');
        }

        // end insert invoice item
        $status = array(
            'status' => 1,
        );

        $rs = $quote->delete(array('id' => $id[1]), 'quote');
        $rs = $quote->delete(array('quote_id' => $id[1]), 'quote_item');
        echo json_encode($status);
        exit;
    }

    /*
     * 
     * 
     */

    function api() {

        switch ($_SERVER['REQUEST_METHOD']) {
            case "GET":
                //die;
                $html = $this->getForm();
                echo $html;
                die;
                break;
            case "POST":
                $quote_model = new Quote();
                $id = $this->request->post('id');
                if ($id != 0 || $id != null) {
                    $array_data = array(
                        'fullname' => $this->request->post('fullname'),
                        'email_address' => $this->request->post('email_address'),
                        'project_name' => $this->request->post('project_name'),
                        'project_type' => $this->request->post('project_type'),
                        'company_name' => $this->request->post('company_name'),
                        'address' => $this->request->post('address'),
                        'city_state_zip' => $this->request->post('city_state_zip'),
                        'phone' => $this->request->post('phone'),
                        'website_url' => $this->request->post('website_url'),
                        'type_of_website' => $this->request->post('type_of_website'),
                        'project_budget' => $this->request->post('project_budget'),
                        'website_example' => $this->request->post('website_example'),
                        'note_or_comment' => $this->request->post('note_or_comment'),
                        'time_contactf' => $this->request->post('time_contactf'),
                        'how_did_youhear' => $this->request->post('how_did_youhear'),
                    );
                    $quote_model->update($array_data, array('id'=>$id));
                } else {
                    $array_data = array(
                        'fullname' => $this->request->post('fullname'),
                        'email_address' => $this->request->post('email_address'),
                        'project_name' => $this->request->post('project_name'),
                        'project_type' => $this->request->post('project_type'),
                        'company_name' => $this->request->post('company_name'),
                        'address' => $this->request->post('address'),
                        'city_state_zip' => $this->request->post('city_state_zip'),
                        'phone' => $this->request->post('phone'),
                        'website_url' => $this->request->post('website_url'),
                        'type_of_website' => $this->request->post('type_of_website'),
                        'project_budget' => $this->request->post('project_budget'),
                        'website_example' => $this->request->post('website_example'),
                        'note_or_comment' => $this->request->post('note_or_comment'),
                        'time_contactf' => $this->request->post('time_contactf'),
                        'how_did_youhear' => $this->request->post('how_did_youhear'),
                    );
                    $table_name = 'quote';
                    $quote_model->addQuote($array_data, $table_name);
                }

                $status = array('status' => true);
                break;
                echo json_encode($status);
                exit;
            case "DELETE":
                $id = $_REQUEST['id'];
                $quote_model = new Quote();
                $quote_model->delete(array('id' => $id));
                $status = array('status' => true);
                break;
                echo json_encode($status);
                exit();
            case "PUT":
                echo 'put';
                break;
        }
        die;
    }

    private function getForm() {
        $html = '<form enctype="multipart/form-data" action="http://project.dev/public/index.php?path_info=api/quote&auth_api_token=6-FpUA0j2TmgMiXfVbLcnmMF8m0CBax0V4oFsmOj72" id="si_contact_form1" method="post">
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
    </form>

    <script src="http://code.jquery.com/jquery-1.10.2.min.js">
    <script src=" http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js">
    </script>
    <script>
            jQuery(document).ready(function(){
                    jQuery("#fsc-submit-1").click(function(){
                            //data
                            var fullName = jQuery("#si_contact_name1").val();
                            var email = jQuery("#si_contact_email1").val();
                            var projectName = jQuery("#si_contact_subject1").val();
                            var projectType = jQuery("#si_contact_ex_field1_1").val();
                            var companyName = jQuery("#si_contact_ex_field1_2").val();
                            var adrress = jQuery("#si_contact_ex_field1_3").val();
                            var zip = jQuery("#si_contact_ex_field1_4").val();
                            var phone = jQuery("#si_contact_ex_field1_5").val();
                            var domain = jQuery("#si_contact_ex_field1_6").val();
                            var webtype = jQuery("#si_contact_ex_field1_7").val();
                            var buddget = jQuery("#si_contact_ex_field1_10").val();
                            var examp = jQuery("#si_contact_ex_field1_11").val();
                            var note = jQuery("#si_contact_ex_field1_12").val();
                            var contactTime = jQuery("#si_contact_ex_field1_14").val();
                            var hearAbout = jQuery("#si_contact_ex_field1_15").val();


                            //ajax post
                            jQuery.ajax({
                              type: "POST",
                              crossDomain: true,
                              url: "http://project.dev/index.php?path_info=api/quote&auth_api_token=6-FpUA0j2TmgMiXfVbLcnmMF8m0CBax0V4oFsmOj72",
                                      data: {
                            "fullname" : fullName,
                              "email_address" : email,
                            "project_name" : projectName,
                            "project_type" : projectType,
                            "company_name": companyName,
                            "address": adrress,
                            "city_state_zip": zip,
                            "phone": phone,
                            "website_url": domain,
                            "type_of_website": webtype,
                            "project_budget": buddget,
                            "website_example": examp,
                            "note_or_comment": note,
                            "time_contactf" : contactTime,
                            "how_did_youhear": hearAbout
                                             }
                            }).done(function( msg ){
                });

                    });
                });
                </script>

                ';
        return $html;
    }

}
