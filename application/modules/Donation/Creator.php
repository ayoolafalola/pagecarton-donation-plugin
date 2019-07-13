<?php

/**
 * PageCarton
 *
 * LICENSE
 *
 * @category   PageCarton
 * @package    Donation_Creator
 * @copyright  Copyright (c) 2019 PageCarton (http://www.pagecarton.org)
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 * @version    $Id: Creator.php Friday 12th of July 2019 09:21AM ayoola@ayoo.la $
 */

/**
 * @see PageCarton_Widget
 */

class Donation_Creator extends PageCarton_Widget
{
	
    /**
     * Access level for player. Defaults to everyone
     *
     * @var boolean
     */
	protected static $_accessLevel = array( 0 );
	
    /**
     * 
     * 
     * @var string 
     */
	protected static $_objectTitle = 'Donate'; 

    /**
     * Performs the whole widget running process
     * 
     */
	public function init()
    {    
		try
		{ 
            //  Code that runs the widget goes here...

            //  Output demo content to screen
            $this->setViewContent( self::__( '<h1>Donation Form</h1><br>' ) ); 

            $form = new Ayoola_Form();

            $fieldset = new Ayoola_Form_Element();
        //    var_export( Application_Settings_Payment::retrieve() );
            $fieldset->addElement( array( 'name' => 'currency', 'type' => 'Html' ), array( 'html' => Application_Settings_Payment::retrieve( 'default_currency' ) ? : '$' ) );
            $fieldset->addElement( array( 'name' => 'amount', 'label' => '', 'value' => self::getObjectStorage()->retrieve() ? : Donation_Settings::retrieve( 'default_amount' ), 'placeholder' => '0.00', 'style' => 'max-width:50%;', 'type' => 'InputText' ) );

            $fieldset->addRequirement( 'amount', array( 'MinMax' => array( Donation_Settings::retrieve( 'min_amount' ), Donation_Settings::retrieve( 'max_amount' ) ) ) );

            $form->addFieldset( $fieldset );
            $form->submitValue = 'Donate';
            $this->setViewContent( $form->view() ); 

            if( ! $values = $form->getValues() )
            {
                return false;
            }

            $class = new Application_Subscription();   
            $values['price'] = $values['amount'];

            self::getObjectStorage()->store( $values['amount'] );

			$values['subscription_name'] = __CLASS__;
			$values['subscription_label'] = $values['price'] . ' donation';
			$values['url'] = Ayoola_Application::getUrlPrefix() . '/donate';     
            $class->subscribe( $values );
			header( 'Location: ' . Ayoola_Application::getUrlPrefix() . '/cart' );
			exit();

        //    var_export( $values );
            
            
            


            // end of widget process
          
		}  
		catch( Exception $e )
        { 
            //  Alert! Clear the all other content and display whats below.
        //    $this->setViewContent( self::__( '<p class="badnews">' . $e->getMessage() . '</p>' ) ); 
            $this->setViewContent( self::__( '<p class="badnews">Theres an error in the code</p>' ) ); 
            return false; 
        }
	}
	// END OF CLASS
}
