<?php

namespace Tresa02\Medline\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Medline
 *
 * @package Tresa02\Medline\Model
 * @property int                             $id
 * @property int                             $document_id
 * @property string                          $type
 * @property string                          $title
 * @property string                          $lang
 * @property string                          $abstract
 * @property string|null                     $doi
 * @property string|null                     $coi
 * @property string                          $epub_date
 * @property string                          $ppub_date
 * @property string                          $accepted_date
 * @property string                          $received_date
 * @property int                             $first_page
 * @property int                             $last_page
 * @property string                          $volume
 * @property string                          $issue
 * @property string                          $journal_title
 * @property string                          $keywords
 * @property string                          $latest_xml
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Tresa02\Medline\Model\Author[] $authors
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereAbstract($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereAcceptedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereCoi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereDoi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereEpubDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereFirstPage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereIssue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereJournalTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereLastPage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereLatestXml($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline wherePpubDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline wherePublisherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereReceivedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Medline whereVolume($value)
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
class Medline extends Model
{
    const TABLE = 'medline';
    const ID = 'id';
    const DOCUMENT_ID = 'document_id';
    const TYPE = 'type';
    const TITLE = 'title';
    const LANG = 'lang';
    const ABSTRACT = 'abstract';
    const DOI = 'doi';
    const COI = 'coi';
    const FIRST_PAGE = 'first_page';
    const LAST_PAGE = 'last_page';
    const ACCEPTED_DATE = 'accepted_date';
    const RECEIVED_DATE = 'received_date';
    const EPUB_DATE = 'epub_date';
    const PPUB_DATE = 'ppub_date';
    const VOLUME = 'volume';
    const ISSUE = 'issue';
    const JOURNAL_TITLE = 'journal_title';
    const KEYWORDS = 'keywords';
    const LATEST_XML = 'latest_xml';

    /** @var string $table */
    protected $table = self::TABLE;
    /** @var array $guarded */
    protected $guarded = [self::ID];

    protected $dates = [
        self::PPUB_DATE,
        self::EPUB_DATE,
        self::ACCEPTED_DATE,
        self::RECEIVED_DATE,
    ];
    /**
     * relation wih author table
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function authors()
    {
        return $this->belongsToMany(
            Author::class,
            MedlineAuthor::TABLE,
            MedlineAuthor::MEDLINE_ID,
            MedlineAuthor::AUTHOR_ID,
            self::ID,
            Author::ID
        );
    }

    /**
     * assign author to medline
     *
     * @param $authors
     *
     * @return array|void
     */
    public function assignAuthor($authors)
    {
        if (is_array($authors)) {
            $result = $this->authors()->sync($authors);
        } else {
            $result = $this->authors()->attach($authors);
        }

        return $result;
    }

    /**
     * get keywords as array
     *
     * @return array
     */
    public function getKeywords()
    {
        return explode(',', $this->keywords);
    }

    /**
     * get copyright with license holder
     *
     * @throws \PropelException
     */
    public function getCopyright()
    {
        $copy = sprintf(
            'Copyright © %s, %s.',
            $this->ppub_date->year,
            config('medline.copyright_license_holder', 'test license holder')
        );
        $copy .= ' Published by ' . config('medline.publisher_name');

        return $copy;
    }

}
