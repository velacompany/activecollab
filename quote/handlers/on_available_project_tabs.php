<?php

  /**
   * Calendar module on_available_project_tabs event handler
   * 
   * @package activeCollab.modules.calendar
   * @subpackage handlers
   */

  /**
   * Populate list of available project tabs
   * 
   * @param array $tabs
   */
  function quote_handle_on_available_project_tabs(&$tabs) {
    $tabs['quote'] = lang('Chan');
  } // chan_handle_on_available_project_tabs