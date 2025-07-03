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


$routes->get('families', 'FamilyController::index');
$routes->get('family/create', 'FamilyController::create');
$routes->post('family/store', 'FamilyController::store');
$routes->get('family/(:num)', 'FamilyController::details/$1');
$routes->post('family/delete/(:num)', 'FamilyController::delete/$1');
$routes->get('family/edit/(:num)', 'FamilyController::edit/$1');
$routes->post('family/update/(:num)', 'FamilyController::update/$1');
$routes->get('family/request-certificate', 'FamilyController::requestCertificate');
$routes->post('family/save-certificate', 'FamilyController::saveCertificate');
$routes->get('family/requests', 'FamilyController::certificateList');
$routes->get('family/approve-certificate/(:num)', 'FamilyController::approveCertificate/$1');
$routes->post('family/approve-certificate-action/(:num)', 'FamilyController::certificateAction/$1');
$routes->get('family/certificates', 'FamilyController::myCertificates');
$routes->get('announcements', 'FamilyController::announcements');
$routes->get('add-announcements', 'FamilyController::addAnnouncement');
$routes->post('save-announcement', 'FamilyController::saveAnnouncement');

$routes->get('announcements/edit/(:num)', 'FamilyController::editAnnouncement/$1');
$routes->post('announcements/update/(:num)', 'FamilyController::updateAnnouncement/$1');
$routes->post('announcements/delete/(:num)', 'FamilyController::deleteAnnouncement/$1');

$routes->get('donationpurposes', 'FamilyController::donationPurposes');
$routes->get('donationpurposes/create', 'FamilyController::createdonatnPurposes');
$routes->post('donationpurposes/store', 'FamilyController::storedonatnPurposes');
$routes->get('donationpurposes/edit/(:num)', 'FamilyController::editdonatnPurposes/$1');
$routes->post('donationpurposes/update/(:num)', 'FamilyController::updatedonatnPurposes/$1');
$routes->get('donationpurposes/delete/(:num)', 'FamilyController::deletedonatnPurposes/$1');

$routes->get('donation/add', 'FamilyController::createDonation');
$routes->post('donations/store', 'FamilyController::storeDonation');
$routes->get('donations', 'FamilyController::donationList');
$routes->get('donations/edit/(:num)', 'FamilyController::editDonation/$1');
$routes->post('donations/update/(:num)', 'FamilyController::updateDonation/$1');
$routes->post('donations/delete/(:num)', 'FamilyController::deleteDonation/$1');


$routes->get('payment', 'FamilyController::payment');
$routes->post('payment/proceed', 'FamilyController::paymentProceed');



