<?php

  /**
   * Calendar module on_main_menu event handler
   *
   * @package activeCollab.modules.calendar
   * @subpackage handlers
   */
  
  /**
   * Add options to main menu
   *
   * @param MainMenu $menu
   * @param User $user
   */
  function quote_handle_on_main_menu(MainMenu &$menu, User &$user) {
    $menu->addBefore('quote', lang('Quote'), Router::assemble('dashboard_quote'),AngieApplication::getImageUrl('main-menu/quote.png', QUOTE_MODULE), null, 'admin');
  } // calendar_handle_on_main_menu
  