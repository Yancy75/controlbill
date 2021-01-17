<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('principal');
//    return view('bill');
});

Auth::routes(['register' => false]);

Route::get('/', 'BillController@irInicio')->name('IrInicio');

Route::get('search_store', 'BillController@searchStore')->name("searchStore");

Route::get('search_plu', 'BillController@searchPlu')->name("searchPLU");
Route::get('search_vendor', 'BillController@searchVendor')->name("searchVendor");
Route::get('add_product_to_bill', 'BillController@store')->name("rutaAddProductToBill");
Route::get('search_products_bill_open', 'BillController@rutaSearchProductsBillOpen')->name("rutaSearchProductsBillOpen");
Route::get('delete_entrance/{id?}', 'BillController@destroy')->name("rutaDeleteEntrance");
Route::get('save_products_bill_open', 'BillController@saveProductsBillOpen')->name("rutaSaveProductsBillOpen");

Route::get('get_bill', 'BillController@getBills')->name("getBill");
Route::get('search_bills', 'BillController@SearchBills')->name("rutaSearchBills");
Route::get('bill', 'BillController@index')->name("controlBill");

Route::get('get_report', 'ReportsController@index')->name("getReport");
Route::get('search_reports', 'ReportsController@searchReports')->name("rutaSearchReports");
Route::get('getting_report', 'ReportsController@getReports')->name("rutaGetReports");
Route::get('get_report2', 'ReportsController@formReport2')->name("getReport2");
Route::get('search_reports2', 'ReportsController@searchReportsPlu')->name("rutaSearchReports2");

Route::get('form_add_vendor', 'VendorController@create')->name("formVendor");

Route::post('adding_vendor', 'VendorController@store')->name("addVendor");
Route::get('list_vendor', 'VendorController@index')->name("listVendor");

Route::get('payroll', 'PayrollController@index')->name('payRoll');
Route::get('Dashboard_payroll', 'PayrollController@dashboard');

Route::get('supermarket', 'PayrollController@supermarket')->name('supermarket_list');
Route::get('add_supermarket', 'PayrollController@create')->name('add_supermarket');
Route::post('adding_supermarket', 'PayrollController@store')->name('adding_supermarket');
Route::get('modify_supermarket/{id}', 'PayrollController@modifySupermarket')->name('modify_super');
Route::post('modifying_supermarket/{id}', 'PayrollController@modifyingSupermarket')->name('modifying_super');

Route::get('user_list', 'PayrollController@userList')->name('user_list');
Route::get('add_user', 'PayrollController@addUser')->name('add_user');
Route::post('adding_user', 'PayrollController@addingUser')->name('adding_user');
Route::get('modify_user/{id}', 'PayrollController@modifyUser')->name('modify_user');
Route::post('modifying_user/{id}', 'PayrollController@modifyingUser')->name('modifying_user');
Route::get('password_user/{id}', 'PayrollController@passwordUser')->name('password_user');
Route::post('change_password_user/{id}', 'PayrollController@passwordChangeUser')->name('change_password_user');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('department_list/{id}', 'PayrollController@departmentList')->name('department_list');
Route::get('department_add', 'PayrollController@departmentAdd')->name('add_department');
Route::get('department_modify', 'PayrollController@departmentModify')->name('modify_department');

Route::get('roll_user_list/{id}', 'PayrollController@rollUserList')->name('roll_user_list');
Route::get('roll_user_in/{user_id}/{super_id}', 'PayrollController@rollIn')->name('roll_in');
Route::get('roll_user_out/{id}', 'PayrollController@rollOut')->name('roll_out');

Route::get('select_supermarket/{id}', 'PayrollController@selectSupermarket')->name('select_supermarket');

Route::get('employees_list/{id_supermarket}/{view?}', 'PayrollController@employeeList')->name('employees_list');
Route::get('add_employee/{id_supermarket}', 'PayrollController@employeeAdd')->name('add_employee');
Route::post('adding_employee', 'PayrollController@addingEmployee')->name('adding_employee');
Route::get('modify_employee/{id}/{view_modify}', 'PayrollController@modifyEmployee')->name('modify_employee');
Route::post('modifying_employee/{id}', 'PayrollController@modifyingEmployee')->name('modifying_employee');

Route::get('general_setting_supermarket/{id_supermarket}', 'PayrollsetController@edit')->name('general_setting_supermarket');
Route::post('enter_general_setting/{id_supermarket}', 'PayrollsetController@update')->name('enter_general_setting');

