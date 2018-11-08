<?php

namespace Tresa02\Medline;


use Carbon\Carbon;
use SimpleXMLElement;

/**
 * TODO:: please complete this issue
 * Class ImportMedline
 * @package Tresa02\Medline
 */
class ImportMedline
{
    public $xml;
    /** @var \DOMDocument $dom */
    public $dom;

    public $simpleXML;

    /**
     * ImportMedline constructor.
     *
     * @param string $medlineXml
     *
     * @throws \Exception
     */
    public function __construct(string $medlineXml)
    {
        $this->xml = $medlineXml;
        $this->dom = new \DOMDocument();
        $this->dom->load($medlineXml);
        $this->simpleXML = simplexml_load_string($medlineXml);
//        if (!$this->dom->validate()) {
//            throw new \Exception('invalid xml');
//        }
    }

    public function getIssn()
    {
        return (string) $this->simpleXML->xpath('ArticleSet/Article/Journal/Issn');
    }

    public function getVolume()
    {
        return (string) $this->simpleXML->xpath('ArticleSet/Article/Journal/Volume');
    }

    public function getTitle()
    {
        return (string) $this->simpleXML->xpath('ArticleSet/Article/ArticleTitle');
    }

    /**
     * get doi from xml
     *
     * @return null|\SimpleXMLElement
     */
    public function getDoi()
    {
        $doi = $this->simpleXML->xpath('/ArticleSet/Article/ELocationID[@EIdType="doi"]');

        return (count($doi) > 0) ? $doi[0] : null ;
    }
//
//    public function getDocumentID()
//    {
//        return (string) $this->simpleXML->xpath('ArticleSet/Article/ELocationID[EIdType="pii"]');
//    }

    /**
     *  get dates from xml
     *
     * @param string $dateType
     *
     * @return array|\Carbon\Carbon|\SimpleXMLElement
     */
    public function getHistory(string $dateType)
    {
        $address = '/ArticleSet/Article/History/PubDate[@PubStatus="' . $dateType . '"]';
        /** @var \SimpleXMLElement $date[0] */
        $date = (array) $this->simpleXML->xpath($address);
        if (count($date) > 0) {
            $date = (array) $date[0];

            return Carbon::create(
                $date['year'] ?? $date['Year'] ?? 2018,
                $date['month'] ?? $date['Month'] ?? 01,
                $date['day'] ?? $date['Day'] ?? 01
            );
        }

        return $date;
    }

    /**
     * get ppub date from history
     *
     * @return array|\Carbon\Carbon|\SimpleXMLElement
     */
    public function getPpubDate()
    {
        return $this->getHistory('ppublish');
    }

    /**
     * get epub date from history
     *
     * @return array|\Carbon\Carbon|\SimpleXMLElement
     */
    public function getEpubDate()
    {
        return $this->getHistory('epublish');
    }

    /**
     * get accepted date from history
     *
     * @return array|\Carbon\Carbon|\SimpleXMLElement
     */
    public function getAcceptedDate()
    {
        return $this->getHistory('accepted');
    }

    /**
     * get received date from history
     *
     * @return array|\Carbon\Carbon|\SimpleXMLElement
     */
    public function getReceivedDate()
    {
        return $this->getHistory('received');
    }

    public function getAuthors()
    {
        $address = '/ArticleSet/Article';
        $authors = $this->simpleXML->xpath($address)[0]->AuthorList;

        return $authors;
    }

    public function xml2Array(SimpleXMLElement $parent)
    {
        $array = [];
        foreach ($parent as $name => $element) {
            ($node = & $array[$name])
            && (1 === count($node) ? $node = array($node) : 1)
            && $node = & $node[];

            $node = $element->count() ? $this->xml2Array($element) : trim($element);
        }

        return $array;
    }
}
