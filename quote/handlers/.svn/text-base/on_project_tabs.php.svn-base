<?php

  /**
   * Calendar on_project_tabs handler
   *
   * @package activeCollab.modules.calendar
   * @subpackage handlers
   */
  
  /**
   * Handle on project tabs event
   *
   * @param NamedList $tabs
   * @param User $logged_user
   * @param Project $project
   * @param array $tabs_settings
   * @param string $interface
   */
  function quote_handle_on_project_tabs(&$tabs, &$logged_user, &$project, &$tabs_settings, $interface) {
      if($interface == AngieApplication::INTERFACE_DEFAULT && in_array('quote', $tabs_settings)) {
      $tabs->add('quote', array(
        'text' => lang('Quote'),
        'url' => Quote::getProjectQuoteUrl($project),
        'icon' => $interface == AngieApplication::INTERFACE_DEFAULT ? 
        	AngieApplication::getImageUrl('main-menu/quote.png', QUOTE_MODULE) :
        	AngieApplication::getImageUrl('main-menu/quote.png', QUOTE_MODULE, AngieApplication::INTERFACE_PHONE)
      ));
    } // if
  } // 