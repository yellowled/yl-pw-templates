<?php namespace ProcessWire;
/**
 *  Internal or external redirects in primary nav
 */

if($page->redirect_url) $session->redirect($page->redirect_url);
