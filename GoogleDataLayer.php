<?php

namespace Bolt\Extension\Ctors\GoogleTagManager;

/**
 * Class for our Google DataLayer object.
 *
 * @author Joost van Driel, joostvdriel+github@gmail.com
 */
class GoogleDataLayer {

    /** @var array */
    protected $data;

    /**
     * Default constructor
     */
    public function __construct()
    {

    }

    /**
     * Push an array to the DataLayer
     *
     * @param string $key
     * @param string $value
     */
    public function pushData($key, $value = ''){

        if( isset($key) && !empty($key) ){
            // we should allow empty values in datalayer
            // only add key to data array if it doesn't exist yet
            if( !isset($this->data[$key]) ){
                $this->data[$key] = $value;
            }
        }
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

            $data_layer .= "'".$key."': '".htmlentities($value,ENT_QUOTES)."',";

        }

        // Remove last comma
        $data_layer = substr($data_layer, 0, -1);

        return $data_layer;

    }

    /**
     * Get the actual script tag with the current data in it
     *
     * @return string
     */
    public function getDataLayerScript(){

        // basic of datalayer
        $data_layer = "<script>dataLayer = [{";

        // Convert data to string
        $data_layer .= $this->arrayToString($this->data);

        // Finish datalayer
        $data_layer .= "}]</script>";

        return $data_layer;

    }
}