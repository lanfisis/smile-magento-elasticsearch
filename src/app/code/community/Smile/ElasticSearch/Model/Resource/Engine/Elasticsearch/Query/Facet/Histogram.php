<?php
/**
 * ElaticSearch histogram facet model.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Smile Searchandising Suite to newer
 * versions in the future.
 *
 * This work is a fork of Johann Reinke <johann@bubblecode.net> previous module
 * available at https://github.com/jreinke/magento-elasticsearch
 *
 * @category  Smile
 * @package   Smile_ElasticSearch
 * @author    Aurelien FOUCRET <aurelien.foucret@smile.fr>
 * @copyright 2013 Smile
 * @license   Apache License Version 2.0
 */
class Smile_ElasticSearch_Model_Resource_Engine_Elasticsearch_Query_Facet_Histogram
    extends Smile_ElasticSearch_Model_Resource_Engine_Elasticsearch_Query_Facet_Abstract
{
    /**
     * @var array
     */
    protected $_options = array(
        'interval' => 1,
    );

    /**
     * Transform the facet into an ES syntax compliant array.
     *
     * @return array
     */
    public function getFacetQuery()
    {
        return array('histogram' => $this->_options);
    }

    /**
     * Parse the response to extract facet items.
     *
     * @param array $response Query response data.
     *
     * @return array
     */
    public function getItems($response)
    {
        $result = array();

        if (isset($response['entries'])) {
            foreach ($response['entries'] as $value) {
                $result[$value['key']] = $value['count'];
            }
        }
        return $result;
    }
}