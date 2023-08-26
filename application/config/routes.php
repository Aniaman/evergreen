<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home';

$route['Login'] = 'home/lg';
$route['Enquiry'] = 'home/enquiry';

//Agent Route
$route['Dashboard'] = 'Agent/dashboard';
$route['New-Enquiry'] = 'Agent/newEnquiry';
$route['All-Enquiry'] = 'Agent/allEnquiry';
$route['Generate-Quotation'] = 'Agent/Generate';
$route['Download-PDF/(:any)'] = 'Agent/downloadPdf';
$route['Reminder'] = 'Agent/reminderDate';
$route['follow-Up'] = 'Agent/followup';
$route['Follow-Up-Data/(:any)/(:any)/(:any)'] = 'Agent/followUpData';
$route['Self-Enquiry'] = 'Agent/selfEnquiry';
$route['PaymentTerm-Add-Action'] = 'Agent/paymentTermAddAction';
$route['PaymentTerm-Edit-Action'] = 'Agent/paymentTermEditAction';
$route['Calculate-ROI'] = 'Agent/calculateRoi';
$route['Agent-Success'] = 'Agent/dashboard';
$route['Return-Dashboard'] = 'Agent/returnDashboard';
$route['Create-Project/(:any)'] = 'Agent/createProject';
$route['Create-Project-Action'] = 'Agent/createProjectAction';
$route['Update-Warranty'] = 'Agent/updateWarranty';
$route['Project-Lists'] = 'Agent/projectList';
$route['View-Project-Details'] = 'Agent/projectDetails';
$route['Export-To-Excel'] = 'Agent/bomExportToExcel';

//quotation flow Route in Agent
$route['Quotation-Process/(:any)'] = 'Agent/geneQuote';
$route['Accept-Enquiry/(:any)'] = 'Agent/AcceptEnq';




//Admin Route
$route['Clone-Enquiry'] = 'Admin/cloneEnquiry';
$route['Clone'] = 'Admin/cloneEnquiryAction';
$route['Enquiry-List'] = 'Admin/enquiry';
$route['Payment-Term'] = 'Admin/paymentTermList';
$route['Work-CheckList'] = 'Admin/workCheckList';
$route['PaymentTerm-Action'] = 'Admin/paymentTermAction';
$route['Delete-PaymentTerm'] = 'Admin/deletePaymentTerm';
$route['Term-And-Condition'] = 'Admin/termAndCondition';
$route['Term-Condition-Action'] = 'Admin/termConditionAction';
$route['Agent-Transfer'] = 'Admin/agentTransfer';
$route['Admin-Success'] = 'Admin/dashboard';
$route['Reference-Enquiry'] = 'Admin/referenceEnquiry';
$route['Counter-Commission'] = 'Admin/counterCommission';
$route['Accept-Offer-Admin/(:any)/(:any)'] = 'Admin/acceptOffer';
$route['Delete-Term-Condition/(:any)'] = 'Admin/deleteTermAndCondition';
$route['Reference-Enquiry-List'] = 'Admin/referenceEnquiryList';
$route['Create-Team'] = 'Admin/register';
$route['Project-List'] = 'Admin/projectList';
$route['Project-Details'] = 'Admin/projectDetails';
$route['Customer-Document'] = 'Admin/customerDocuments';
$route['Document-Action'] = 'Admin/customerDocumentsAction';
$route['Delete-Document'] = 'Admin/deleteDocument';
$route['Quotation-Status'] = 'Admin/quotationStatus';
$route['Quotation-Status-Action'] = 'Admin/quotationStatusAction';
$route['Status-Action'] = 'Admin/statusAction';
$route['Product-Category'] = 'Admin/productCategory';
$route['Quotation-Not-Generate'] = 'Admin/quotationNotGenerate';
$route['Payment-Report'] = 'Admin/paymentReport';


//Login - register

$route['Failed'] = 'Login/fail';
$route['Logout'] = 'Login/logout';
$route['Logout-customer'] = 'Login/logoutCustomer';
$route['Register'] = 'Login/register';
$route['Register-Action'] = 'Login/registerAction';

//Sales-Coordination
$route['Sales-DashBoard'] = 'SalesCoordination';
$route['Add-Enquiry'] = 'SalesCoordination/addEnquiry';
$route['Confirm-Enquiry'] = 'SalesCoordination/confirmEnquiry';
$route['Add-Enquiry-Action'] = 'SalesCoordination/addEnquiryAction';
$route['Delete-Enquiry/(:any)'] = 'SalesCoordination/deleteEnquiry';
$route['Edit-Enquiry-Action'] = 'SalesCoordination/editEnquiryAction';
$route['Accept-Offer/(:any)'] = 'SalesCoordination/acceptOffer';
$route['Download-Quotation'] = 'SalesCoordination/downloadQuotation';

// Customer
$route['Customer-DashBoard'] = 'Customer/dashboard';
$route['Customer'] = 'Customer/customerLogin';
$route['Project-Detail-View'] = 'Customer/projectDetails';



// Finance
$route['Finance-DashBoard'] = 'Finance/dashboard';
$route['Payment-Received'] = 'Finance/paymentAction';
$route['Document-Received'] = 'Finance/documentUpload';
$route['Quotation-Details'] = 'Finance/quotationDetails';
$route['export-to-excel'] = 'Finance/exportToExcel';



$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
