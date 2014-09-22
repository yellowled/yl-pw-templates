<?php
/**
 * Admin template just loads the admin application controller,
 * and admin is just an application built on top of ProcessWire.
 *
 * Feel free to hook admin-specific functionality from this file,
 * but remember to leave the require() statement below at the end.
 *
 */

require($config->paths->adminTemplates . 'controller.php');
