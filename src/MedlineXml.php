<?php

namespace Tresa02\Medline;
use Tresa02\Medline\Model\Medline;

/**
 * Class Medline
 *
 * @package tresa02\medline
 */
class MedlineXml
{
    /** @var Medline $medline */
    public $medline;

    public function __construct(int $medlineId = null)
    {
        $this->medline = ($medlineId) ? Medline::find($medlineId) : new Medline();
    }

    /**
     * save new record of medline xml
     *
     * @param array $data
     * @param array $authorsIds
     *
     * @return \Tresa02\Medline\Model\Medline
     * @throws \Throwable
     */
    public function saveMedline(array $data, array $authorsIds)
    {
        $medline = $this->medline;
        $medline->document_id = $data[Medline::DOCUMENT_ID];
        $medline->type = $data[Medline::TYPE];
        $medline->title = $data[Medline::TITLE];
        $medline->lang = $data[Medline::LANG];
        $medline->abstract = $data[Medline::ABSTRACT];
        $medline->doi = $data[Medline::DOI];
        $medline->coi = $data[Medline::COI];
        $medline->first_page = $data[Medline::FIRST_PAGE];
        $medline->last_page = $data[Medline::LAST_PAGE];
        $medline->accepted_date = $data[Medline::ACCEPTED_DATE];
        $medline->received_date = $data[Medline::RECEIVED_DATE];
        $medline->epub_date = $data[Medline::EPUB_DATE];
        $medline->ppub_date = $data[Medline::PPUB_DATE];
        $medline->volume = $data[Medline::VOLUME];
        $medline->issue = $data[Medline::ISSUE];
        $medline->journal_title = $data[Medline::JOURNAL_TITLE];
        $medline->keywords = $data[Medline::KEYWORDS];
        $medline->latest_xml = $this->export();
        $medline->save();

        $medline->assignAuthor($authorsIds);

        return $medline;
    }

    /**
     * update medline record
     *
     * @param int   $medlineId
     * @param array $data
     * @param array $authorsIds
     *
     * @return \Tresa02\Medline\Model\Medline
     * @throws \Throwable
     */
    public function updateMedline(array $data, array $authorsIds = [])
    {
        /** @var Medline $medline */
        $medline = $this->medline;
        $medline->document_id = $data[Medline::DOCUMENT_ID] ?? $medline->document_id;
        $medline->type = $data[Medline::TYPE] ?? $medline->type;
        $medline->title = $data[Medline::TITLE] ?? $medline->title;
        $medline->lang = $data[Medline::LANG] ?? $medline->lang;
        $medline->abstract = $data[Medline::ABSTRACT] ?? $medline->abstract;
        $medline->doi = $data[Medline::DOI] ?? $medline->doi;
        $medline->coi = $data[Medline::COI] ?? $medline->coi;
        $medline->first_page = $data[Medline::FIRST_PAGE] ?? $medline->first_page;
        $medline->last_page = $data[Medline::LAST_PAGE] ?? $medline->last_page;
        $medline->accepted_date = $data[Medline::ACCEPTED_DATE] ?? $medline->accepted_date;
        $medline->received_date = $data[Medline::RECEIVED_DATE] ?? $medline->received_date;
        $medline->epub_date = $data[Medline::EPUB_DATE] ?? $medline->epub_date;
        $medline->ppub_date = $data[Medline::PPUB_DATE] ?? $medline->ppub_date;
        $medline->volume = $data[Medline::VOLUME] ?? $medline->volume;
        $medline->issue = $data[Medline::ISSUE] ?? $medline->issue;
        $medline->journal_title = $data[Medline::JOURNAL_TITLE] ?? $medline->journal_title;
        $medline->keywords = $data[Medline::KEYWORDS] ?? $medline->keywords;
        $medline->latest_xml = $this->export();
        $medline->save();

        if (count($authorsIds) > 0) {
            $medline->assignAuthor($authorsIds);
        }

        return $medline;
    }

    /**
     * render xml and export
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Throwable
     */
    public function export()
    {
        $medline = $this->medline->load('authors');

        return view('medline::medline', compact('medline'))->render();
    }

    /**
     * import from  xml file to data base
     */
    public function import()
    {

    }
}
