<?php

namespace Tresa02\Medline\Model;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Tresa02\Medline\Model\MedlineAuthor
 *
 * @property int $id
 * @property int $author_id
 * @property int $medline_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\MedlineAuthor whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\MedlineAuthor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\MedlineAuthor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\MedlineAuthor whereMedlineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\MedlineAuthor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MedlineAuthor extends Pivot
{
    const TABLE = 'medline_authors';
    const ID = 'id';
    const AUTHOR_ID = 'author_id';
    const MEDLINE_ID = 'medline_id';
    /** @var string $table */
    protected $table = self::TABLE;
}
