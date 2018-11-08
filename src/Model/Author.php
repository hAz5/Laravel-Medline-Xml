<?php

namespace Tresa02\Medline\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Tresa02\Medline\Model\Author
 *
 * @property int $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $affiliations
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Tresa02\Medline\Model\Medline[] $medline
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Author whereAffiliations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Author whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Author whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Author whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Author whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Author whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Author whereMiddleName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Tresa02\Medline\Model\Author whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Author extends Model
{
    const TABLE = 'authors';
    const ID = 'id';
    const FIRST_NAME = 'first_name';
    const MIDDLE_NAME = 'middle_name';
    const LAST_NAME = 'last_name';
    const AFFILIATIONS = 'affiliations';
    const EMAIL = 'email';

    /** @var array $guarded */
    protected $guarded = [self::ID];
    /** @var string $table */
    protected $table = self::TABLE;

    /**
     * get medline
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function medline()
    {
        return $this->belongsToMany(
            Medline::class,
            MedlineAuthor::TABLE,
            MedlineAuthor::AUTHOR_ID,
            MedlineAuthor::MEDLINE_ID,
            self::ID,
            Medline::ID
        );
    }
}
