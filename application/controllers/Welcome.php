<?php

/**
 * Our homepage. Show the most recently added quote.
 * 
 * controllers/Welcome.php
 *
 * ------------------------------------------------------------------------
 */
class Welcome extends Application {

    function __construct()
    {
	parent::__construct();
    }

    //-------------------------------------------------------------
    //  Homepage: show a list of the orders on file
    //-------------------------------------------------------------

    function index()
    {
	// Build a list of orders
	
	// Present the list to choose from
	$this->data['pagebody'] = 'homepage';
        $map = directory_map('./data');
        $xmlfiles = array();
        
        foreach ($map as $file) {
            if (substr_compare($file, ".xml", strlen($file) - 
                    strlen(".xml"), strlen(".xml")) === 0 && substr_compare($file, 
                            "order", 0, strlen("order")) === 0) {
                $xmlfiles[] = array('filename' => $file, 'name' => 
                    substr($file, 0, strlen($file) - strlen(".xml")));
            }
        }
        
        $this->data['orders'] = $xmlfiles;
	$this->render();
    }
    
    //-------------------------------------------------------------
    //  Show the "receipt" for a specific order
    //-------------------------------------------------------------

    function order($filename)
    {
	// Build a receipt for the chosen order
	
	// Present the list to choose from
	$this->data['pagebody'] = 'justone';
        $this->data['ordernum'] = substr($filename, 0, strlen($filename) - strlen(".xml"));
	$this->render();
    }
}
