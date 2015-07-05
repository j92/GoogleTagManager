<?php

/**
 * Class for our Google DataLayer object.
 *
 * @author Joost van Driel, joostvdriel+github@gmail.com
 */
class GoogleDataLayer {

    /** @var array */
    protected $data;

    // function to add data
    // function to remove data
    // function to get the datalayer script
    // function to get the data in the datalayer

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Push an array to the DataLayer
     *
     * @param array $data
     */
    public function pushData($data){

        if( isset($data) ){
            if(is_array($data) && !empty($data)){
                array_push($this->data, $data);
            }
        }
    }

    public function removeData(){

    }

    public function getAllData(){

    }

    /**
     * Convert data array to string
     */
    private function arrayToString($data){

        if( empty($data) ){
            return "";
        }

        // basis van datalayer
        $data_layer = "";

        // Loop door de data array en bouw dataLayer String
        foreach( $data as $key => $value ){

            $data_layer .= "'".$key."': ".$value.",\n";

        }

        // Remove last comma and /n
        $data_layer = substr($data_layer, 0, -2);

        return $data_layer;

    }

    /**
     * Get the actual script tag with the current data in it
     *
     * @return string
     */
    public function getDataLayerScript(){

        // basic of datalayer
        $data_layer = "<script>dataLayer = [{ \n";

        // Convert data to string
        $data_layer .= $this->arrayToString($this->data);

        // Finish datalayer
        $data_layer .= "\n }]</script>";

        return $data_layer;

    }
}