Route::get('employee_payroll_setting/{id}/{view_modify}', 'PayrollsetController@employeePayrollSetting')->name('employee_payroll_setting');
Route::post('enter_employee_payroll_setting', 'PayrollsetController@enterEmployeePayrollSetting')->name('enter_employee_payroll_setting');

Route::get('payroll_setting/{id_supermarket}', 'PayrollsetController@payrollSetting')->name('payroll_setting');
Route::get('set_payroll_setting/{id_supermarket}', 'PayrollsetController@setPayrollSetting')->name('set_payroll_setting');
Route::post('add_payroll_info', 'PayrollsetController@addPayrollInfo')->name('add_payroll_info');
Route::get('view_payroll_info/{date}', 'PayrollsetController@viewPayrollInfo')->name('view_payroll_info');
Route::get('view_payroll_info_without_menu/{date}', 'PayrollsetController@viewPayrollInfoWithoutMenu')->name('view_payroll_info_without_menu');
Route::get('view_payroll_info_without_menu_double/{date}', 'PayrollsetController@viewPayrollInfoWithoutMenuDouble')->name('view_payroll_info_without_menu_double');

Route::get('modify_employee_payroll_info/{id}', 'PayrollsetController@modifyEmploeePayrollInfo')->name('modify_employee_payroll_info');
Route::post('update_employee_payroll_info', 'PayrollsetController@updateEmploeePayrollInfo')->name('update_employee_payroll_info');

Route::get('add_individual_employee/{date}', 'PayrollsetController@addIndividualEmployee')->name('add_individual_employee');
Route::post('add_employee_to_payroll/{id_supermarket}', 'PayrollsetController@addingEmployeeToPayroll')->name('add_employee_to_payroll');

Route::get('view_report_department/{id_supermarket}', 'ReporteDepartmentController@index')->name('ver_reporte_department');
Route::get('add_department_report', 'ReporteDepartmentController@store')->name('add_department_report');
Route::get('modify_department_report', 'ReporteDepartmentController@departmentModify')->name('modify_department_report');
Route::get('report_depart_add_payrolldepartment/{id}', 'ReporteDepartmentController@show')->name('report_depart_add_payrolldepartment');
Route::post('link_report_payroll_department', 'ReporteDepartmentController@linkReportPaymentDepartment')->name('link_report_payroll_department');

Route::get('view_purchase/{id_supermarket}', 'PurchaseController@index')->name('view_purchase');
Route::get('add_purchase/{id_supermarket}', 'PurchaseController@create')->name('add_purchase');
Route::post('adding_purchase', 'PurchaseController@store')->name('adding_purchase');
Route::get('modify_purchase/{id_purchase}/{id_supermarket}', 'PurchaseController@show')->name('modify_purchase');
Route::post('modifying_purchase/{id_supermarket}', 'PurchaseController@update')->name('modifying_purchase');

Route::get('view_sale/{id_supermarket}', 'SaleController@index')->name('view_sale');
Route::get('add_sale/{id_supermarket}', 'SaleController@create')->name('add_sale');
Route::post('adding_sale', 'SaleController@store')->name('adding_sale');
Route::get('modify_sale/{id_sale}/{id_supermarket}', 'SaleController@edit')->name('modify_sale');
Route::post('modifying_sale/{id_supermarket}', 'SaleController@update')->name('modifying_sale');

Route::get('view_expenses/{id_supermarket}', 'ExpenseController@index')->name('view_expenses');
Route::get('add_expense/{id_supermarket}', 'ExpenseController@create')->name('add_expense');
Route::post('adding_expense', 'ExpenseController@store')->name('adding_expense');
Route::get('modify_expense/{id_expense}/{id_supermarket}', 'ExpenseController@edit')->name('modify_expense');
Route::post('modifying_expense/{id_supermarket}', 'ExpenseController@update')->name('modifying_expense');

Route::get('view_report/{id_supermarket}', 'ReportstoreController@index')->name('view_report');
Route::post('view_report/{id_supermarket}', 'ReportstoreController@show')->name('calcular_report');

Route::get('activar_pto_al_llegar_fecha_activacion', 'PayrollsetController@activarPTOAlLegarFechaDeActivacion');

Route::get('/active_pto', 'StaticController@activarPTO');
