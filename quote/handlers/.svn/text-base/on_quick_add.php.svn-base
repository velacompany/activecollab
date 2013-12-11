<?php

  /**
   * Invoicing module on_quick_add event handler
   *
   * @package activeCollab.modules.invoicing
   * @subpackage handlers
   */
  
  /**
   * Handle on quick add event
   *
   * @param NamedList $items
   * @param NamedList $subitems
   * @param array $map
   * @param User $logged_user
   * @param DBResult $projects 
   * @param DBResult $companies
   * @param string $interface
   */
  function quote_handle_on_quick_add($items, $subitems, &$map, $logged_user, $projects, $companies, $interface = AngieApplication::INTERFACE_DEFAULT) {
  	if($interface == AngieApplication::INTERFACE_DEFAULT) {

		    $items->add('quote', array(
		      'text' => lang('quote'),
		    	'title' => lang('Create quote'),
		      'icon' => AngieApplication::getImageUrl('icons/32x32/invoice.png', QUOTE_MODULE),
		      'url' => Router::assemble('add_quote'),
		    	'event' => 'quote_created',
		    ));

  	} // if
  	
  } // invoicing_handle_on_project_tabs