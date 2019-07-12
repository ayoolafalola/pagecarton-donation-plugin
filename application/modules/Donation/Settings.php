<?php

/**
 * PageCarton
 *
 * LICENSE
 *
 * @category   PageCarton
 * @package    PageCarton_Table_Sample
 * @copyright  Copyright (c) 2019 PageCarton (http://www.pagecarton.org)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @version    $Id: Settings.php Friday 12th of July 2019 09:57AM ayoola@ayoo.la $
 */

/**
 * @see PageCarton_Table
 */


class Donation_Settings extends PageCarton_Settings
{


	
    /**
     * creates the form for creating and editing
     * 
     * param string The Value of the Submit Button
     * param string Value of the Legend
     * param array Default Values
     */
	public function createForm( $submitValue = null, $legend = null, Array $values = null )
    {
		if( ! $settings = unserialize( @$values['settings'] ) )
		{
			if( is_array( $values['data'] ) )
			{
				$settings = $values['data'];
			}
			elseif( is_array( $values['settings'] ) )
			{
				$settings = $values['settings'];
			}
			else
			{
				$settings = $values;
			}
		}
	//	$settings = unserialize( @$values['settings'] ) ? : $values['settings'];
        $form = new Ayoola_Form( array( 'name' => $this->getObjectName() ) );
		$form->submitValue = $submitValue ;
		$form->oneFieldSetAtATime = true;
		$fieldset = new Ayoola_Form_Element;



        //  Sample Text Field Retrieving E-mail Address
		$fieldset->addElement( array( 'name' => 'default_amount', 'placeholder' => '0.00' , 'label' => 'Default Amount', 'value' => @$settings['default_amount'], 'type' => 'InputText' ) );
		$fieldset->addElement( array( 'name' => 'min_amount', 'placeholder' => '0.00', 'label' => 'Minimum Amount', 'value' => @$settings['min_amount'], 'type' => 'InputText' ) );
		$fieldset->addElement( array( 'name' => 'max_amount', 'placeholder' => '0.00', 'label' => 'Maximum Amount', 'value' => @$settings['max_amount'], 'type' => 'InputText' ) );
		
		$fieldset->addLegend( 'Donation Plugin Settings' ); 
               
		$form->addFieldset( $fieldset );
		$this->setForm( $form );
		//		$form->addFieldset( $fieldset );
	//	$this->setForm( $form );
    } 
	// END OF CLASS
}
