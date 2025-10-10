<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */ 
$routes->get('/', 'Home::index');
$routes->get('test', 'Home::test');
$routes->get('testemail', 'Home::sendEmail');
$routes->get('', 'Admin::index');
$routes->get('login', 'LoginController::index');
$routes->post('userlogin', 'LoginController::login');
$routes->get('logout', 'LoginController::logout');
$routes->get('dashboard', 'LoginController::dashboard');
$routes->get('addprivilages', 'Admin::addPrivilages');
$routes->post('save_privileges', 'Admin::savePrivileges');
$routes->get('listPrivileges', 'Admin::listPrivileges');
$routes->get('hubslist', 'Admin::getHubs');
$routes->post('hub/delete/(:num)', 'Admin::deleteHub/$1');
$routes->get('hub/edit/(:num)', 'Admin::editHub/$1');
$routes->post('hub/update/(:num)', 'Admin::updateHub/$1');
$routes->get('addhub', 'Admin::addHub');
$routes->post('hub/create', 'Admin::createHub');
$routes->get('useraccounts', 'Admin::getUsersWithRoles');
$routes->get('adduser', 'Admin::addUser');
$routes->post('user/create', 'Admin::create');
$routes->post('delete/(:num)', 'Admin::deleteuser/$1');
$routes->get('user/edit/(:num)', 'Admin::editUser/$1');
$routes->post('user/update/(:num)', 'Admin::updateUser/$1');
$routes->post('addstaff', 'Admin::staffAdd');
$routes->get('newstaff', 'Admin::addstaff');
$routes->get('staffmanagement', 'Admin::liststaff');
$routes->get('staff/delete/(:num)', 'Admin::deletestaff/$1');
$routes->get('staff/edit/(:num)', 'Admin::editStaff/$1');
$routes->post('staff/update/(:num)', 'Admin::updateStaff/$1');
$routes->get('staff/view/(:num)', 'Admin::viewStaff/$1');
$routes->get('images/(:any)', 'ImageController::serveImage/$1');
$routes->get('staff/salaries', 'Admin::listStaffSalaries');
$routes->get('staff/addadvancepayment', 'Admin::advanceform');
$routes->post('advance-payment/submit', 'Admin::advanceformSubmit');
$routes->get('staff/advancepayments', 'Admin::advancePaymentlist');
$routes->get('auth/forgot_password', 'ForgotPassword::index');
$routes->post('auth/forgot_password/sendResetLink', 'ForgotPassword::sendResetLink');
$routes->get('auth/reset_password/(:segment)', 'ForgotPassword::resetPassword/$1');
$routes->post('auth/updatePassword', 'ForgotPassword::updatePassword');



$routes->get('clients', 'HomeCareController::index');
$routes->get('clients/create', 'HomeCareController::create');
$routes->post('clients/store', 'HomeCareController::store');

$routes->get('clients/edit/(:num)', 'HomeCareController::edit/$1');
$routes->post('clients/update/(:num)', 'HomeCareController::update/$1');
$routes->post('clients/delete/(:num)', 'HomeCareController::delete/$1');



$routes->get('staffs', 'HomeCareController::stafflist');
$routes->get('staffs/create', 'HomeCareController::createStaff');
$routes->post('staffs/store', 'HomeCareController::storeStaff');

$routes->get('staffs/edit/(:num)', 'HomeCareController::editStaff/$1');
$routes->post('staffs/update/(:num)', 'HomeCareController::updateStaff/$1');
$routes->get('staffs/delete/(:num)', 'HomeCareController::deleteStaff/$1');

// Routes for staff-client assignments
$routes->get('assignments', 'HomeCareController::assign');             // Show assignment form
$routes->post('assignments/saveAssignment', 'HomeCareController::saveAssignment');  // Save assignment
$routes->get('listassignments', 'HomeCareController::listAssignments');
$routes->get('assignments/edit/(:num)', 'HomeCareController::editAssignments/$1');
$routes->post('assignments/update/(:num)', 'HomeCareController::updateAssignments/$1');
$routes->post('assignments/delete/(:num)', 'HomeCareController::deleteAssignments/$1');





